<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Resources\ListingResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @group Discover Feed (Marketplace)
 *
 * Highly optimized swipe-style feed API for the mobile app marketplace.
 */
class DiscoverController extends Controller
{
    /**
     * Get Discover Feed (Swipe UI)
     *
     * Returns a cursor-paginated list of live & verified watches.
     * Supports advanced filtering: min_price, max_price, brand, watch_type.
     * 
     * @queryParam min_price int Filter by minimum budget. Example: 50000
     * @queryParam max_price int Filter by maximum budget. Example: 500000
     * @queryParam brand string Filter by brand name. Example: Rolex
     * @queryParam watch_type string Filter by type. Example: Diver
     * 
     * @apiResourceCollection App\Http\Resources\ListingResource
     * @apiResourceModel App\Models\Listing
     */
    public function index(Request $request): JsonResponse
    {
        $query = Listing::with('seller')
            ->where('status', 'Live')
            ->where('is_verified', true);

        // Budget filters
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->input('brand') . '%');
        }

        // Watch Type filter
        if ($request->filled('watch_type')) {
            $query->where('watch_type', 'like', '%' . $request->input('watch_type') . '%');
        }
        
        // Model filter
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->input('model') . '%');
        }

        // Condition filter
        if ($request->filled('condition')) {
            $query->where('condition', $request->input('condition'));
        }

        // Order by newest first (default for feed)
        $query->orderBy('created_at', 'desc');

        // Cursor Pagination for Swipe-style mobile UI (very fast, no page offsets)
        // Default size is 15 items per swipe load
        $limit = $request->input('per_page', 15);
        $listings = $query->cursorPaginate($limit);

        $message = $listings->isEmpty() 
            ? 'No listings found matching your criteria' 
            : 'Discover feed retrieved successfully';   

        return response_success($message, [
            'listings' => ListingResource::collection($listings)->response()->getData(true)
        ]);
    }
}
