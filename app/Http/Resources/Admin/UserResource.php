<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'kyc' => $this->kyc_status ?? 'Pending', // Verified, Pending, Failed
            'kyc_rejection_reason' => $this->kyc_rejection_reason,
            'standing' => $this->account_standing ?? 'Good', // Good, Watchlist, Suspended
            'joined' => $this->created_at ? $this->created_at->format('M Y') : null,
            
            // counts are automatically loaded if withCount is used
            'purchases' => $this->escrow_transactions_as_buyer_count ?? 0,
            'sales' => $this->escrow_transactions_as_seller_count ?? 0,
            
            'kyc_documents' => $this->whenLoaded('kycDocuments'),
            'activities' => $this->whenLoaded('activities'),
        ];
    }
}
