<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoClearsCache;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Listing extends Model
{
    use HasFactory, AutoClearsCache;

    protected $fillable = [
        'seller_id',
        'sale_method',
        'brand',
        'model',
        'reference_number',
        'price',
        'status',
        'is_verified',
        'condition_notes',
        'condition',
        'case_size',
        'year_of_production',
        'location',
        'accessories',
        'images',
    ];

    protected $casts = [
        'accessories' => 'array',
        'is_verified' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? array_map(fn ($path) => url('storage/' . $path), json_decode($value, true)) : [],
            set: fn ($value) => json_encode($value),
        );
    }

    public function escrowTransactions()
    {
        return $this->hasMany(EscrowTransaction::class);
    }
    
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }
    
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
