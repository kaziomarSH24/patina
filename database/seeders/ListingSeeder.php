<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\User;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(3)->get();
        if ($users->isEmpty()) {
            $users = User::factory(3)->create();
        }

        $watches = [
            [
                'brand' => 'Rolex',
                'model' => 'Submariner Date 126610LN',
                'watch_type' => 'Automatic',
                'reference_number' => '126610LN',
                'price' => 950000,
                'condition' => 'Mint',
                'case_size' => '41mm',
                'year_of_production' => '2020',
                'location' => 'Delhi NCR',
            ],
            [
                'brand' => 'Omega',
                'model' => 'Seamaster 300M',
                'watch_type' => 'Automatic',
                'reference_number' => '210.30.42.20.01.001',
                'price' => 720000,
                'condition' => 'Excellent',
                'case_size' => '42mm',
                'year_of_production' => '2019',
                'location' => 'Mumbai',
            ],
            [
                'brand' => 'Tudor',
                'model' => 'Black Bay Chronograph',
                'watch_type' => 'Automatic',
                'reference_number' => '79360N',
                'price' => 545000,
                'condition' => 'Good',
                'case_size' => '41mm',
                'year_of_production' => '2021',
                'location' => 'Bangalore',
            ],
            [
                'brand' => 'Seiko',
                'model' => 'Prospex Diver',
                'watch_type' => 'Automatic',
                'reference_number' => 'SPB143',
                'price' => 185000,
                'condition' => 'Mint',
                'case_size' => '40.5mm',
                'year_of_production' => '2020',
                'location' => 'Pune',
            ],
            [
                'brand' => 'Patek Philippe',
                'model' => 'Nautilus',
                'watch_type' => 'Automatic',
                'reference_number' => '5711/1A',
                'price' => 8500000,
                'condition' => 'Excellent',
                'case_size' => '40mm',
                'year_of_production' => '2018',
                'location' => 'Delhi NCR',
            ],
            [
                'brand' => 'Audemars Piguet',
                'model' => 'Royal Oak',
                'watch_type' => 'Automatic',
                'reference_number' => '15500ST',
                'price' => 4500000,
                'condition' => 'Good',
                'case_size' => '41mm',
                'year_of_production' => '2022',
                'location' => 'Mumbai',
            ],
            [
                'brand' => 'Rolex',
                'model' => 'Daytona Cosmograph',
                'watch_type' => 'Automatic',
                'reference_number' => '116500LN',
                'price' => 3200000,
                'condition' => 'Mint',
                'case_size' => '40mm',
                'year_of_production' => '2023',
                'location' => 'Bangalore',
            ],
            [
                'brand' => 'Grand Seiko',
                'model' => 'Snowflake',
                'watch_type' => 'Spring Drive',
                'reference_number' => 'SBGA211',
                'price' => 450000,
                'condition' => 'Excellent',
                'case_size' => '41mm',
                'year_of_production' => '2021',
                'location' => 'Chennai',
            ],
            [
                'brand' => 'Cartier',
                'model' => 'Santos de Cartier',
                'watch_type' => 'Automatic',
                'reference_number' => 'WSSA0018',
                'price' => 620000,
                'condition' => 'Mint',
                'case_size' => '39.8mm',
                'year_of_production' => '2023',
                'location' => 'Kolkata',
            ],
            [
                'brand' => 'IWC',
                'model' => 'Portugieser Chronograph',
                'watch_type' => 'Automatic',
                'reference_number' => 'IW371604',
                'price' => 680000,
                'condition' => 'Excellent',
                'case_size' => '41mm',
                'year_of_production' => '2019',
                'location' => 'Hyderabad',
            ],
            [
                'brand' => 'Breitling',
                'model' => 'Navitimer B01',
                'watch_type' => 'Automatic',
                'reference_number' => 'AB0138241G1A1',
                'price' => 710000,
                'condition' => 'Good',
                'case_size' => '43mm',
                'year_of_production' => '2020',
                'location' => 'Mumbai',
            ],
            [
                'brand' => 'Vacheron Constantin',
                'model' => 'Overseas',
                'watch_type' => 'Automatic',
                'reference_number' => '4500V',
                'price' => 2800000,
                'condition' => 'Mint',
                'case_size' => '41mm',
                'year_of_production' => '2022',
                'location' => 'Delhi NCR',
            ],
            [
                'brand' => 'Rolex',
                'model' => 'Datejust 36',
                'watch_type' => 'Automatic',
                'reference_number' => '126234',
                'price' => 850000,
                'condition' => 'Excellent',
                'case_size' => '36mm',
                'year_of_production' => '2021',
                'location' => 'Pune',
            ],
            [
                'brand' => 'Omega',
                'model' => 'Speedmaster Moonwatch',
                'watch_type' => 'Manual',
                'reference_number' => '310.30.42.50.01.002',
                'price' => 650000,
                'condition' => 'Mint',
                'case_size' => '42mm',
                'year_of_production' => '2023',
                'location' => 'Bangalore',
            ],
            [
                'brand' => 'Tudor',
                'model' => 'Pelagos 39',
                'watch_type' => 'Automatic',
                'reference_number' => '25407N',
                'price' => 380000,
                'condition' => 'Mint',
                'case_size' => '39mm',
                'year_of_production' => '2023',
                'location' => 'Mumbai',
            ],
        ];

        foreach ($watches as $index => $watch) {
            $seller = $users[$index % $users->count()];

            Listing::create(array_merge($watch, [
                'seller_id' => $seller->id,
                'sale_method' => 'marketplace',
                'status' => 'Live',
                'is_verified' => true,
                'condition_notes' => 'A beautiful timepiece in ' . strtolower($watch['condition']) . ' condition.',
                'accessories' => ['Box', 'Papers'],
                // Give a unique image based on watch model text
                'images' => [
                    'https://ui-avatars.com/api/?background=random&size=800&name=' . urlencode($watch['brand'] . '+' . $watch['model'])
                ],
            ]));
        }
    }
}
