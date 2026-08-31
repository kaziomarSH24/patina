<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class MarketService
{
    /**
     * Get simulated price history and market indicators for a watch reference.
     * Since the Free Tier of TheWatchAPI blocks history, this generates
     * realistic dummy data for the frontend to render graphs.
     *
     * @param string $reference
     * @return array
     */
    public function getPriceHistory(string $reference): array
    {
        // Generate a base price deterministically based on the reference string length/chars
        // So the same reference always gets roughly the same graph base.
        $baseSeed = crc32($reference);
        $basePrice = 5000 + ($baseSeed % 15000); // Base price between $5k and $20k

        // Generate 1 Year of daily data points
        $history1Y = $this->generateTimeSeriesData($basePrice, 365, 0.02); // 2% daily volatility
        
        // Extract ranges
        $history6M = array_slice($history1Y, -180);
        $history3M = array_slice($history1Y, -90);
        $history1M = array_slice($history1Y, -30);

        // Calculate Indicators
        $currentPrice = end($history1Y)['price'];
        $price30DaysAgo = $history1M[0]['price'];
        
        $high52W = max(array_column($history1Y, 'price'));
        $low52W = min(array_column($history1Y, 'price'));
        
        $momentum = (($currentPrice - $price30DaysAgo) / $price30DaysAgo) * 100;
        
        // Simulated liquidity score based on reference (1-10)
        $liquidity = 5 + (($baseSeed % 50) / 10); 

        return [
            'reference_number' => $reference,
            'current_market_price' => round($currentPrice, 2),
            'indicators' => [
                '52w_high' => round($high52W, 2),
                '52w_low' => round($low52W, 2),
                'momentum_1m_percentage' => round($momentum, 2),
                'liquidity_score' => round($liquidity, 1),
                'volatility_index' => $this->calculateVolatility($history3M)
            ],
            'chart_data' => [
                '1M' => $history1M,
                '3M' => $history3M,
                '6M' => $history6M,
                '1Y' => $history1Y,
            ]
        ];
    }

    /**
     * Generate realistic looking random walk time series data.
     */
    private function generateTimeSeriesData(float $basePrice, int $days, float $volatility): array
    {
        $data = [];
        $currentPrice = $basePrice;
        
        // Start date is $days ago
        $date = Carbon::now()->subDays($days);

        for ($i = 0; $i < $days; $i++) {
            // Random daily movement between -volatility and +volatility
            $movement = (mt_rand(-100, 100) / 100) * $volatility;
            
            // Add a slight upward drift overall (0.01%)
            $currentPrice = $currentPrice * (1 + $movement + 0.0001);
            
            $data[] = [
                'date' => $date->copy()->addDays($i)->format('Y-m-d'),
                'price' => round($currentPrice, 2)
            ];
        }

        return $data;
    }

    private function calculateVolatility(array $data): string
    {
        // Simple mock volatility based on data spread
        $prices = array_column($data, 'price');
        $max = max($prices);
        $min = min($prices);
        
        $spread = ($max - $min) / $min;
        
        if ($spread > 0.15) return 'High';
        if ($spread > 0.05) return 'Medium';
        return 'Low';
    }
}
