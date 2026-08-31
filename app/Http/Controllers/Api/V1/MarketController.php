<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Market & Price Index
 *
 * APIs for rendering Watch Market Graphs and Price Indicators.
 */
class MarketController extends Controller
{
    protected MarketService $marketService;

    public function __construct(MarketService $marketService)
    {
        $this->marketService = $marketService;
    }

    /**
     * Get Price History & Indicators
     *
     * Returns 1M, 3M, 6M, and 1Y price history data points for rendering charts.
     * Also includes market indicators like Momentum, 52W High/Low, and Liquidity.
     *
     * @urlParam reference string required The watch reference number (e.g., 116500LN).
     */
    public function priceHistory(string $reference): JsonResponse
    {
        if (empty(trim($reference))) {
            return response_error('Reference number is required.', [], 400);
        }

        $marketData = $this->marketService->getPriceHistory($reference);

        return response_success('Market data retrieved successfully', $marketData);
    }
}
