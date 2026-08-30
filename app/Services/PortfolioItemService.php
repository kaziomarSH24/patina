<?php

namespace App\Services;

use App\Models\PortfolioItem;
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
            
            // TODO: Fetch actual market price from MarketPrice model or TheWatchAPI
            // For now, generating a dummy current market value (e.g., 5-15% gain)
            $dummyMultiplier = 1 + (rand(5, 15) / 100);
            $currentValue = $paid * $dummyMultiplier;
            
            $gain = $currentValue - $paid;
            $gainPercentage = $paid > 0 ? ($gain / $paid) * 100 : 0;

            $totalPaid += $paid;
            $totalCurrentValue += $currentValue;

            $item->current_market_price = round($currentValue, 2);
            $item->gain_amount = round($gain, 2);
            $item->gain_percentage = round($gainPercentage, 2);

            return $item;
        });

        $totalGain = $totalCurrentValue - $totalPaid;
        $totalGainPercentage = $totalPaid > 0 ? ($totalGain / $totalPaid) * 100 : 0;

        return [
            'stats' => [
                'portfolio_value' => round($totalCurrentValue, 2),
                'total_paid' => round($totalPaid, 2),
                'total_gain_amount' => round($totalGain, 2),
                'total_gain_percentage' => round($totalGainPercentage, 2),
                'total_watches' => $holdings->count(),
                'liquidity_score' => 7.5, // Dummy liquidity score
            ],
            'holdings' => $holdings,
        ];
    }
}
