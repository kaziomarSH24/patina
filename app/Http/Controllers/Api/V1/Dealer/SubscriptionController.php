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
}
