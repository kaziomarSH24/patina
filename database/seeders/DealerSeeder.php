<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dealers = [
            ['name' => 'John Doe', 'company' => 'Doe Timepieces', 'rating' => 4.8, 'reviews' => 120, 'city' => 'Mumbai'],
            ['name' => 'Michael Smith', 'company' => 'Smith & Co Watches', 'rating' => 4.9, 'reviews' => 340, 'city' => 'Delhi NCR'],
            ['name' => 'Sarah Johnson', 'company' => 'Johnson Horology', 'rating' => 4.5, 'reviews' => 45, 'city' => 'Bangalore'],
            ['name' => 'Rahul Sharma', 'company' => 'Sharma Vintage', 'rating' => 5.0, 'reviews' => 89, 'city' => 'Pune'],
            ['name' => 'David Lee', 'company' => 'Lee Luxury Watches', 'rating' => 4.7, 'reviews' => 210, 'city' => 'Chennai'],
            ['name' => 'Emily Chen', 'company' => 'Chen Collectibles', 'rating' => 4.6, 'reviews' => 150, 'city' => 'Hyderabad'],
            ['name' => 'James Bond', 'company' => '007 Watches', 'rating' => 4.9, 'reviews' => 500, 'city' => 'Kolkata'],
            ['name' => 'Amit Patel', 'company' => 'Patel Chronos', 'rating' => 4.4, 'reviews' => 30, 'city' => 'Ahmedabad'],
            ['name' => 'Sophia Martinez', 'company' => 'Martinez Fine Watches', 'rating' => 4.8, 'reviews' => 275, 'city' => 'Delhi NCR'],
            ['name' => 'Daniel Kim', 'company' => 'Kim Horology', 'rating' => 4.3, 'reviews' => 15, 'city' => 'Mumbai'],
            ['name' => 'Olivia Wilson', 'company' => 'Wilson Time', 'rating' => 4.7, 'reviews' => 190, 'city' => 'Bangalore'],
            ['name' => 'William Brown', 'company' => 'Brown & Sons', 'rating' => 4.9, 'reviews' => 420, 'city' => 'Pune'],
        ];

        foreach ($dealers as $index => $data) {
            $email = strtolower(str_replace(' ', '.', $data['name'])) . '@example.com';
            
            // Check if user already exists
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $email,
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'phone_number' => '+9198000' . str_pad($index, 5, '0', STR_PAD_LEFT),
                    'company_name' => $data['company'],
                    'kyc_status' => 'approved',
                    'account_standing' => 'good',
                    'average_rating' => $data['rating'],
                    'total_reviews' => $data['reviews'],
                    'avatar' => 'https://ui-avatars.com/api/?background=random&bold=true&name=' . urlencode($data['name']),
                ]);

                // Assign dealer role
                $user->assignRole('dealer');
            }
        }
    }
}
