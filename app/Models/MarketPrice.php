<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'current_price',
        'mom_change',
        'liquidity_score',
        'volatility_score',
    ];

    protected $casts = [
        'current_price' => 'decimal:2',
        'mom_change' => 'decimal:2',
    ];
}
