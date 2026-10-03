<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EscrowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $listing = $this->whenLoaded("listing");
        $seller = $this->whenLoaded("seller");
        $buyer = $this->whenLoaded("buyer");

        return [
            "id" => $this->id,
            "reference" => "ESC-" . str_pad($this->id, 4, "0", STR_PAD_LEFT),
            "status" => $this->status,
            "amount" => $this->amount,
            "commission_amount" => $this->commission_amount,
            
            "shipping" => [
                "provider" => $this->shipping_provider,
                "tracking_number" => $this->tracking_number,
                "label_url" => $this->shipping_label_url,
            ],

            "watch" => $listing ? [
                "id" => $listing->id,
                "brand" => $listing->brand,
                "model" => $listing->model,
                "reference_number" => $listing->reference_number,
                "image" => !empty($listing->images) ? $listing->images[0] : null,
            ] : null,

            "seller" => $seller ? [
                "id" => $seller->id,
                "name" => $seller->company_name ?? $seller->name,
                "avatar" => $seller->avatar,
            ] : null,

            "buyer" => $buyer ? [
                "id" => $buyer->id,
                "name" => $buyer->name,
                "avatar" => $buyer->avatar,
            ] : null,

            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}

