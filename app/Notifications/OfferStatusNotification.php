<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Offer;
use App\Models\User;

class OfferStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Offer $offer;
    public string $action; // 'received', 'accepted', 'declined'
    public User $actionBy;

    public function __construct(Offer $offer, string $action, User $actionBy)
    {
        $this->offer = $offer;
        $this->action = $action;
        $this->actionBy = $actionBy;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $title = '';
        $message = '';
        $listingName = "{$this->offer->listing->brand} {$this->offer->listing->model}";
        $amount = number_format($this->offer->amount);

        if ($this->action === 'received') {
            $title = 'New Offer Received';
            $message = "{$this->actionBy->name} sent an offer of ?{$amount} for your {$listingName}.";
        } elseif ($this->action === 'accepted') {
            $title = 'Offer Accepted';
            $message = "Your offer of ?{$amount} for {$listingName} has been accepted by the seller!";
        } elseif ($this->action === 'declined') {
            $title = 'Offer Declined';
            $message = "Your offer of ?{$amount} for {$listingName} was declined by the seller.";
        }

        return [
            'type' => 'offer_status',
            'title' => $title,
            'message' => $message,
            'offer_id' => $this->offer->id,
            'listing_id' => $this->offer->listing_id,
            'action' => $this->action,
            'action_by' => $this->actionBy->name,
        ];
    }
}
