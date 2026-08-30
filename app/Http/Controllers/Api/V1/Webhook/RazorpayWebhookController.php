<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Http\Controllers\Controller;
use App\Models\DealerProfile;
use App\Models\User;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    protected function handleSubscriptionSuccess($subscriptionData)
    {
        $subscriptionId = $subscriptionData['id'];
        
        $profile = DealerProfile::where('razorpay_subscription_id', $subscriptionId)->first();
        
        if ($profile) {
            // Activate the profile
            $profile->update([
                'status' => 'approved', 
            ]);

            // Assign dealer role to the user
            $user = $profile->user;
            if ($user && !$user->hasRole('dealer')) {
                $user->syncRoles(['dealer']);
            }
            
            Log::info("Dealer profile activated for subscription: {$subscriptionId}");
        }
    }

    protected function handleSubscriptionFailed($subscriptionData)
    {
        $subscriptionId = $subscriptionData['id'];
        
        $profile = DealerProfile::where('razorpay_subscription_id', $subscriptionId)->first();
        
        if ($profile) {
            // Downgrade the profile
            $profile->update([
                'status' => 'rejected', // Or 'suspended'
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
