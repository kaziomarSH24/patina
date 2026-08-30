<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarketPrice;

class MarketPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketPrice::updateOrCreate(
            ['brand' => 'Rolex', 'model' => 'Datejust 41'],
            [
                'current_price' => 8500.00,
                'mom_change' => 2.5,
                'liquidity_score' => 8.5,
                'volatility_score' => 4.2
            ]
        );

        MarketPrice::updateOrCreate(
            ['brand' => 'Omega', 'model' => 'Seamaster 300M'],
            [
                'current_price' => 4200.00,
                'mom_change' => 1.2,
                'liquidity_score' => 7.8,
                'volatility_score' => 5.1
            ]
        );

        MarketPrice::updateOrCreate(
            ['brand' => 'IWC', 'model' => 'Portugieser Auto'],
            [
                'current_price' => 9100.00,
                'mom_change' => -0.5,
                'liquidity_score' => 6.5,
                'volatility_score' => 3.8
            ]
        );
    }
}
