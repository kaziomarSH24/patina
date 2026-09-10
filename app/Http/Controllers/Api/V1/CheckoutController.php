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

        $offer = Offer::with(['listing.seller', 'buyer'])->findOrFail($validated['offer_id']);

        // Check if user is the buyer
        if ($offer->buyer_id !== $request->user()->id) {
            return response_error('Only the buyer can initiate checkout.', [], 403);
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

        // Amount in paisa (multiply by 100)
        $amountInPaisa = (int) ($offer->amount * 100);

        // Example Platform Fee: 5% of the offer amount
        $platformFeePercent = 5;
        $commissionAmount = ($offer->amount * $platformFeePercent) / 100;

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
                'user_id' => $request->user()->id,
                'payable_type' => Offer::class,
                'payable_id' => $offer->id,
                'gateway' => 'razorpay',
                'payment_intent_id' => $razorpayOrder['id'], // Storing the razorpay order ID
                'amount' => $offer->amount,
                'currency' => 'INR',
                'status' => 'pending',
                'metadata' => [
                    'commission_amount' => $commissionAmount,
                    'seller_id' => $offer->listing->seller_id,
                    'buyer_id' => $offer->buyer_id,
                    'listing_id' => $offer->listing_id,
                ],
            ]);

            DB::commit();

            return response_success('Checkout initiated.', [
                'order_id' => $razorpayOrder['id'],
                'amount' => $offer->amount,
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

    /**
     * Razorpay Webhook
     *
     * Handles payment.captured events.
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');

        if (!$signature || !$webhookSecret) {
            return response()->json(['status' => 'invalid'], 400);
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $api->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);
        } catch (SignatureVerificationError $e) {
            Log::error('Razorpay Webhook Signature Verification Failed.');
            return response()->json(['status' => 'invalid signature'], 400);
        }

        $data = json_decode($payload, true);

        if ($data['event'] === 'payment.captured') {
            $paymentData = $data['payload']['payment']['entity'];
            $orderId = $paymentData['order_id'];
            $paymentId = $paymentData['id'];

            // Find pending transaction
            $transaction = Transaction::where('payment_intent_id', $orderId)
                ->where('status', 'pending')
                ->first();

            if ($transaction) {
                DB::beginTransaction();
                try {
                    // Update Transaction
                    $transaction->update([
                        'status' => 'success',
                        'gateway_transaction_id' => $paymentId,
                    ]);

                    // Create Escrow Transaction now that money is secured
                    $metadata = $transaction->metadata;
                    $escrow = EscrowTransaction::create([
                        'offer_id' => $transaction->payable_id,
                        'listing_id' => $metadata['listing_id'],
                        'buyer_id' => $metadata['buyer_id'],
                        'seller_id' => $metadata['seller_id'],
                        'amount' => $transaction->amount,
                        'commission_amount' => $metadata['commission_amount'] ?? 0,
                        'status' => 'Payment Received',
                        'razorpay_order_id' => $orderId,
                        'razorpay_payment_id' => $paymentId,
                    ]);

                    // Also update the transaction's payable to point to the Escrow now if we wanted, 
                    // but keeping it mapped to Offer is fine too. Let's update the listing status to 'sold' or 'pending delivery'.
                    $escrow->listing()->update(['status' => 'sold']);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Razorpay Webhook Processing Failed: ' . $e->getMessage());
                    return response()->json(['status' => 'error processing'], 500);
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
