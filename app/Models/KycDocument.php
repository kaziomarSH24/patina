<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\AutoClearsCache;
use Illuminate\Support\Facades\Storage;

class KycDocument extends Model
{
    use HasFactory, AutoClearsCache;

    protected $fillable = [
        'user_id',
        'legal_name',
        'document_type',
        'document_number',
        'dob',
        'city',
        'file_path',
        'back_file_path',
        'selfie_file_path',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    /**
     * Get the URL for the document.
     */
    public function getDocumentUrlAttribute()
    {
        return $this->file_path ? Storage::disk('public')->url($this->file_path) : null;
    }

    /**
     * Get the URL for the back side of the document.
     */
    public function getBackDocumentUrlAttribute()
    {
        return $this->back_file_path ? Storage::disk('public')->url($this->back_file_path) : null;
    }

    /**
     * Get the URL for the user's selfie.
     */
    public function getSelfieUrlAttribute()
    {
        return $this->selfie_file_path ? Storage::disk('public')->url($this->selfie_file_path) : null;
    }

    /**
     * The user that owns the document.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Clear the user's cache when a document is updated.
     */
    public function getRelatedCacheTags(): array
    {
        return ['users:' . $this->user_id, 'users'];
    }
}
