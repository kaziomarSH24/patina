<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CriticalAdminAlertNotification extends Notification
{
    use Queueable;

    public $typeString;
    public $title;
    public $message;

    public function __construct(string $typeString, string $title, string $message)
    {
        $this->typeString = $typeString;
        $this->title = $title;
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // we just need database storage for the UI
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => $this->typeString,
            'title' => $this->title,
            'message' => $this->message,
        ];
    }
}
