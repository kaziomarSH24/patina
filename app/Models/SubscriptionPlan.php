<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoClearsCache;

class SubscriptionPlan extends Model
{
    use HasFactory, AutoClearsCache;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'razorpay_plan_id',
        'features',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_active' => 'boolean',
    ];
}
