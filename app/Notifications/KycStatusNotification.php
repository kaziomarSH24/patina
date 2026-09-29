<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class KycStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $status;
    public ?string $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $status, ?string $reason = null)
    {
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $title = $this->status === 'approved' ? 'KYC Approved' : 'KYC Rejected';
        
        $message = $this->status === 'approved' 
            ? 'Congratulations! Your KYC application has been approved. You are now verified.'
            : 'Unfortunately, your KYC application was rejected.';
            
        if ($this->reason) {
            $message .= " Reason: {$this->reason}";
        }

        return [
            'type' => 'kyc_status',
            'title' => $title,
            'message' => $message,
            'kyc_status' => $this->status,
            'reason' => $this->reason,
        ];
    }
}
