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

/**
 * @group Listings (Public & User)
 *
 * APIs for viewing public listings and managing the user's own portfolio.
 */
class ListingController extends Controller
{
    protected ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }
    /**
     * Public Market Listings
     *
     * Get all verified and active listings for the Discover/Market views.
     *
     * @apiResourceCollection App\Http\Resources\ListingResource
     * @apiResourceModel App\Models\Listing
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
     * Show Public Listing
     *
     * Get details of a specific listing. Unauthenticated users can only see live listings.
     *
     * @urlParam id int required The ID of the listing. Example: 1
     * @apiResource App\Http\Resources\ListingResource
     * @apiResourceModel App\Models\Listing
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
     * Create Listing
     *
     * Create a new listing. Requires the user to have a 'Verified' KYC status.
     *
     * @apiResource App\Http\Resources\ListingResource
     * @apiResourceModel App\Models\Listing
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
     * Update Listing
     *
     * Update an existing listing. Will resubmit the listing for admin review.
     *
     * @urlParam id int required The ID of the listing to update. Example: 1
     * @apiResource App\Http\Resources\ListingResource
     * @apiResourceModel App\Models\Listing
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
     * My Portfolio
     *
     * Get all listings (regardless of status) belonging to the authenticated user.
     *
     * @apiResourceCollection App\Http\Resources\ListingResource
     * @apiResourceModel App\Models\Listing
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
