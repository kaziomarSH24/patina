<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'escrow_transaction_id',
        'buyer_claim',
        'seller_response',
        'status',
    ];

    public function escrowTransaction()
    {
        return $this->belongsTo(EscrowTransaction::class);
    }
}
