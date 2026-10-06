<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Listing;
use App\Models\EscrowTransaction;
use App\Models\KycDocument;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AnalyticsDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Historical Users (for Waitlist Growth chart)
        $dealerRole = Role::firstOrCreate(['name' => 'dealer', 'guard_name' => 'web']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        $now = Carbon::now();
        
        for ($i = 6; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i)->startOfMonth();
            $usersToCreate = rand(5, 15); // Random users per month
            
            for ($j = 0; $j < $usersToCreate; $j++) {
                $user = clone $month;
                $userDate = $user->addDays(rand(1, 25));
                
                $newUser = User::firstOrCreate(
                    ['email' => 'seeded'.$i.'_'.$j.'_'.uniqid().'@patinawatches.com'],
                    [
                        'name' => 'Seeded User ' . $i . '_' . $j,
                        'password' => Hash::make('password'),
                        'phone_number' => '01' . rand(700000000, 999999999),
                        'account_standing' => 'good',
                        'created_at' => $userDate,
                        'updated_at' => $userDate,
                    ]
                );

                // Assign random roles for Donut Chart
                if (rand(1, 100) > 40) {
                    $newUser->assignRole($dealerRole);
                } else {
                    $newUser->assignRole($customerRole);
                }

                // Seed KYC Documents for these users
                if (rand(1, 100) > 20) { // 80% have KYC
                    KycDocument::create([
                        'user_id' => $newUser->id,
                        'document_type' => 'passport',
                        'file_path' => 'dummy.pdf',
                        'status' => rand(1, 100) > 10 ? 'verified' : 'rejected', // 90% pass rate
                        'created_at' => $userDate,
                        'updated_at' => $userDate->copy()->addDays(rand(1, 3)),
                    ]);
                }
            }
        }

        // 2. Seed Historical Listings and Escrows
        $dealers = User::role('dealer')->get();
        if ($dealers->isEmpty()) return;

        // Seed 30 listings distributed over the last 60 days
        for ($k = 0; $k < 30; $k++) {
            $createdDate = $now->copy()->subDays(rand(5, 60));
            
            $status = 'Live';
            $randStat = rand(1, 100);
            if ($randStat <= 40) $status = 'Sold';
            elseif ($randStat <= 50) $status = 'Under Review';
            elseif ($randStat <= 60) $status = 'Rejected';

            // Review took between 2 and 48 hours
            $reviewHours = rand(2, 48);
            
            // If it's sold, it sold between 5 and 30 days after creation
            $sellDays = rand(5, 30);
            
            $updatedDate = clone $createdDate;
            if ($status == 'Sold') {
                $updatedDate->addDays($sellDays);
            } else {
                $updatedDate->addHours($reviewHours);
            }

            $listing = Listing::create([
                'seller_id' => $dealers->random()->id,
                'brand' => 'Rolex',
                'model' => 'Seeded Model ' . $k,
                'reference_number' => '116500LN',
                'price' => rand(5000, 45000),
                'status' => $status,
                'created_at' => $createdDate,
                'updated_at' => $updatedDate,
            ]);

            // Create Escrow Transactions for Sold/Live items
            if ($status == 'Sold') {
                EscrowTransaction::create([
                    'listing_id' => $listing->id,
                    'buyer_id' => User::role('customer')->inRandomOrder()->first()->id ?? $dealers->random()->id,
                    'seller_id' => $listing->seller_id,
                    'amount' => $listing->price,
                    'status' => 'Completed',
                    'created_at' => $updatedDate->copy()->subDays(2),
                    'updated_at' => $updatedDate,
                ]);
            } elseif ($status == 'Live' && rand(1, 100) > 80) { // 20% of live items have escrow in progress
                EscrowTransaction::create([
                    'listing_id' => $listing->id,
                    'buyer_id' => User::role('customer')->inRandomOrder()->first()->id ?? $dealers->random()->id,
                    'seller_id' => $listing->seller_id,
                    'amount' => $listing->price,
                    'status' => 'Confirmed',
                    'created_at' => $updatedDate,
                    'updated_at' => $updatedDate,
                ]);
            }
        }

        // Seed some recent photo reviews (last 7 days) for the Bar Chart
        for ($p = 0; $p < 15; $p++) {
            $recentCreated = $now->copy()->subDays(rand(0, 6))->subHours(rand(12, 24));
            $recentUpdated = clone $recentCreated;
            $recentUpdated->addHours(rand(2, 14)); // 2 to 14 hours review time

            Listing::create([
                'seller_id' => $dealers->random()->id,
                'brand' => 'Audemars Piguet',
                'model' => 'Review Seed ' . $p,
                'reference_number' => '15500ST',
                'price' => rand(15000, 35000),
                'status' => 'Live',
                'created_at' => $recentCreated,
                'updated_at' => $recentUpdated,
            ]);
        }
    }
}
