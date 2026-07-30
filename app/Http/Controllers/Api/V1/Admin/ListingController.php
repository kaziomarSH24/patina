<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Resources\Admin\AdminListingResource;
use App\Http\Requests\Admin\UpdateListingStatusRequest;
use App\Services\ListingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ListingController extends Controller
{
    protected ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }
    /**
     * Get all listings for admin panel.
     */
    public function index(Request $request): JsonResponse
    {
        $request->merge(['include' => 'seller']);
        $listings = $this->listingService->getAll();

        return response_success('Listings retrieved successfully', [
            'listings' => AdminListingResource::collection($listings)->response()->getData(true)
        ]);
    }

    /**
     * Get a specific listing details for admin review.
     */
    public function show($id): JsonResponse
    {
        $listing = $this->listingService->getById($id, ['seller']);

        return response_success('Listing retrieved successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }

    /**
     * Update listing status and verification.
     */
    public function updateStatus(UpdateListingStatusRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        
        $listing = $this->listingService->update($id, $data);

        return response_success('Listing status updated successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }
}
