<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class DealerApplicationStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $title = $this->status === 'approved' ? 'Dealer Application Approved' : 'Dealer Application Rejected';
        
        $message = $this->status === 'approved' 
            ? 'Congratulations! Your dealer application has been approved. You can now access dealer features.'
            : 'Unfortunately, your dealer application was rejected. Please contact support for more details.';

        return [
            'type' => 'dealer_application_status',
            'title' => $title,
            'message' => $message,
            'status' => $this->status,
        ];
    }
}
