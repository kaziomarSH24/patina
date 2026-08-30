<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\PortfolioItem;
use App\Services\PortfolioItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    protected PortfolioItemService $portfolioItemService;

    public function __construct(PortfolioItemService $portfolioItemService)
    {
        $this->portfolioItemService = $portfolioItemService;
    }

    /**
     * Get user's portfolio holdings with stats.
     */
    public function holdings(): JsonResponse
    {
        $userId = Auth::id();
        $data = $this->portfolioItemService->getHoldingsWithStats($userId);

        return response_success('Portfolio holdings fetched successfully', $data);
    }

    /**
     * Store a new holding in the portfolio.
     */
    public function storeHolding(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date|before_or_equal:today',
        ]);

        $validated['user_id'] = Auth::id();

        $portfolioItem = $this->portfolioItemService->create($validated);

        return response_success('Portfolio item added successfully', [
            'item' => $portfolioItem
        ], 201);
    }

    /**
     * Update an existing portfolio holding.
     */
    public function updateHolding(Request $request, int $id): JsonResponse
    {
        $portfolioItem = PortfolioItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'brand' => 'sometimes|required|string|max:255',
            'model' => 'sometimes|required|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'purchase_price' => 'sometimes|required|numeric|min:0',
            'purchase_date' => 'sometimes|required|date|before_or_equal:today',
        ]);

        $portfolioItem = $this->portfolioItemService->update($id, $validated);

        return response_success('Portfolio item updated successfully', [
            'item' => $portfolioItem
        ]);
    }

    /**
     * Delete a portfolio holding.
     */
    public function destroyHolding(int $id): JsonResponse
    {
        $portfolioItem = PortfolioItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $this->portfolioItemService->delete($id);

        return response_success('Portfolio item removed successfully');
    }

    /**
     * Get user's active/sold listings.
     */
    public function listings(): JsonResponse
    {
        $userId = Auth::id();
        
        // Grouping listings by status
        $listings = Listing::where('seller_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $groupedListings = [
            'live' => $listings->where('status', 'Live')->values(),
            'under_review' => $listings->whereIn('status', ['Under Review', 'Pending'])->values(),
            'sold' => $listings->where('status', 'Sold')->values(),
            'rejected' => $listings->where('status', 'Rejected')->values(),
        ];

        return response_success('Portfolio listings fetched successfully', [
            'stats' => [
                'total_listings' => $listings->count(),
                'live_listings' => count($groupedListings['live']),
                'sold_listings' => count($groupedListings['sold']),
            ],
            'listings' => $groupedListings
        ]);
    }
}
