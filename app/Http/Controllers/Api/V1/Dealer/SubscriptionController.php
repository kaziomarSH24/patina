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

        if ($profile->status !== 'approved') {
            return response_error('Your application must be approved by an admin before you can subscribe.', [], 403);
        }

        if ($profile->subscription_status === 'active') {
            return response_error('You already have an active subscription.', [], 400);
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

        if ($profile->subscription_status !== 'active') {
            return response_error('Only an active subscription can be cancelled.', [], 400);
        }

        try {
            $this->razorpayService->cancelSubscription($profile->razorpay_subscription_id);
            
            $profile->update(['subscription_status' => 'cancelled']);
            
            // Same as the webhook: downgrade to customer (don't leave the user role-less)
            if ($user->hasRole('dealer')) {
                $user->syncRoles(['customer']);
            }

            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\DealerSubscriptionCancelled($user));
            } catch (\Exception $mailEx) {
                \Illuminate\Support\Facades\Log::error('Subscription cancelled email failed: ' . $mailEx->getMessage());
            }

            return response_success('Subscription cancelled successfully.');
        } catch (\Exception $e) {
            return response_error('Failed to cancel subscription.', ['error' => $e->getMessage()]);
        }
    }
}
