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
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone_number,
                    'avatar' => $this->user->avatar,
                ];
            }),
            'plan' => $this->whenLoaded('plan', function () {
                return [
                    'id' => $this->plan->id,
                    'name' => $this->plan->name,
                    'price' => $this->plan->price,
                ];
            }),
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
            'subscription_status' => $this->subscription_status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
