<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoClearsCache;
use Illuminate\Support\Facades\Storage;

class DealerProfile extends Model
{
    use HasFactory, AutoClearsCache;

    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'business_name',
        'address',
        'approx_monthly_inventory',
        'website_link',
        'gst_number',
        'pan_number',
        'bank_account_number',
        'bank_ifsc',
        'bank_beneficiary_name',
        'gst_certificate_path',
        'status',
    ];
    
    protected $appends = ['gst_certificate_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
    
    public function getGstCertificateUrlAttribute()
    {
        return $this->gst_certificate_path ? Storage::disk('public')->url($this->gst_certificate_path) : null;
    }
}
