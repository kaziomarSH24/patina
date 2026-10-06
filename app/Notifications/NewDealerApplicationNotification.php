<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DealerProfile;

class NewDealerApplicationNotification extends Notification
{
    use Queueable;

    protected $profile;

    public function __construct(DealerProfile $profile)
    {
        $this->profile = $profile;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Dealer Application: ' . $this->profile->business_name)
                    ->markdown('emails.dealer.new_application', [
                        'profile' => $this->profile
                    ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Dealer Application',
            'message' => 'New application received from: ' . $this->profile->business_name,
            'type' => 'dealer_application',
            'profile_id' => $this->profile->id
        ];
    }
}
