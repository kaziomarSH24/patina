<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\EscrowTransaction;

class EscrowStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public EscrowTransaction $escrow;
    public string $action;

    /**
     * Create a new notification instance.
     * action can be: 'shipped', 'confirmed', 'released'
     */
    public function __construct(EscrowTransaction $escrow, string $action)
    {
        $this->escrow = $escrow;
        $this->action = $action;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $title = 'Escrow Update';
        $message = '';

        if ($this->action === 'shipped') {
            $title = 'Item Shipped';
            $message = "The seller has shipped the item for Escrow #{$this->escrow->id}. Please confirm receipt once delivered.";
        } elseif ($this->action === 'confirmed') {
            $title = 'Delivery Confirmed';
            $message = "The buyer has confirmed receipt of the item for Escrow #{$this->escrow->id}. Funds will be released soon.";
        } elseif ($this->action === 'released') {
            $title = 'Funds Released';
            $message = "The funds for Escrow #{$this->escrow->id} have been released to your account.";
        }

        return [
            'type' => 'escrow_status',
            'title' => $title,
            'message' => $message,
            'escrow_id' => $this->escrow->id,
            'action' => $this->action,
        ];
    }
}
