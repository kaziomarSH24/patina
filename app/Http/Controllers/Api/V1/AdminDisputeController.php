<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Dispute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDisputeController extends Controller
{
    /**
     * List all disputes for admin dashboard.
     */
    public function index(Request $request)
    {
        $status = $request->query("status");

        $query = Dispute::with([
            "escrowTransaction.buyer",
            "escrowTransaction.seller",
            "escrowTransaction.listing.watch", // assuming relationships
            "raisedBy"
        ])->latest();

        if ($status) {
            $query->where("status", $status);
        }

        $disputes = $query->paginate(20);

        return response_success("Disputes retrieved successfully.", $disputes);
    }

    /**
     * Admin resolves a dispute.
     */
    public function resolve(Request $request, $id)
    {
        $dispute = Dispute::find($id);

        if (!$dispute) {
            return response_error("Dispute not found.", [], 404);
        }

        if ($dispute->status !== "Open") {
            return response_error("This dispute has already been resolved.", [], 400);
        }

        $validator = Validator::make($request->all(), [
            "resolution"  => "required|in:seller,buyer",
            "admin_notes" => "nullable|string"
        ]);

        if ($validator->fails()) {
            return response_error("Validation failed", $validator->errors()->toArray(), 422);
        }

        $resolution = $request->resolution;
        $escrow = $dispute->escrowTransaction;

        // Save admin notes and update status
        $dispute->admin_notes = $request->admin_notes;

        if ($resolution === "seller") {
            // Release funds to seller
            $dispute->status = "Resolved_Seller";
            $escrow->update(["status" => "Completed"]); // or wait for payout API
            
            // TODO: Call Razorpay Route Transfer API here
            
            $message = "Dispute resolved in favor of seller. Funds marked for release.";
        } else {
            // Refund buyer
            $dispute->status = "Resolved_Buyer";
            $escrow->update(["status" => "Refunded"]);
            
            // TODO: Call Razorpay Refund API here

            $message = "Dispute resolved in favor of buyer. Funds marked for refund.";
        }

        $dispute->save();

        return response_success($message, $dispute);
    }
}

