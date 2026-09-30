<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'escrow_transaction_id',
        'raised_by_user_id',
        'reason',
        'buyer_claim',
        'evidence_urls',
        'seller_response',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'evidence_urls' => 'array',
    ];

    public function escrowTransaction()
    {
        return $this->belongsTo(EscrowTransaction::class);
    }

    public function raisedBy()
    {
        return $this->belongsTo(User::class, 'raised_by_user_id');
    }
}
