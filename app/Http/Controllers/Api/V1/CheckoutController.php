<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EscrowTransaction;
use App\Models\Offer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

/**
 * @group Checkout
 * Handle Razorpay payments and Escrow transactions.
 */
class CheckoutController extends Controller
{
    /**
     * Initiate Checkout for an Offer
     *
     * Creates a Razorpay Order and Escrow records for a given accepted offer.
     */
    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);

        $offer = Offer::with(['listing.seller.dealerProfile.subscriptionPlan', 'buyer'])->findOrFail($validated['offer_id']);

        // Check if user is the buyer
        if ($offer->buyer_id !== $request->user()->id) {
            return response_error('Only the buyer can initiate checkout.', [], 403);
        }

        // Validate Buyer Profile (Must have default address for shipping)
        $buyer = $request->user();
        $defaultAddress = $buyer->defaultAddress;
        
        if (!$defaultAddress || empty($defaultAddress->address_line_1) || empty($defaultAddress->pincode) || empty($defaultAddress->phone_number)) {
            return response_error('Please add a default shipping address with pincode and phone number in your profile before checking out.', [], 400);
        }

        // Check offer status
        if ($offer->status !== 'Accepted') {
            return response_error('Checkout can only be initiated for accepted offers.', [], 400);
        }

        // Check if already paid or pending checkout exists
        $existingEscrow = EscrowTransaction::where('offer_id', $offer->id)->first();
        if ($existingEscrow) {
            return response_error('A checkout or escrow transaction already exists for this offer.', ['escrow_id' => $existingEscrow->id], 400);
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Math Calculations based on Subscription Plans
        $seller = $offer->listing->seller;
        $sellerPlan = $seller->dealerProfile?->subscriptionPlan;
        
        $sellerCommissionPercent = $sellerPlan ? $sellerPlan->seller_commission_percent : config('patina.fees.default_commission');
        $sellerCommissionAmount = ($offer->amount * $sellerCommissionPercent) / 100;

        $buyerCommissionPercent = $sellerPlan ? $sellerPlan->buyer_commission_percent : config('patina.fees.default_commission');
        $buyerCommissionAmount = ($offer->amount * $buyerCommissionPercent) / 100;
        
        $shippingFee = config('patina.fees.shipping');
        $totalPayable = $offer->amount + $buyerCommissionAmount + $shippingFee;

        // Amount in paisa (multiply by 100)
        $amountInPaisa = (int) ($totalPayable * 100);

        DB::beginTransaction();
        try {
            // Create Razorpay Order
            $orderData = [
                'receipt'         => 'offer_rcptid_' . $offer->id,
                'amount'          => $amountInPaisa,
                'currency'        => 'INR',
                'payment_capture' => 1, // auto capture
                'notes' => [
                    'offer_id' => $offer->id,
                    'listing_id' => $offer->listing_id,
                ]
            ];

            $razorpayOrder = $api->order->create($orderData);

            // We create a global Transaction as 'pending' to track the checkout attempt.
            // The actual EscrowTransaction ('Payment Received') will be created ONLY 
            // after the Razorpay webhook confirms a successful payment.
            $transaction = Transaction::create([
                'user_id' => $buyer->id,
                'payable_type' => Offer::class,
                'payable_id' => $offer->id,
                'gateway' => 'razorpay',
                'payment_intent_id' => $razorpayOrder['id'], // Storing the razorpay order ID
                'amount' => $totalPayable,
                'currency' => 'INR',
                'status' => 'pending',
                'metadata' => [
                    'base_amount' => $offer->amount,
                    'seller_commission_amount' => $sellerCommissionAmount,
                    'buyer_commission_amount' => $buyerCommissionAmount,
                    'shipping_fee' => $shippingFee,
                    'seller_id' => $seller->id,
                    'buyer_id' => $buyer->id,
                    'listing_id' => $offer->listing_id,
                ],
            ]);

            DB::commit();

            return response_success('Checkout initiated.', [
                'order_id' => $razorpayOrder['id'],
                'amount' => $totalPayable,
                'breakdown' => [
                    'watch_price' => $offer->amount,
                    'buyer_commission' => $buyerCommissionAmount,
                    'shipping_fee' => $shippingFee,
                ],
                'currency' => 'INR',
                'key_id' => env('RAZORPAY_KEY'),
                'transaction_id' => $transaction->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            return response_error('Failed to initiate checkout.', ['error' => $e->getMessage()], 500);
        }
    }

}
