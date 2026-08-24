<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DealerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subscription_plan_id' => $this->subscription_plan_id,
            'plan_name' => $this->whenLoaded('plan', fn() => $this->plan->name),
            'business_name' => $this->business_name,
            'address' => $this->address,
            'approx_monthly_inventory' => $this->approx_monthly_inventory,
            'website_link' => $this->website_link,
            'gst_number' => $this->gst_number,
            'pan_number' => $this->pan_number,
            'gst_certificate_url' => $this->gst_certificate_url,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
