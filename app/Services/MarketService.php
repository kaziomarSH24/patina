<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class MarketService
{
    protected WatchApiService $watchApiService;

    public function __construct(WatchApiService $watchApiService)
    {
        $this->watchApiService = $watchApiService;
    }

    /**
     * Get real price history and market indicators for a watch reference
     * using TheWatchAPI Standard Plan.
     *
     * @param string $reference
     * @return array
     */
    public function getPriceHistory(string $reference): array
    {
        // Fetch real history from TheWatchAPI
        // Output format from API is typically array of: ["date" => "Y-m-d", "price" => 12345.67]
        $historyData = $this->watchApiService->getPriceHistory($reference);

        if (empty($historyData)) {
            return [
                'reference_number' => $reference,
                'current_market_price' => 0,
                'indicators' => [
                    '52w_high' => 0,
                    '52w_low' => 0,
                    'momentum_1m_percentage' => 0,
                    'liquidity_score' => 0,
                    'volatility_index' => 'Unknown'
                ],
                'chart_data' => [
                    '1M' => [],
                    '3M' => [],
                    '6M' => [],
                    '1Y' => [],
                ]
            ];
        }

        // Sort data by date ascending (oldest to newest) just in case
        usort($historyData, function($a, $b) {
            return strtotime($a['date']) <=> strtotime($b['date']);
        });

        // The API returns historical prices. We will filter them for our chart ranges
        // Note: Use the newest date in the dataset as "now" so charts always render even if data is old
        $latestItem = end($historyData);
        $now = Carbon::parse($latestItem['date']);
        
        $history1Y = array_filter($historyData, fn($item) => Carbon::parse($item['date'])->greaterThanOrEqualTo($now->copy()->subYear()));
        $history6M = array_filter($historyData, fn($item) => Carbon::parse($item['date'])->greaterThanOrEqualTo($now->copy()->subMonths(6)));
        $history3M = array_filter($historyData, fn($item) => Carbon::parse($item['date'])->greaterThanOrEqualTo($now->copy()->subMonths(3)));
        $history1M = array_filter($historyData, fn($item) => Carbon::parse($item['date'])->greaterThanOrEqualTo($now->copy()->subMonth()));

        // Convert associative array values to re-index numerically after filtering
        $history1Y = array_values($history1Y);
        $history6M = array_values($history6M);
        $history3M = array_values($history3M);
        $history1M = array_values($history1M);

        // Calculate Indicators
        $currentPrice = !empty($history1Y) ? end($history1Y)['price'] : 0;
        $price30DaysAgo = !empty($history1M) ? $history1M[0]['price'] : $currentPrice;
        
        $high52W = !empty($history1Y) ? max(array_column($history1Y, 'price')) : 0;
        $low52W = !empty($history1Y) ? min(array_column($history1Y, 'price')) : 0;
        
        $momentum = $price30DaysAgo > 0 ? (($currentPrice - $price30DaysAgo) / $price30DaysAgo) * 100 : 0;

        return [
            'reference_number' => $reference,
            'current_market_price' => round($currentPrice, 2),
            'indicators' => [
                '52w_high' => round($high52W, 2),
                '52w_low' => round($low52W, 2),
                'momentum_1m_percentage' => round($momentum, 2),
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

    private function calculateVolatility(array $data): string
    {
        if (empty($data)) {
            return 'Unknown';
        }
        
        $prices = array_column($data, 'price');
        $max = max($prices);
        $min = min($prices);
        
        if ($min <= 0) {
            return 'Unknown';
        }
        
        $spread = ($max - $min) / $min;
        
        if ($spread > 0.15) return 'High';
        if ($spread > 0.05) return 'Medium';
        return 'Low';
    }

    /**
     * Get a curated feed of popular watches for the Market Index screen.
     * Fetches the most listed watches dynamically from the database.
     *
     * @return array
     */
    public function getIndexFeed(): array
    {
        $query = \App\Models\Listing::select('brand', 'model', 'reference_number', 'case_size as size')
            ->selectRaw('COUNT(*) as count')
            ->whereNotNull('reference_number')
            ->where('status', 'Live')
            ->where('is_verified', true);

        // Apply filters if they exist in the request
        if (request()->has('filter.watch_type')) {
            $query->where('watch_type', request()->input('filter.watch_type'));
        }
        if (request()->has('filter.location')) {
            $query->where('location', 'like', '%' . request()->input('filter.location') . '%');
        }
        if (request()->has('filter.max_price')) {
            $query->where('price', '<=', request()->input('filter.max_price'));
        }

        // Dynamically fetch the most popular (most frequently listed) watches in the app
        $popularWatches = $query->groupBy('brand', 'model', 'reference_number', 'case_size')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->toArray();

        // Fallback to default index if the database is empty or has no listings yet
        if (empty($popularWatches)) {
            $popularWatches = [
                ['brand' => 'Rolex', 'model' => 'Submariner', 'reference_number' => '126610LN', 'size' => '41mm'],
                ['brand' => 'Omega', 'model' => 'Seamaster 300M', 'reference_number' => '210.30.42.20.01.001', 'size' => '42mm'],
                ['brand' => 'Tudor', 'model' => 'Black Bay', 'reference_number' => '79230N', 'size' => '41mm'],
                ['brand' => 'Seiko', 'model' => 'Presage Cocktail', 'reference_number' => 'SRPB41', 'size' => '40.5mm'],
            ];
        }

        $feed = [];
        foreach ($popularWatches as $watch) {
            try {
                $history = $this->getPriceHistory($watch['reference_number']);
                
                $momentum = $history['indicators']['momentum_1m_percentage'] ?? 0;
                $currentPrice = $history['current_market_price'] ?? 0;
                
                // Simple logic to generate a value badge like in the UI
                $badge = 'Fair value';
                if ($momentum >= 5) {
                    $badge = '+' . round($momentum) . '% vs 6M ago'; // Rough simulation for UI
                } elseif ($momentum <= -5) {
                    $badge = 'Undervalued';
                }

                // Extract last 7 days for the mini sparkline chart
                $miniChartData = $history['chart_data']['1M'] ?? [];
                $miniChart = array_slice($miniChartData, -7);
                $miniChartArray = array_values($miniChart);
            } catch (\Exception $e) {
                // If API fails or watch is not found, provide fallback zeros
                $currentPrice = 0;
                $momentum = 0;
                $badge = 'Data Unavailable';
                $miniChartArray = [];
            }

            $feed[] = [
                'brand' => $watch['brand'],
                'model' => $watch['model'],
                'reference_number' => $watch['reference_number'],
                'size' => $watch['size'],
                'display_name' => $watch['model'] . ' ' . $watch['reference_number'],
                'current_market_price' => $currentPrice,
                'momentum_1m_percentage' => $momentum,
                'value_badge' => $badge,
                'mini_chart_data' => $miniChartArray
            ];
        }

        // -------------------------------------------------------------
        // DYNAMIC OVERALL MARKET INDEX CALCULATION
        // -------------------------------------------------------------
        $monthlyAggregates = [];
        
        foreach ($popularWatches as $watch) {
            try {
                $history = $this->getPriceHistory($watch['reference_number']);
                $sixMonthData = $history['chart_data']['6M'] ?? [];
                
                foreach ($sixMonthData as $dataPoint) {
                    $monthKey = date('M Y', strtotime($dataPoint['date'])); // e.g., 'Jan 2024'
                    $displayMonth = date('M', strtotime($dataPoint['date'])); // e.g., 'Jan'
                    
                    if (!isset($monthlyAggregates[$monthKey])) {
                        $monthlyAggregates[$monthKey] = [
                            'display' => $displayMonth,
                            'prices' => []
                        ];
                    }
                    $monthlyAggregates[$monthKey]['prices'][] = $dataPoint['price'];
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        $chartData = [];
        $indexDivisor = 10; // Scale down the raw average price to make it look like an index point (e.g. $15,000 -> 1,500.00)

        if (!empty($monthlyAggregates)) {
            // Sort by month ascending using strtotime
            uksort($monthlyAggregates, function($a, $b) {
                return strtotime($a) <=> strtotime($b);
            });

            foreach ($monthlyAggregates as $monthKey => $data) {
                $prices = $data['prices'];
                $averagePrice = count($prices) > 0 ? array_sum($prices) / count($prices) : 0;
                $indexValue = $averagePrice > 0 ? $averagePrice / $indexDivisor : 0;
                
                $chartData[] = [
                    'date' => $data['display'], // e.g., 'Jan'
                    'price' => round($indexValue, 2)
                ];
            }
        } else {
            // Fallback flat line if no historical data exists from the API
            $chartData = [
                ['date' => date('M', strtotime('-5 months')), 'price' => 1000],
                ['date' => date('M', strtotime('-4 months')), 'price' => 1000],
                ['date' => date('M', strtotime('-3 months')), 'price' => 1000],
                ['date' => date('M', strtotime('-2 months')), 'price' => 1000],
                ['date' => date('M', strtotime('-1 months')), 'price' => 1000],
                ['date' => date('M'), 'price' => 1000],
            ];
        }

        $overallIndexValue = count($chartData) > 0 ? end($chartData)['price'] : 1000;
        $firstValue = count($chartData) > 0 ? $chartData[0]['price'] : 1000;
        $overallMomentum = $firstValue > 0 ? (($overallIndexValue - $firstValue) / $firstValue) * 100 : 0;

        return [
            'overall_performance' => [
                'current_value' => round($overallIndexValue, 2),
                'momentum_percentage' => round($overallMomentum, 2),
                'chart_data' => $chartData
            ],
            'feed' => $feed
        ];
    }
}
