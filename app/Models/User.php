<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\AutoClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Storage;
use App\Models\KycDocument;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens, LogsActivity;

    use AutoClearsCache; // Magic Starts Here!

    // Optional: If updating a user should clear their posts cache too
    // public function getRelatedCacheTags(): array
    // {
    //     return ['posts'];
    // }

    public function getAvatarAttribute($value)
    {
        $encodedName = urlencode($this->name ?? 'User');

        return $value
            ? Storage::disk('public')->url($value)
            : "https://ui-avatars.com/api/?background=random&name={$encodedName}&bold=true";
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'company_name',
        'dealer_tier',
        'kyc_status',
        'kyc_rejection_reason',
        'account_standing',
        'avatar',
        'otp',
        'otp_expires_at',
        'verification_token',
        'email_verified_at',
        'is_active',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'verification_token',
        'fcm_token',
        'otp_expires_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function fcmTokens()
    {
        return $this->hasMany(FcmToken::class);
    }

    public function kycDocuments(): HasMany
    {
        return $this->hasMany(KycDocument::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'seller_id');
    }

    public function escrowTransactionsAsBuyer(): HasMany
    {
        return $this->hasMany(EscrowTransaction::class, 'buyer_id');
    }

    public function escrowTransactionsAsSeller(): HasMany
    {
        return $this->hasMany(EscrowTransaction::class, 'seller_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class, 'following_id');
    }

    public function following(): HasMany
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function wishlistItems(): HasMany
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function reviewsGiven(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function priceAlerts(): HasMany
    {
        return $this->hasMany(PriceAlert::class);
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class);
    }

    public function offersMade(): HasMany
    {
        return $this->hasMany(Offer::class, 'buyer_id');
    }

    // Activity Log Configuration, it's also customizable
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'kyc_status', 'dealer_tier', 'account_standing']) //customize the fields you want to log
            ->logOnlyDirty() //log only the changed fields
            ->setDescriptionForEvent(fn(string $eventName) => "User has been {$eventName}")
            ->useLogName('user_activity');
    }
}
