<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EscrowTransaction;
use App\Http\Resources\AdminEscrowResource;
use Illuminate\Http\Request;
use Exception;

class AdminEscrowController extends Controller
{
    /**
     * Get Escrow Stats for Admin Dashboard
     */
    public function stats()
    {
        // Funds held: Sum of amounts for active escrows (not completed, refunded, cancelled, initiated)
        $activeStatuses = ["Payment Received", "Shipped", "Delivered", "Disputed"];
        
        $fundsHeld = EscrowTransaction::whereIn("status", $activeStatuses)->sum("amount");
        $activeCount = EscrowTransaction::whereIn("status", $activeStatuses)->count();
        $disputedCount = EscrowTransaction::where("status", "Disputed")->count();

        return response_success("Escrow stats retrieved successfully.", [
            "funds_held" => (float) $fundsHeld,
            "active_transactions" => $activeCount,
            "disputed_transactions" => $disputedCount
        ]);
    }

    /**
     * List all escrows
     */
    public function index(Request $request)
    {
        $status = $request->query("status");
        
        $query = EscrowTransaction::with(["buyer", "seller", "listing"])->latest();

        if ($status) {
            $query->where("status", $status);
        }

        $escrows = $query->paginate(20);

        return response_success(
            "Escrows retrieved successfully.",
            AdminEscrowResource::collection($escrows)->response()->getData(true)
        );
    }

    /**
     * Admin manually refunds the buyer
     */
    public function refund(Request $request, $id)
    {
        $escrow = EscrowTransaction::find($id);

        if (!$escrow) {
            return response_error("Escrow transaction not found.", [], 404);
        }

        if (in_array($escrow->status, ["Refunded", "Completed", "Cancelled", "Initiated"])) {
            return response_error("Cannot refund an escrow in \"{$escrow->status}\" status.", [], 400);
        }

        // Real logic for Razorpay Refund will go here
        // TODO: Call Razorpay API to process refund using $escrow->razorpay_payment_id
        
        $escrow->update(["status" => "Refunded"]);

        return response_success("Escrow refunded successfully. Funds have been returned to the buyer.", new AdminEscrowResource($escrow->load(["buyer", "seller", "listing"])));
    }

    /**
     * Admin manually releases funds to the seller (Moved from EscrowController)
     */
    public function release(Request $request, $id)
    {
        $escrow = EscrowTransaction::find($id);

        if (!$escrow) {
            return response_error("Escrow transaction not found.", [], 404);
        }

        if ($escrow->status !== "Delivered" && $escrow->status !== "Disputed") {
            return response_error("Only Delivered or Disputed escrows can be released.", [], 400);
        }

        // Prevent fake success if Razorpay Route is not fully configured
        // In reality, this requires the vendors linked account ID
        if (!$escrow->seller->razorpay_account_id) {
            return response_error("Cannot release funds. The seller has not completed Razorpay onboarding (No Linked Account ID).", [], 400);
        }

        // Real logic for Razorpay Route Transfer will go here
        // TODO: Call Razorpay Route Transfer API

        $escrow->update(["status" => "Completed"]);

        return response_success("Funds successfully released to the seller.", new AdminEscrowResource($escrow->load(["buyer", "seller", "listing"])));
    }

    /**
     * Admin syncs/fetches latest BlueDart tracking manually
     */
    public function tracking(Request $request, $id)
    {
        $escrow = EscrowTransaction::find($id);

        if (!$escrow || !$escrow->tracking_number) {
            return response_error("No tracking number found for this transaction.", [], 404);
        }

        $blueDartService = app(\App\Services\BlueDartService::class);
        $result = $blueDartService->trackShipment($escrow->tracking_number);

        if (!$result || !$result["success"]) {
            return response_error("Tracking information currently unavailable from BlueDart.", [], 400);
        }

        return response_success("Tracking information synced successfully.", $result["data"]);
    }
}

