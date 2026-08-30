<?php

namespace App\Services;

use App\Models\PortfolioItem;
use App\Models\MarketPrice;
use Illuminate\Support\Facades\Auth;

class PortfolioItemService extends BaseService
{
    protected string $modelClass = PortfolioItem::class;
    protected bool $cachePerUser = true;

    protected function getAllowedFilters(): array
    {
        return [
            'brand',
            'model',
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            'user',
        ];
    }

    protected function getAllowedSorts(): array
    {
        return [
            'purchase_date',
            'purchase_price',
            'created_at',
        ];
    }

    /**
     * Get user's holdings with calculated portfolio statistics.
     */
    public function getHoldingsWithStats(int $userId): array
    {
        $holdings = PortfolioItem::where('user_id', $userId)->orderBy('purchase_date', 'desc')->get();

        $totalPaid = 0;
        $totalCurrentValue = 0;

        $holdings->transform(function ($item) use (&$totalPaid, &$totalCurrentValue) {
            $paid = (float) $item->purchase_price;
            
            // Fetch actual market price from MarketPrice table
            $marketData = MarketPrice::where('brand', $item->brand)
                                     ->where('model', $item->model)
                                     ->first();
            
            // If market price exists, use it. Otherwise fallback to purchase price.
            $currentValue = $marketData ? (float) $marketData->current_price : $paid;
            
            $gain = $currentValue - $paid;
            $gainPercentage = $paid > 0 ? ($gain / $paid) * 100 : 0;

            $totalPaid += $paid;
            $totalCurrentValue += $currentValue;

            $item->current_market_price = round($currentValue, 2);
            $item->gain_amount = round($gain, 2);
            $item->gain_percentage = round($gainPercentage, 2);
            $item->liquidity_score = $marketData ? (float) $marketData->liquidity_score : null;

            return $item;
        });

        $totalGain = $totalCurrentValue - $totalPaid;
        $totalGainPercentage = $totalPaid > 0 ? ($totalGain / $totalPaid) * 100 : 0;

        // Calculate average liquidity score from holdings
        $liquidityScores = $holdings->pluck('liquidity_score')->filter();
        $averageLiquidity = $liquidityScores->count() > 0 ? $liquidityScores->average() : 0;

        return [
            'stats' => [
                'portfolio_value' => round($totalCurrentValue, 2),
                'total_paid' => round($totalPaid, 2),
                'total_gain_amount' => round($totalGain, 2),
                'total_gain_percentage' => round($totalGainPercentage, 2),
                'total_watches' => $holdings->count(),
                'liquidity_score' => round($averageLiquidity, 1),
            ],
            'holdings' => $holdings,
        ];
    }
}
