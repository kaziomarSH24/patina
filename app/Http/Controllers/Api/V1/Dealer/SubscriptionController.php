<?php

namespace App\Http\Controllers\Api\V1\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DealerProfile;
use App\Models\SubscriptionPlan;
use App\Services\RazorpayService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected RazorpayService $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    /**
     * Initiate a subscription for the dealer
     */
    public function initiate(Request $request)
    {
        $user = $request->user();
        $profile = DealerProfile::where('user_id', $user->id)->first();

        if (!$profile) {
            return response_error('No dealer profile found. Please submit your application first.', [], 400);
        }

        if (!$profile->subscription_plan_id) {
            return response_error('No subscription plan selected.', [], 400);
        }

        $plan = SubscriptionPlan::find($profile->subscription_plan_id);

        if (!$plan || !$plan->razorpay_plan_id) {
            return response_error('Invalid subscription plan or plan not synced with payment gateway.', [], 400);
        }

        // If a subscription ID already exists and is pending, you might want to reuse it, 
        // but for simplicity and to avoid expired sessions, we'll generate a new one.
        try {
            $subscription = $this->razorpayService->createSubscription($user, $plan);

            // Save the subscription ID so the webhook can find this profile later
            $profile->update([
                'razorpay_subscription_id' => $subscription->id
            ]);

            return response_success('Subscription initiated successfully.', [
                'subscription_id' => $subscription->id,
                'razorpay_key' => config('services.razorpay.key'),
                'plan_name' => $plan->name,
                'amount' => $plan->price,
            ]);
        } catch (\Exception $e) {
            return response_error('Failed to initiate subscription.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Cancel the dealer's active subscription
     */
    public function cancel(Request $request)
    {
        $user = $request->user();
        $profile = DealerProfile::where('user_id', $user->id)->first();

        if (!$profile || !$profile->razorpay_subscription_id) {
            return response_error('No active subscription found.', [], 400);
        }

        try {
            $this->razorpayService->cancelSubscription($profile->razorpay_subscription_id);
            
            // Note: The actual status update (removing role, etc.) will happen 
            // via the 'subscription.cancelled' Webhook for safety. 
            // But we can eagerly update it here too.
            $profile->update(['subscription_status' => 'cancelled']);
            
            if ($user->hasRole('dealer')) {
                $user->removeRole('dealer');
            }

            return response_success('Subscription cancelled successfully.');
        } catch (\Exception $e) {
            return response_error('Failed to cancel subscription.', ['error' => $e->getMessage()]);
        }
    }
}
