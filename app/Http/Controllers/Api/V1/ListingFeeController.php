<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class ListingFeeController extends Controller
{
    /**
     * Initiate a ₹999 Listing Fee payment
     * 
     * @return JsonResponse
     */
    public function initiateFee(): JsonResponse
    {
        $user = Auth::user();

        // Check if the user is a dealer
        // Dealers don't need to pay per listing as they have subscriptions
        if ($user->hasRole('dealer')) {
            return response_error('Dealers do not need to pay listing fees.', [], 400);
        }

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            $orderData = [
                'receipt'         => 'listing_fee_' . $user->id . '_' . time(),
                'amount'          => 999 * 100, // 999 INR in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            
            $razorpayOrder = $api->order->create($orderData);

            return response_success('Listing fee order created', [
                'order_id' => $razorpayOrder['id'],
                'amount' => 999,
                'currency' => 'INR'
            ]);

        } catch (\Exception $e) {
            return response_error('Failed to create Razorpay order: ' . $e->getMessage(), [], 500);
        }
    }
}
