<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KycDocumentResource extends JsonResource
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
            'legal_name' => $this->legal_name,
            'type' => $this->document_type,
            'document_number' => $this->document_number,
            'dob' => $this->dob?->format('Y-m-d'),
            'city' => $this->city,
            'status' => $this->status,
            'front_url' => $this->document_url,
            'back_url' => $this->back_document_url,
            'selfie_url' => $this->selfie_url,
            'rejection_reason' => $this->rejection_reason,
            'submitted_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
