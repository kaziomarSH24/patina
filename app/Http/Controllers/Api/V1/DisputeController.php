<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EscrowTransaction;
use App\Services\DisputeService;
use App\Http\Resources\DisputeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class DisputeController extends Controller
{
    protected $disputeService;

    public function __construct(DisputeService $disputeService)
    {
        $this->disputeService = $disputeService;
    }

    /**
     * Raise a new dispute for an escrow transaction.
     */
    public function raiseDispute(Request $request, EscrowTransaction $escrow)
    {
        $validator = Validator::make($request->all(), [
            "reason"        => "required|string|max:255",
            "buyer_claim"   => "required|string",
            "evidence_urls" => "nullable|array",
            "evidence_urls.*" => "url",
        ]);

        if ($validator->fails()) {
            return response_error("Validation failed", $validator->errors()->toArray(), 422);
        }

        try {
            $dispute = $this->disputeService->raiseDispute($escrow, $validator->validated(), auth()->id());
            
            return response_success(
                "Dispute raised successfully. Funds have been frozen and admin has been notified.", 
                new DisputeResource($dispute->load(["escrowTransaction.buyer", "escrowTransaction.seller"]))
            );
        } catch (Exception $e) {
            $code = $e->getCode() ?: 400;
            return response_error($e->getMessage(), [], $code);
        }
    }

    /**
     * Seller replies to the dispute.
     */
    public function replyDispute(Request $request, EscrowTransaction $escrow)
    {
        $validator = Validator::make($request->all(), [
            "seller_response" => "required|string",
        ]);

        if ($validator->fails()) {
            return response_error("Validation failed", $validator->errors()->toArray(), 422);
        }

        try {
            $dispute = $this->disputeService->replyToDispute($escrow, $validator->validated(), auth()->id());

            return response_success(
                "Your response has been submitted successfully.", 
                new DisputeResource($dispute->load(["escrowTransaction.buyer", "escrowTransaction.seller"]))
            );
        } catch (Exception $e) {
            $code = $e->getCode() ?: 400;
            return response_error($e->getMessage(), [], $code);
        }
    }
}

