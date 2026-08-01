<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'seller' => [
                'id' => $this->seller->id,
                'name' => $this->seller->name,
                'email' => $this->seller->email,
                'phone_number' => $this->seller->phone_number,
                'standing' => $this->seller->standing,
                'tier' => $this->seller->tier,
            ],
            'brand' => $this->brand,
            'model' => $this->model,
            'reference_number' => $this->reference_number,
            'sale_method' => $this->sale_method,
            'price' => (float) $this->price,
            'condition' => $this->condition,
            'case_size' => $this->case_size,
            'year_of_production' => $this->year_of_production,
            'location' => $this->location,
            'accessories' => $this->accessories,
            'condition_notes' => $this->condition_notes,
            'images' => $this->images,
            'brand_certificate' => $this->brand_certificate,
            'status' => $this->status,
            'is_verified' => $this->is_verified,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($this->sale_method === 'direct_sale') {
            $margin = round((float) $this->price * 0.15, 2);
            $data['patina_margin'] = $margin;
            $data['estimated_payout'] = (float) $this->price - $margin;
        }

        return $data;
    }
}
