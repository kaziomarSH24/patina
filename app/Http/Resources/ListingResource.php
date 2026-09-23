<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
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
            'seller' => [
                'id' => $this->seller->id,
                'name' => $this->seller->name,
                'standing' => $this->seller->standing,
            ],
            'brand' => $this->brand,
            'model' => $this->model,
            'watch_type' => $this->watch_type,
            'reference_number' => $this->reference_number,
            'price' => (float) $this->price,
            'condition' => $this->condition,
            'case_size' => $this->case_size,
            'year_of_production' => $this->year_of_production,
            'location' => $this->location,
            'accessories' => $this->accessories,
            'condition_notes' => $this->condition_notes,
            'images' => $this->images,
            'brand_certificate' => $this->brand_certificate,
            'market_momentum' => $this->getMarketMomentum(),
            'status' => $this->status,
            'rejection_reason' => $this->when($this->status === 'Rejected', $this->rejection_reason),
            'is_verified' => $this->is_verified,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    protected function getMarketMomentum()
    {
        if (empty($this->reference_number)) {
            return null;
        }

        try {
            $marketService = app(\App\Services\MarketService::class);
            $history = $marketService->getPriceHistory($this->reference_number);
            return $history['indicators']['momentum_1m_percentage'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
