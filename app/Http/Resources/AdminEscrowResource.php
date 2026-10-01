<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminEscrowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $buyer = $this->whenLoaded("buyer");
        $seller = $this->whenLoaded("seller");
        $listing = $this->whenLoaded("listing");

        return [
            "id" => $this->id,
            "escrow_reference" => "ESC-" . str_pad($this->id, 4, "0", STR_PAD_LEFT),
            "amount" => $this->amount,
            "commission_amount" => $this->commission_amount,
            "status" => $this->status,
            "payment_details" => [
                "razorpay_order_id" => $this->razorpay_order_id,
                "razorpay_payment_id" => $this->razorpay_payment_id,
                "razorpay_transfer_id" => $this->razorpay_transfer_id,
            ],
            "shipping" => [
                "provider" => $this->shipping_provider,
                "tracking_number" => $this->tracking_number,
                "label_url" => $this->shipping_label_url,
            ],
            "buyer" => $buyer ? [
                "id" => $buyer->id,
                "name" => $buyer->name,
                "email" => $buyer->email,
                "phone" => $buyer->phone_number,
                "avatar" => $buyer->avatar,
            ] : null,
            "seller" => $seller ? [
                "id" => $seller->id,
                "name" => $seller->company_name ?? $seller->name,
                "email" => $seller->email,
                "phone" => $seller->phone_number,
                "avatar" => $seller->avatar,
            ] : null,
            "watch" => $listing ? [
                "id" => $listing->id,
                "name" => $listing->brand . " " . $listing->model,
                "image" => !empty($listing->images) ? $listing->images[0] : null,
            ] : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "time_ago" => $this->created_at ? $this->created_at->diffForHumans() : null,
        ];
    }
}

