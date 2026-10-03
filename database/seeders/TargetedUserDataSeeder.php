<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Listing;
use App\Models\EscrowTransaction;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TargetedUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetEmail = 'kaziomar@yopmail.com';
        $user = User::where('email', $targetEmail)->first();

        if (!$user) {
            $this->command->error("User with email {$targetEmail} not found! Cannot seed targeted data.");
            return;
        }

        // Get some other approved dealers to act as sellers
        $sellers = User::role('dealer')->where('kyc_status', 'approved')->where('id', '!=', $user->id)->take(3)->get();
        if ($sellers->isEmpty()) {
            $this->command->error("No other approved dealers found to act as sellers.");
            return;
        }

        $this->command->info("Found target user: {$user->name}. Seeding data...");

        // 1. Seed some Purchases (Escrow Transactions) for this user
        $watchReferences = [
            ['brand' => 'Rolex', 'model' => 'Submariner Date', 'ref' => '126610LN', 'price' => 14500],
            ['brand' => 'Omega', 'model' => 'Seamaster Diver 300M', 'ref' => '210.30.42.20.01.001', 'price' => 5200],
            ['brand' => 'Tudor', 'model' => 'Black Bay 58', 'ref' => '79030N', 'price' => 3800],
            ['brand' => 'Patek Philippe', 'model' => 'Nautilus', 'ref' => '5711/1A', 'price' => 95000],
        ];

        $statuses = ['Payment Received', 'Shipped', 'Confirmed', 'Completed'];

        foreach ($watchReferences as $index => $watch) {
            $seller = $sellers->random();

            // Create a dummy listing for the purchase
            $listing = Listing::create([
                'seller_id' => $seller->id,
                'brand' => $watch['brand'],
                'model' => $watch['model'],
                'reference_number' => $watch['ref'],
                'watch_type' => 'Automatic',
                'case_size' => '40mm',
                'condition' => 'Excellent',
                'year_of_production' => '2022',
                'accessories' => ['Box', 'Papers'],
                'price' => $watch['price'],
                'location' => 'New York, USA',
                'status' => 'Sold',
                'is_verified' => true,
                'images' => [
                    "https://ui-avatars.com/api/?background=random&size=800&name=" . urlencode($watch['brand'] . '+' . $watch['model'])
                ],
                'condition_notes' => "Seeded test listing for escrow purchase.",
                'sale_method' => 'marketplace',
            ]);

            $status = $statuses[$index % count($statuses)];
            $tracking = $status === 'Payment Received' ? null : 'TRK' . strtoupper(Str::random(8));
            $provider = $status === 'Payment Received' ? null : 'FedEx';

            // Create Escrow Transaction
            EscrowTransaction::create([
                'buyer_id' => $user->id,
                'seller_id' => $seller->id,
                'listing_id' => $listing->id,
                'amount' => $watch['price'],
                'commission_amount' => $watch['price'] * 0.05, // 5% commission
                'status' => $status,
                'razorpay_payment_id' => 'pay_' . Str::random(14),
                'shipping_provider' => $provider,
                'tracking_number' => $tracking,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ]);
        }
        $this->command->info("✅ Created 4 Purchase Histories (EscrowTransactions) for {$user->name}.");

        // 2. Seed some Listings (User as Seller)
        if ($user->hasRole('dealer')) {
            $myListings = [
                ['brand' => 'Audemars Piguet', 'model' => 'Royal Oak', 'ref' => '15500ST', 'price' => 45000],
                ['brand' => 'Rolex', 'model' => 'Daytona', 'ref' => '116500LN', 'price' => 32000],
            ];

            foreach ($myListings as $watch) {
                Listing::create([
                    'seller_id' => $user->id,
                    'brand' => $watch['brand'],
                    'model' => $watch['model'],
                    'reference_number' => $watch['ref'],
                    'watch_type' => 'Automatic',
                    'case_size' => '41mm',
                    'condition' => 'Mint',
                    'year_of_production' => '2023',
                    'accessories' => ['Box', 'Papers'],
                    'price' => $watch['price'],
                    'location' => 'Los Angeles, USA',
                    'status' => 'Live',
                    'is_verified' => true,
                    'images' => [
                        "https://ui-avatars.com/api/?background=random&size=800&name=" . urlencode($watch['brand'] . '+' . $watch['model'])
                    ],
                    'condition_notes' => "Seeded test listing by {$user->name}.",
                    'sale_method' => 'marketplace',
                ]);
            }
            $this->command->info("✅ Created 2 Live Listings for {$user->name}.");
        }
    }
}
