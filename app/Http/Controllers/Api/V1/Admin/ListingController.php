<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Requests\Admin\UpdateListingStatusRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Http\Resources\Admin\AdminListingResource;
use App\Services\ListingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class ListingController extends Controller
{
    protected ListingService $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status');
        
        $query = Listing::with(['seller', 'offers', 'conversations'])->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $listings = $query->paginate($perPage);

        return response_success('Listings retrieved successfully', [
            'listings' => AdminListingResource::collection($listings)->response()->getData(true)
        ]);
    }

    public function show($id): JsonResponse
    {
        $listing = Listing::with(['seller', 'offers', 'conversations'])->findOrFail($id);

        return response_success('Listing details retrieved successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }

    public function updateStatus(UpdateListingStatusRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $listing = Listing::findOrFail($id);
        
        if (isset($data['status']) && $data['status'] !== 'Rejected') {
            $data['rejection_reason'] = null;
        }

        // Refund Logic if Rejected
        if (isset($data['status']) && $data['status'] === 'Rejected' && $listing->status !== 'Rejected') {
            if ($listing->used_free_credit) {
                // Return the free credit to the user
                $listing->seller->increment('available_listing_credits');
            } elseif ($listing->razorpay_payment_id) {
                // Trigger Razorpay Refund
                try {
                    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                    $refundAmount = config('patina.fees.listing') * 100; // In paisa
                    $api->payment->fetch($listing->razorpay_payment_id)->refund(["amount" => $refundAmount]);
                } catch (\Exception $e) {
                    Log::error('Razorpay Listing Refund Failed: ' . $e->getMessage());
                    // We log the error but still proceed with rejection
                }
            }
        }

        $listing = $this->listingService->update($id, $data);

        return response_success('Listing status updated successfully', [
            'listing' => new AdminListingResource($listing)
        ]);
    }

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
