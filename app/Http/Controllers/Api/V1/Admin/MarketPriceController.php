<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminMarketPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketPriceController extends Controller
{
    protected AdminMarketPriceService $marketPriceService;

    public function __construct(AdminMarketPriceService $marketPriceService)
    {
        $this->marketPriceService = $marketPriceService;
    }

    /**
     * Get all tracked market prices
     */
    public function index(): JsonResponse
    {
        $mapped = $this->marketPriceService->getTrackedPrices();

        return response_success('Market prices retrieved successfully', [
            'data' => $mapped
        ]);
    }

    /**
     * Add a new model to track
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
        ]);

        $this->marketPriceService->addTrackedModel($data);

        return response_success('Model added to tracking list successfully', []);
    }

    /**
     * Trigger a manual refresh of market prices using TheWatchAPI
     */
    public function refresh(): JsonResponse
    {
        $updatedCount = $this->marketPriceService->refreshPrices();

        if ($updatedCount === 0) {
            return response_error('No prices could be updated. Please check API configuration or reference numbers.', [], 400);
        }

        return response_success('Market prices synced successfully', []);
    }

    /**
     * Delete a tracked model
     */
    public function destroy($id): JsonResponse
    {
        $price = \App\Models\MarketPrice::findOrFail($id);
        $price->delete();
        return response_success('Model removed from tracking list', []);
    }
}
