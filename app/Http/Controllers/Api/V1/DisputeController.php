<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EscrowTransaction;
use App\Models\Dispute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisputeController extends Controller
{
    /**
     * Raise a new dispute for an escrow transaction.
     */
    public function raiseDispute(Request $request, EscrowTransaction $escrow)
    {
        $user = auth()->user();

        // Ensure user is part of the transaction
        if ($escrow->buyer_id !== $user->id && $escrow->seller_id !== $user->id) {
            return response_error("Unauthorized access to this transaction.", [], 403);
        }

        // Check if status allows dispute (Usually Paid, Shipped, or Delivered)
        if (!in_array($escrow->status, ["Paid", "Shipped", "Delivered"])) {
            return response_error("Cannot raise a dispute for an escrow in \"{$escrow->status}\" status.", [], 400);
        }

        // Check if a dispute already exists
        if (Dispute::where("escrow_transaction_id", $escrow->id)->exists()) {
            return response_error("A dispute has already been raised for this transaction.", [], 400);
        }

        $validator = Validator::make($request->all(), [
            "reason"        => "required|string|max:255",
            "buyer_claim"   => "required|string",
            "evidence_urls" => "nullable|array",
            "evidence_urls.*" => "url",
        ]);

        if ($validator->fails()) {
            return response_error("Validation failed", $validator->errors()->toArray(), 422);
        }

        // Create the dispute
        $dispute = Dispute::create([
            "escrow_transaction_id" => $escrow->id,
            "raised_by_user_id"     => $user->id,
            "reason"                => $request->reason,
            "buyer_claim"           => $request->buyer_claim,
            "evidence_urls"         => $request->evidence_urls ?? [],
            "status"                => "Open",
        ]);

        // Freeze the funds by updating escrow status
        $escrow->update(["status" => "Disputed"]);

        return response_success("Dispute raised successfully. Funds have been frozen and admin has been notified.", $dispute);
    }
}

