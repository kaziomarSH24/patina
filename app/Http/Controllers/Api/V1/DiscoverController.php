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
    public function index(Request $request): JsonResponse
    {
        $query = Listing::select('listings.*')
            ->leftJoin('dealer_profiles', 'listings.seller_id', '=', 'dealer_profiles.user_id')
            ->leftJoin('subscription_plans', 'dealer_profiles.subscription_plan_id', '=', 'subscription_plans.id')
            ->with('seller')
            ->where('listings.status', 'Live')
            ->where('listings.is_verified', true);

        // Budget filters
        if ($request->filled('min_price')) {
            $query->where('listings.price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('listings.price', '<=', $request->input('max_price'));
        }

        // Brand & Type
        if ($request->filled('brand')) {
            $query->where('listings.brand', $request->input('brand'));
        }
        if ($request->filled('watch_type')) {
            $query->where('listings.watch_type', $request->input('watch_type'));
        }
        if ($request->filled('condition')) {
            $query->where('listings.condition', $request->input('condition'));
        }
        
        // Sorting logic based on Subscription Tier priority (Highest priority first), then newest
        $query->orderByRaw('COALESCE(subscription_plans.discovery_priority, 0) DESC')
              ->orderBy('listings.created_at', 'desc');

        // Since we are using complex joins and orderByRaw, we switch from cursorPaginate to simplePaginate
        // simplePaginate is just as fast as cursorPaginate (no COUNT query) and works seamlessly with joins.
        $limit = $request->input('per_page', 15);
        $listings = $query->simplePaginate($limit);

        $message = $listings->isEmpty() 
            ? 'No listings found matching your criteria' 
            : 'Discover feed retrieved successfully';   

        return response_success($message, [
            'listings' => ListingResource::collection($listings)->response()->getData(true)
        ]);
    }
}
