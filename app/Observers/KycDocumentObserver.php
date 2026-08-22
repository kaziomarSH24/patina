<?php

namespace App\Observers;

use App\Models\KycDocument;
use Illuminate\Support\Facades\Log;

class KycDocumentObserver
{
    /**
     * Handle the KycDocument "created" event.
     */
    public function created(KycDocument $kycDocument): void
    {
        Log::info("KYC Document uploaded by user {$kycDocument->user_id}: {$kycDocument->document_type}");
    }

    /**
     * Handle the KycDocument "updated" event.
     */
    public function updated(KycDocument $kycDocument): void
    {
        if ($kycDocument->isDirty('status')) {
            $status = $kycDocument->status;
            Log::info("KYC Document ID {$kycDocument->id} status changed to {$status}");
            
            // Here you can dispatch an Email/Notification to the user via AWS SES
            // e.g. Mail::to($kycDocument->user->email)->send(new KycStatusUpdatedMail($kycDocument));
        }
    }
}
