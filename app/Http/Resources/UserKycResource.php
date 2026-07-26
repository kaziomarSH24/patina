<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserKycResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'kyc_status' => $this->kyc_status,
            'dealer_tier' => $this->dealer_tier,
            'rejection_reason' => $this->kycDocuments->where('status', 'rejected')->last()?->rejection_reason,
            'documents' => KycDocumentResource::collection($this->whenLoaded('kycDocuments')),
        ];
    }
}
