<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Resources\ListingResource;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Services\ListingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    protected ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }
    /**
     * Get all verified and active listings for the Discover/Market views.
     */
    public function index(Request $request): JsonResponse
    {
        // Force the seller include
        $request->merge(['include' => 'seller']);

        $listings = $this->listingService->getAll(function ($query) {
            $query->where('status', 'Live')->where('is_verified', true);
        });

        return response_success('Listings retrieved successfully', [
            'listings' => ListingResource::collection($listings)->response()->getData(true)
        ]);
    }

    /**
     * Get a specific listing details.
     */
    public function show($id): JsonResponse
    {
        $listing = $this->listingService->getById($id, ['seller']);

        if ($listing->status !== 'Live' && (!Auth::guard('sanctum')->check() || Auth::guard('sanctum')->id() !== $listing->seller_id)) {
            return response_error('Listing not found or not available', [], 404);
        }

        return response_success('Listing retrieved successfully', [
            'listing' => new ListingResource($listing)
        ]);
    }

    /**
     * Create a new listing.
     */
    public function store(StoreListingRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        $listing = $this->listingService->createListingWithImages($request, $data);

        return response_success('Listing created successfully. Waiting for admin review.', [
            'listing' => new ListingResource($listing)
        ], 201);
    }

    /**
     * Update an existing listing.
     */
    public function update(UpdateListingRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        
        $listing = $this->listingService->updateListingWithImages($request, (int) $id, $data);

        return response_success('Listing updated successfully. Resubmitted for review.', [
            'listing' => new ListingResource($listing)
        ]);
    }

    /**
     * Get portfolio listings for the authenticated user.
     */
    public function userListings(Request $request): JsonResponse
    {
        $request->merge(['include' => 'seller']);
        $userId = Auth::id();
        
        $listings = $this->listingService->getAll(function ($query) use ($userId) {
            $query->where('seller_id', $userId);
        });

        return response_success('User portfolio retrieved successfully', [
            'listings' => ListingResource::collection($listings)->response()->getData(true)
        ]);
    }
}
