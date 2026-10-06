<?php

namespace App\Mail;

use App\Models\User;
use App\Models\EscrowTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EscrowPaymentSuccess extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $escrow;
    public $role; // 'buyer' or 'seller'

    public function __construct(User $user, EscrowTransaction $escrow, string $role)
    {
        $this->user = $user;
        $this->escrow = $escrow;
        $this->role = $role;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->role === 'buyer' ? 'Payment Successful - Patina Escrow' : 'New Order Received - Patina',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.escrow.payment-success',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
