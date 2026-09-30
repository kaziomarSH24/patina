<?php

namespace App\Services;

use App\Models\Dispute;
use App\Models\EscrowTransaction;
use Illuminate\Support\Facades\DB;
use Exception;

class DisputeService
{
    /**
     * Buyer raises a dispute
     */
    public function raiseDispute(EscrowTransaction $escrow, array $data, $userId)
    {
        if ($escrow->buyer_id !== $userId && $escrow->seller_id !== $userId) {
            throw new Exception("Unauthorized access to this transaction.", 403);
        }

        if (!in_array($escrow->status, ["Paid", "Shipped", "Delivered"])) {
            throw new Exception("Cannot raise a dispute for an escrow in \"{$escrow->status}\" status.", 400);
        }

        if (Dispute::where("escrow_transaction_id", $escrow->id)->exists()) {
            throw new Exception("A dispute has already been raised for this transaction.", 400);
        }

        return DB::transaction(function () use ($escrow, $data, $userId) {
            $dispute = Dispute::create([
                "escrow_transaction_id" => $escrow->id,
                "raised_by_user_id"     => $userId,
                "reason"                => $data["reason"],
                "buyer_claim"           => $data["buyer_claim"],
                "evidence_urls"         => $data["evidence_urls"] ?? [],
                "status"                => "Open",
            ]);

            $escrow->update(["status" => "Disputed"]);

            return $dispute;
        });
    }

    /**
     * Seller replies to a dispute
     */
    public function replyToDispute(EscrowTransaction $escrow, array $data, $userId)
    {
        if ($escrow->seller_id !== $userId) {
            throw new Exception("Only the seller can reply to this dispute.", 403);
        }

        $dispute = Dispute::where("escrow_transaction_id", $escrow->id)->first();

        if (!$dispute) {
            throw new Exception("No dispute found for this transaction.", 404);
        }

        if ($dispute->status !== "Open") {
            throw new Exception("This dispute is already resolved.", 400);
        }

        $dispute->update([
            "seller_response" => $data["seller_response"]
        ]);

        return $dispute;
    }

    /**
     * Admin resolves the dispute
     */
    public function resolveDispute(Dispute $dispute, array $data)
    {
        if ($dispute->status !== "Open") {
            throw new Exception("This dispute has already been resolved.", 400);
        }

        return DB::transaction(function () use ($dispute, $data) {
            $resolution = $data["resolution"];
            $escrow = $dispute->escrowTransaction;

            $dispute->admin_notes = $data["admin_notes"] ?? $dispute->admin_notes;

            if ($resolution === "seller") {
                $dispute->status = "Resolved_Seller";
                $escrow->update(["status" => "Completed"]);
                // TODO: Trigger real Payout
            } else {
                $dispute->status = "Resolved_Buyer";
                $escrow->update(["status" => "Refunded"]);
                // TODO: Trigger real Refund
            }

            $dispute->save();

            return $dispute;
        });
    }
}

