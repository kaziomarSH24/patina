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
                'fail_existing' => 0,
                'notes' => [
                    'user_id' => $user->id,
                    'business_name' => $profile ? $profile->business_name : null,
                ]
            ]);

            if ($profile) {
                $profile->update(['razorpay_customer_id' => $customer->id]);
            }

            return $customer->id;
        } catch (\Exception $e) {
            // If customer exists, try to fetch them by email or contact
            if (str_contains($e->getMessage(), 'Customer already exists')) {
                $customers = $this->api->customer->all(['email' => $user->email]);
                if (isset($customers['items']) && count($customers['items']) > 0) {
                    $existingCustomer = $customers['items'][0];
                    if ($profile) {
                        $profile->update(['razorpay_customer_id' => $existingCustomer->id]);
                    }
                    return $existingCustomer->id;
                }
            }
            Log::error('Razorpay Create Customer Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createSubscription(User $user, SubscriptionPlan $plan)
    {
        if (!$plan->razorpay_plan_id) {
            throw new Exception("Plan '{$plan->name}' is not synced with Razorpay yet.");
        }

        $customerId = $this->createOrGetCustomer($user);
        $profile = $user->dealerProfile;
        $isUsingPromo = false;

        try {
            $subscriptionData = [
                'plan_id' => $plan->razorpay_plan_id,
                'customer_id' => $customerId,
                'total_count' => 120, // Example: 10 years
                'customer_notify' => 1,
                'notes' => [
                    'user_id' => $user->id,
                    'plan_id' => $plan->id
                ]
            ];

            // Launch Promo Logic (Only if the dealer has NEVER used a promo before)
            if ($profile && !$profile->has_used_launch_promo) {
                if ($plan->slug === config('patina.plans.tier_1.slug')) {
                    // First week free
                    $subscriptionData['start_at'] = now()->addDays(config('patina.plans.tier_1.trial_days'))->timestamp;
                    $isUsingPromo = true;
                } elseif ($plan->slug === config('patina.plans.tier_2.slug')) {
                    // Upfront discount
                    $subscriptionData['start_at'] = now()->addDays(config('patina.plans.tier_2.defer_days'))->timestamp;
                    $amount = (int) (($plan->price * config('patina.plans.tier_2.upfront_percentage')) * 100);
                    $subscriptionData['addons'] = [
                        ['item' => ['name' => 'First Month Promo', 'amount' => $amount, 'currency' => 'INR']]
                    ];
                    $isUsingPromo = true;
                } elseif ($plan->slug === config('patina.plans.tier_3.slug')) {
                    // Upfront discount
                    $subscriptionData['start_at'] = now()->addDays(config('patina.plans.tier_3.defer_days'))->timestamp;
                    $amount = (int) (($plan->price * config('patina.plans.tier_3.upfront_percentage')) * 100);
                    $subscriptionData['addons'] = [
                        ['item' => ['name' => 'First Month Promo', 'amount' => $amount, 'currency' => 'INR']]
                    ];
                    $isUsingPromo = true;
                }
            }

            // Generate subscription on Razorpay FIRST
            $subscription = $this->api->subscription->create($subscriptionData);

            // If successful, save the subscription ID to the profile and lock the promo
            if ($profile) {
                $updateData = [
                    'razorpay_subscription_id' => $subscription->id,
                    'subscription_plan_id' => $plan->id
                ];

                if ($isUsingPromo) {
                    $updateData['has_used_launch_promo'] = true;
                }

                $profile->update($updateData);
            }

            return $subscription;
        } catch (Exception $e) {
            Log::error('Razorpay Create Subscription Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function verifyWebhookSignature($payload, $signature)
    {
        $secret = config('services.razorpay.webhook_secret');
        if(!$secret) {
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
