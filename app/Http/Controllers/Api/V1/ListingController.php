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
    protected \App\Services\MarketService $marketService;

    public function __construct(ListingService $listingService, \App\Services\MarketService $marketService)
    {
        $this->listingService = $listingService;
        $this->marketService = $marketService;
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

        // Fetch market data for this listing
        $marketData = null;
        if (!empty($listing->reference_number)) {
            try {
                $marketData = $this->marketService->getPriceHistory($listing->reference_number);
            } catch (\Exception $e) {
                // Ignore API failures and just return null market data
                $marketData = null;
            }
        }

        return response_success('Listing retrieved successfully', [
            'listing' => new ListingResource($listing),
            'market_data' => $marketData
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
        $user = Auth::user();

        // Verify Razorpay Payment for Non-Dealers
        if (!$user->hasRole('dealer')) {
            try {
                $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                
                $attributes = [
                    'razorpay_order_id' => $data['razorpay_order_id'],
                    'razorpay_payment_id' => $data['razorpay_payment_id'],
                    'razorpay_signature' => $data['razorpay_signature']
                ];
                
                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
                return response_error('Payment verification failed. Invalid signature.', [], 400);
            }
        }
        
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

    /**
     * Delete Listing
     *
     * Delete a listing. Only the owner can delete it, and only if it's not Sold.
     *
     * @urlParam id int required The ID of the listing to delete. Example: 1
     */
    public function destroy($id): JsonResponse
    {
        $listing = $this->listingService->getById($id);

        if ($listing->seller_id !== Auth::id()) {
            return response_error('Unauthorized action.', [], 403);
        }

        if ($listing->status === 'Sold') {
            return response_error('Cannot delete a sold listing.', [], 400);
        }

        $this->listingService->delete($id);

        return response_success('Listing deleted successfully.');
    }
}
