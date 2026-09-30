<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisputeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $escrow = $this->whenLoaded("escrowTransaction");
        $buyer = $escrow ? $escrow->buyer : null;
        $seller = $escrow ? $escrow->seller : null;
        $listing = $escrow ? $escrow->listing : null;

        return [
            "id" => $this->id,
            "dispute_reference" => "DSP-" . str_pad($this->id, 3, "0", STR_PAD_LEFT),
            "escrow_reference" => $escrow ? "ESC-" . str_pad($escrow->id, 4, "0", STR_PAD_LEFT) : null,
            "watch_name" => $listing ? ($listing->brand . " " . $listing->model) : "Unknown Watch",
            "status" => $this->status,
            "reason" => $this->reason,
            "amount" => $escrow ? $escrow->amount : null,
            "buyer" => $buyer ? [
                "id" => $buyer->id,
                "name" => $buyer->name,
                "avatar" => $buyer->avatar,
            ] : null,
            "seller" => $seller ? [
                "id" => $seller->id,
                "name" => $seller->company_name ?? $seller->name,
                "avatar" => $seller->avatar,
            ] : null,
            "claims" => [
                "buyer_claim" => $this->buyer_claim,
                "seller_response" => $this->seller_response,
                "evidence_urls" => $this->evidence_urls,
            ],
            "internal_notes" => $this->admin_notes,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "opened_human" => $this->created_at ? $this->created_at->diffForHumans() : null,
        ];
    }
}

