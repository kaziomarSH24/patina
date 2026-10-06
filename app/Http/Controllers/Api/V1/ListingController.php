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

    public function index(Request $request): JsonResponse
    {
        $request->merge(['include_seller' => true]);
        
        $listings = $this->listingService->getPublicListings($request->all());

        return response_success('Market listings retrieved successfully.', [
            'listings' => ListingResource::collection($listings)->response()->getData(true)
        ]);
    }

    public function store(StoreListingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $listingData = $data;

        // Check if user has credits. If not, verify Razorpay payment for listing fee.
        if ($user->available_listing_credits <= 0) {
            try {
                $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                
                $attributes = [
                    'razorpay_order_id' => $data['razorpay_order_id'],
                    'razorpay_payment_id' => $data['razorpay_payment_id'],
                    'razorpay_signature' => $data['razorpay_signature']
                ];
                
                $api->utility->verifyPaymentSignature($attributes);
                
                $listingData['razorpay_payment_id'] = $data['razorpay_payment_id'];
                $listingData['used_free_credit'] = false;
            } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
                return response_error('Payment verification failed. Invalid signature.', [], 400);
            }
        } else {
            // Deduct 1 credit if they used a free listing credit
            $user->decrement('available_listing_credits');
            $listingData['used_free_credit'] = true;
        }
        
        $listing = $this->listingService->createListingWithImages($request, $listingData);

        return response_success('Listing created successfully.', [
            'listing' => new ListingResource($listing)
        ], 201);
    }

    public function show($id): JsonResponse
    {
        request()->merge(['include_seller' => true]);
        
        $listing = $this->listingService->getListingById($id);

        if (!$listing || ($listing->status !== 'Live' && $listing->status !== 'Sold' && $listing->user_id !== Auth::id())) {
            return response_error('Listing not found or unavailable.', [], 404);
        }

        $this->marketService->trackView($listing);

        return response_success('Listing details retrieved successfully.', [
            'listing' => new ListingResource($listing)
        ]);
    }

    public function update(UpdateListingRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        
        $listing = Listing::where('user_id', Auth::id())->find($id);

        if (!$listing) {
            return response_error('Listing not found or you do not have permission to edit it.', [], 404);
        }

        if ($listing->status === 'Sold') {
            return response_error('Cannot edit a listing that has already been sold.', [], 400);
        }

        $listing = $this->listingService->updateListing($listing, $data);

        return response_success('Listing updated successfully.', [
            'listing' => new ListingResource($listing)
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $listing = Listing::where('user_id', Auth::id())->find($id);

        if (!$listing) {
            return response_error('Listing not found or you do not have permission to delete it.', [], 404);
        }

        if ($listing->status === 'Sold') {
            return response_error('Cannot delete a sold listing.', [], 400);
        }

        $this->listingService->deleteListing($listing);

        return response_success('Listing deleted successfully.');
    }
}
