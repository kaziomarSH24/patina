<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Dispute;
use App\Services\DisputeService;
use App\Http\Resources\DisputeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminDisputeController extends Controller
{
    protected $disputeService;

    public function __construct(DisputeService $disputeService)
    {
        $this->disputeService = $disputeService;
    }

    /**
     * List all disputes for admin dashboard.
     */
    public function index(Request $request)
    {
        $status = $request->query("status");

        $query = Dispute::with([
            "escrowTransaction.buyer",
            "escrowTransaction.seller",
            "escrowTransaction.listing.watch", 
            "raisedBy"
        ])->latest();

        if ($status) {
            $query->where("status", $status);
        }

        $disputes = $query->paginate(20);

        return response_success(
            "Disputes retrieved successfully.", 
            DisputeResource::collection($disputes)->response()->getData(true)
        );
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

        $validator = Validator::make($request->all(), [
            "resolution"  => "required|in:seller,buyer",
            "admin_notes" => "nullable|string"
        ]);

        if ($validator->fails()) {
            return response_error("Validation failed", $validator->errors()->toArray(), 422);
        }

        try {
            $resolvedDispute = $this->disputeService->resolveDispute($dispute, $validator->validated());

            $message = $request->resolution === "seller" 
                ? "Dispute resolved in favor of seller. Funds marked for release." 
                : "Dispute resolved in favor of buyer. Funds marked for refund.";

            return response_success(
                $message, 
                new DisputeResource($resolvedDispute->load(["escrowTransaction.buyer", "escrowTransaction.seller"]))
            );
        } catch (Exception $e) {
            $code = $e->getCode() ?: 400;
            return response_error($e->getMessage(), [], $code);
        }
    }
}

