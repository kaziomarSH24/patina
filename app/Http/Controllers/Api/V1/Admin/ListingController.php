<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Resources\Admin\AdminListingResource;
use App\Http\Requests\Admin\UpdateListingStatusRequest;
use App\Http\Requests\Admin\UpdateListingRequest;
use App\Services\ListingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @group Admin Listings Management
 *
 * APIs for managing watch listings in the admin dashboard.
 */
class ListingController extends Controller
{
    protected ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }
    /**
     * List all listings
     *
     * Get all listings for admin panel including seller information and conversation counts.
     *
     * @apiResourceCollection App\Http\Resources\Admin\AdminListingResource
     * @apiResourceModel App\Models\Listing
     */
    public function index(Request $request): JsonResponse
    {
        $request->merge(['include' => 'seller']);
        $listings = $this->listingService->getAll(function ($query) {
            $query->withCount('conversations');
        });

        return response_success('Listings retrieved successfully', [
            'listings' => AdminListingResource::collection($listings)->response()->getData(true)
        ]);
    }

    /**
     * Get listing details
     *
     * Get a specific listing details for admin review.
     *
     * @urlParam id int required The ID of the listing. Example: 1
     * @apiResource App\Http\Resources\Admin\AdminListingResource
     * @apiResourceModel App\Models\Listing
     */
    public function show($id): JsonResponse
    {
        $listing = $this->listingService->getById($id, ['seller']);
        $listing->loadCount('conversations');

        return response_success('Listing retrieved successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }

    /**
     * Update listing status
     *
     * Update listing status (Live, Under Review, Rejected, etc.) and verification flag.
     *
     * @urlParam id int required The ID of the listing. Example: 1
     * @apiResource App\Http\Resources\Admin\AdminListingResource
     * @apiResourceModel App\Models\Listing
     */
    public function updateStatus(UpdateListingStatusRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        
        // Clear rejection reason if status is not 'Rejected'
        if (isset($data['status']) && $data['status'] !== 'Rejected') {
            $data['rejection_reason'] = null;
        }

        $listing = $this->listingService->update($id, $data);

        return response_success('Listing status updated successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }

    /**
     * Update listing details
     *
     * Update listing details directly from the admin panel.
     *
     * @urlParam id int required The ID of the listing. Example: 1
     * @apiResource App\Http\Resources\Admin\AdminListingResource
     * @apiResourceModel App\Models\Listing
     */
    public function update(UpdateListingRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        
        $listing = $this->listingService->update($id, $data);
        $listing->loadCount('conversations');

        return response_success('Listing updated successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }
}
