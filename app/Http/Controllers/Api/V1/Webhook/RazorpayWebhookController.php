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
use App\Mail\EscrowPaymentSuccess;

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

                // Send emails (outside DB transaction; failure must not break webhook)
                try {
                    $buyer = User::find($escrow->buyer_id);
                    $seller = User::find($escrow->seller_id);
                    if ($buyer) {
                        Mail::to($buyer->email)->send(new EscrowPaymentSuccess($buyer, $escrow, 'buyer'));
                    }
                    if ($seller) {
                        Mail::to($seller->email)->send(new EscrowPaymentSuccess($seller, $escrow, 'seller'));
                    }
                } catch (\Exception $mailEx) {
                    Log::error('Escrow email dispatch failed: ' . $mailEx->getMessage());
                }
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
            // Razorpay fires both 'authenticated' and 'charged' (and 'charged' again every month).
            // Only send the welcome email on the first activation.
            $wasAlreadyActive = $profile->subscription_status === 'active';

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

            if ($user && !$wasAlreadyActive) {
                try {
                    $planName = $profile->plan->name ?? 'Dealer Plan';
                    $amount = $profile->plan->price ?? 0;
                    Mail::to($user->email)->send(new DealerSubscriptionSuccess($user, $planName, $amount, $subscriptionId));
                } catch (\Exception $mailEx) {
                    Log::error('Subscription success email failed: ' . $mailEx->getMessage());
                }
            }
        }
    }

    protected function handleSubscriptionFailed($subscriptionData)
    {
        $subscriptionId = $subscriptionData['id'];
        
        $profile = DealerProfile::where('razorpay_subscription_id', $subscriptionId)->first();
        
        if ($profile) {
            $wasAlreadyCancelled = $profile->subscription_status === 'cancelled';

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

            // If the Cancel API already handled this (status was already 'cancelled'),
            // it has sent the email, so skip here to avoid duplicates.
            if ($user && !$wasAlreadyCancelled) {
                try {
                    Mail::to($user->email)->send(new DealerSubscriptionCancelled($user));
                } catch (\Exception $mailEx) {
                    Log::error('Subscription cancelled email failed: ' . $mailEx->getMessage());
                }
            }
        }
    }
}
