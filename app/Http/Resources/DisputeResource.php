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
        $escrow = $this->relationLoaded("escrowTransaction") ? $this->escrowTransaction : null;
        $buyer = $escrow && $escrow->relationLoaded("buyer") ? $escrow->buyer : null;
        $seller = $escrow && $escrow->relationLoaded("seller") ? $escrow->seller : null;
        $listing = $escrow && $escrow->relationLoaded("listing") ? $escrow->listing : null;

        // Fallback for cases where relation is loaded but we still want to grab it if it exists directly on model
        if (!$buyer && $escrow && isset($escrow->buyer)) $buyer = $escrow->buyer;
        if (!$seller && $escrow && isset($escrow->seller)) $seller = $escrow->seller;
        if (!$listing && $escrow && isset($escrow->listing)) $listing = $escrow->listing;

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

