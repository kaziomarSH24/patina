<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Tier 1 Dealer',
                'slug' => 'tier-1-dealer',
                'price' => 10000.00,
                'listing_credits' => 10,
                'seller_commission_percent' => 8.00,
                'buyer_commission_percent' => 4.00,
                'discovery_priority' => 1,
                'razorpay_plan_id' => null,
                'features' => json_encode([
                    'max_listings' => 10,
                    'priority_support' => false,
                    'analytics_access' => false,
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tier 2 Dealer',
                'slug' => 'tier-2-dealer',
                'price' => 25000.00,
                'listing_credits' => 30,
                'seller_commission_percent' => 6.00,
                'buyer_commission_percent' => 4.00,
                'discovery_priority' => 2,
                'razorpay_plan_id' => null,
                'features' => json_encode([
                    'max_listings' => 30,
                    'priority_support' => true,
                    'analytics_access' => true,
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tier 3 Dealer',
                'slug' => 'tier-3-dealer',
                'price' => 40000.00,
                'listing_credits' => 50,
                'seller_commission_percent' => 4.00,
                'buyer_commission_percent' => 4.00,
                'discovery_priority' => 3,
                'razorpay_plan_id' => null,
                'features' => json_encode([
                    'max_listings' => 50,
                    'priority_support' => true,
                    'analytics_access' => true,
                    'featured_listings' => true,
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Clear existing plans if needed or use updateOrCreate (For simplicity, let's truncate or just loop and updateOrCreate to avoid duplicating)
        foreach ($plans as $plan) {
            SubscriptionPlan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
