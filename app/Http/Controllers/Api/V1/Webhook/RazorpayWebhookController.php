<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Http\Controllers\Controller;
use App\Models\DealerProfile;
use App\Models\User;
use App\Models\Transaction;
use App\Models\EscrowTransaction;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DealerSubscriptionSuccess;
use App\Mail\DealerSubscriptionCancelled;

class RazorpayWebhookController extends Controller
{
    protected RazorpayService $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');

        if (!$this->razorpayService->verifyWebhookSignature($payload, $signature)) {
            Log::warning('Razorpay Webhook: Invalid Signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = json_decode($payload, true);
        $event = $data['event'] ?? '';

        Log::info("Razorpay Webhook Received: {$event}");

        try {
            switch ($event) {
                case 'payment.captured':
                    $this->handlePaymentCaptured($data['payload']['payment']['entity']);
                    break;
                case 'subscription.charged':
                case 'subscription.authenticated':
                    $this->handleSubscriptionSuccess($data['payload']['subscription']['entity']);
                    break;
                case 'subscription.cancelled':
                case 'subscription.halted':
                    $this->handleSubscriptionFailed($data['payload']['subscription']['entity']);
                    break;
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error("Razorpay Webhook Error: " . $e->getMessage());
            return response()->json(['error' => 'Webhook processing failed'], 500);
        }
    }

    protected function handlePaymentCaptured($paymentData)
    {
        $orderId = $paymentData['order_id'];
        $paymentId = $paymentData['id'];

        // Find pending transaction
        $transaction = Transaction::where('payment_intent_id', $orderId)
            ->where('status', 'pending')
            ->first();

        if ($transaction) {
            DB::beginTransaction();
            try {
                // Update Transaction
                $transaction->update([
                    'status' => 'success',
                    'gateway_transaction_id' => $paymentId,
                ]);

                // Create Escrow Transaction now that money is secured
                $metadata = $transaction->metadata;
                $escrow = EscrowTransaction::create([
                    'offer_id' => $transaction->payable_id,
                    'listing_id' => $metadata['listing_id'],
                    'buyer_id' => $metadata['buyer_id'],
                    'seller_id' => $metadata['seller_id'],
                    'amount' => $metadata['base_amount'],
                    'commission_amount' => $metadata['seller_commission_amount'] ?? 0,
                    'status' => 'Payment Received',
                    'razorpay_order_id' => $orderId,
                    'razorpay_payment_id' => $paymentId,
                ]);

                $escrow->listing()->update(['status' => 'sold']);

                DB::commit();
                Log::info("Escrow payment captured for order: {$orderId}");
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Razorpay Escrow Webhook Processing Failed: ' . $e->getMessage());
                throw $e;
            }
        }
    }

    protected function handleSubscriptionSuccess($subscriptionData)
    {
        $subscriptionId = $subscriptionData['id'];
        
        $profile = DealerProfile::where('razorpay_subscription_id', $subscriptionId)->first();
        
        if ($profile) {
            // Activate the profile and subscription
            $profile->update([
                'status' => 'approved',
                'subscription_status' => 'active'
            ]);

            // Assign dealer role to the user
            $user = $profile->user;
            if ($user && !$user->hasRole('dealer')) {
                $user->syncRoles(['dealer']);
            }
            
            Log::info("Dealer profile activated for subscription: {$subscriptionId}");

            // Send Email
            if ($user) {
                // If the webhook payload gives us amount and plan name, use them. Otherwise fallback.
                $planName = $profile->plan->name ?? 'Tier Dealer';
                $amount = isset($subscriptionData['notes']['upfront_amount']) ? $subscriptionData['notes']['upfront_amount'] : ($profile->plan->price ?? 0);
                
                Mail::to($user->email)->send(new DealerSubscriptionSuccess($user, $planName, $amount, $subscriptionId));
            }
        }
    }

    protected function handleSubscriptionFailed($subscriptionData)
    {
        $subscriptionId = $subscriptionData['id'];
        
        $profile = DealerProfile::where('razorpay_subscription_id', $subscriptionId)->first();
        
        if ($profile) {
            // Downgrade the subscription
            $profile->update([
                'subscription_status' => 'cancelled' // Or 'halted' based on exact status if preferred
            ]);

            // Remove dealer role
            $user = $profile->user;
            if ($user && $user->hasRole('dealer')) {
                $user->syncRoles(['customer']);
            }

            Log::info("Dealer profile deactivated due to subscription cancellation: {$subscriptionId}");
        }
    }
}
