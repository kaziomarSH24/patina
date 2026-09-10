<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscrowTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'listing_id',
        'buyer_id',
        'seller_id',
        'amount',
        'commission_amount',
        'status',
        'shipping_provider',
        'tracking_number',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_transfer_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function disputes()
    {
        return $this->hasMany(Dispute::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class, 'transaction_id');
    }
}
