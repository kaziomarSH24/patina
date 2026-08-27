<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'price' => 10000.00,
                'razorpay_plan_id' => null,
                'features' => json_encode([
                    'max_listings' => 50,
                    'priority_support' => false,
                    'analytics_access' => false,
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Professional',
                'slug' => 'professional',
                'price' => 20000.00,
                'razorpay_plan_id' => null,
                'features' => json_encode([
                    'max_listings' => 200,
                    'priority_support' => true,
                    'analytics_access' => true,
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'slug' => 'premium',
                'price' => 40000.00,
                'razorpay_plan_id' => null,
                'features' => json_encode([
                    'max_listings' => -1, // Unlimited
                    'priority_support' => true,
                    'analytics_access' => true,
                    'featured_listings' => 10,
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\SubscriptionPlan::insert($plans);
    }
}
