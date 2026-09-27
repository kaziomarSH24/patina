<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EscrowTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @group Escrow Management
 * Manage the post-payment flow of an order (Shipping, Confirmation, Release).
 */
class EscrowController extends Controller
{
    /**
     * Mark as Shipped (Seller Action)
     * 
     * Seller provides tracking details and updates the status to 'Shipped'.
     */
    public function ship(Request $request, EscrowTransaction $escrow)
    {
        $validated = $request->validate([
            'shipping_provider' => 'required|string|max:100',
            'tracking_number' => 'required|string|max:100',
        ]);

        if ($escrow->seller_id !== $request->user()->id) {
            return response_error('Only the seller can mark this order as shipped.', [], 403);
        }

        if ($escrow->status !== 'Payment Received') {
            return response_error("Order is currently '{$escrow->status}' and cannot be marked as shipped.", [], 400);
        }

        $escrow->update([
            'status' => 'Shipped',
            'shipping_provider' => $validated['shipping_provider'],
            'tracking_number' => $validated['tracking_number']
        ]);

        return response_success('Order marked as shipped.', ['escrow' => $escrow]);
    }

    /**
     * Confirm Delivery (Buyer Action)
     * 
     * Buyer confirms they have received the watch and are satisfied.
     */
    public function confirm(Request $request, EscrowTransaction $escrow)
    {
        if ($escrow->buyer_id !== $request->user()->id) {
            return response_error('Only the buyer can confirm this delivery.', [], 403);
        }

        if ($escrow->status !== 'Shipped') {
            return response_error("Order must be marked as 'Shipped' before you can confirm delivery.", [], 400);
        }

        $escrow->update(['status' => 'Confirmed']);

        return response_success('Delivery confirmed successfully. Funds are ready to be released to the seller.', ['escrow' => $escrow]);
    }

    /**
     * Get User's Purchase History
     *
     * Returns a paginated list of all purchases (EscrowTransactions) made by the authenticated user.
     */
    public function purchases(Request $request)
    {
        $purchases = EscrowTransaction::where('buyer_id', $request->user()->id)
            ->with(['listing' => function ($query) {
                $query->select('id', 'brand', 'model', 'reference_number', 'images');
            }, 'seller' => function ($query) {
                $query->select('id', 'name', 'company_name', 'avatar');
            }])
            ->latest()
            ->paginate($request->input('per_page', 10));

        // Format the output
        $formattedPurchases = $purchases->through(function ($escrow) {
            return [
                'id' => $escrow->id,
                'listing_id' => $escrow->listing_id,
                'watch_title' => $escrow->listing ? ($escrow->listing->brand . ' ' . $escrow->listing->model) : 'Unknown Watch',
                'reference_number' => $escrow->listing ? $escrow->listing->reference_number : null,
                'thumbnail' => ($escrow->listing && is_array($escrow->listing->images) && count($escrow->listing->images) > 0) ? $escrow->listing->images[0] : null,
                'seller_name' => $escrow->seller ? ($escrow->seller->company_name ?: $escrow->seller->name) : 'Unknown Seller',
                'seller_avatar' => $escrow->seller ? $escrow->seller->avatar : null,
                'amount' => $escrow->amount,
                'status' => $escrow->status,
                'tracking_number' => $escrow->tracking_number,
                'shipping_provider' => $escrow->shipping_provider,
                'purchased_at' => $escrow->created_at->format('M d, Y'),
            ];
        });

        return response_success('Purchase history retrieved successfully', [
            'purchases' => [
                'data' => $formattedPurchases,
                'meta' => [
                    'current_page' => $purchases->currentPage(),
                    'last_page' => $purchases->lastPage(),
                    'per_page' => $purchases->perPage(),
                    'total' => $purchases->total(),
                ]
            ]
        ]);
    }

    /**
     * Release Funds (Admin Action)
     * 
     * Admin triggers the Razorpay Route API to transfer funds to the seller's linked account.
     */
    public function release(Request $request, EscrowTransaction $escrow)
    {
        if ($escrow->status !== 'Confirmed') {
            return response_error("Order must be 'Confirmed' by the buyer before releasing funds.", [], 400);
        }

        $seller = $escrow->seller;
        
        // TODO: Enable actual Razorpay transfer once the client provides HyperVerge/Route setup
        /*
        if (!$seller->razorpay_account_id) {
            return response_error('Seller has not linked a Razorpay account.', [], 400);
        }

        $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $transferAmount = (int) (($escrow->amount - $escrow->commission_amount) * 100);

        try {
            $transfer = $api->payment->fetch($escrow->razorpay_payment_id)->transfer([
                'transfers' => [
                    [
                        'account' => $seller->razorpay_account_id,
                        'amount' => $transferAmount,
                        'currency' => 'INR',
                        'notes' => [
                            'escrow_id' => $escrow->id,
                        ],
                        'linked_account_notes' => ['escrow_id'],
                        'on_hold' => 0
                    ]
                ]
            ]);

            $escrow->update([
                'status' => 'Completed',
                'razorpay_transfer_id' => $transfer['items'][0]['id']
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Transfer Failed: ' . $e->getMessage());
            return response_error('Transfer failed.', ['error' => $e->getMessage()], 500);
        }
        */

        // For now, we simulate the release
        $escrow->update([
            'status' => 'Completed',
            'razorpay_transfer_id' => 'sim_transfer_12345'
        ]);

        return response_success('Funds successfully released to the seller.', ['escrow' => $escrow]);
    }
}
