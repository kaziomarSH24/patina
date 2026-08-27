<?php

namespace App\Services;

use App\Models\DealerProfile;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $key = config('services.razorpay.key');
        $secret = config('services.razorpay.secret');
        
        if ($key && $secret) {
            $this->api = new Api($key, $secret);
        }
    }

    /**
     * Create a customer in Razorpay for a given user.
     */
    public function createOrGetCustomer(User $user)
    {
        $profile = $user->dealerProfile;
        
        if ($profile && $profile->razorpay_customer_id) {
            return $profile->razorpay_customer_id;
        }

        try {
            $customer = $this->api->customer->create([
                'name' => $user->name,
                'email' => $user->email,
                'contact' => $user->phone_number,
                'notes' => [
                    'user_id' => $user->id,
                    'business_name' => $profile ? $profile->business_name : null,
                ]
            ]);

            if ($profile) {
                $profile->update(['razorpay_customer_id' => $customer->id]);
            }

            return $customer->id;
        } catch (Exception $e) {
            Log::error('Razorpay Create Customer Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create a subscription for a dealer
     */
    public function createSubscription(User $user, SubscriptionPlan $plan)
    {
        if (!$plan->razorpay_plan_id) {
            throw new Exception("Plan '{$plan->name}' is not synced with Razorpay yet.");
        }

        $customerId = $this->createOrGetCustomer($user);

        try {
            $subscription = $this->api->subscription->create([
                'plan_id' => $plan->razorpay_plan_id,
                'customer_id' => $customerId,
                'total_count' => 120, // Example: 10 years
                'customer_notify' => 1,
                'notes' => [
                    'user_id' => $user->id,
                    'plan_id' => $plan->id
                ]
            ]);

            // Save the subscription ID to the profile, but don't activate yet
            if ($user->dealerProfile) {
                $user->dealerProfile->update([
                    'razorpay_subscription_id' => $subscription->id,
                    'subscription_plan_id' => $plan->id
                ]);
            }

            return $subscription;
        } catch (Exception $e) {
            Log::error('Razorpay Create Subscription Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verify Webhook Signature
     */
    public function verifyWebhookSignature($payload, $signature)
    {
        $secret = config('services.razorpay.webhook_secret'); // You need to set this if using strict webhooks
        if(!$secret) {
            // fallback to key secret if explicit webhook secret is not set
            $secret = config('services.razorpay.secret');
        }

        try {
            $this->api->utility->verifyWebhookSignature($payload, $signature, $secret);
            return true;
        } catch (Exception $e) {
            Log::error('Razorpay Webhook Signature Verification Failed: ' . $e->getMessage());
            return false;
        }
    }
}
