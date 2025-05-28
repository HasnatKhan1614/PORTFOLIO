<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\OrderDetail;
use App\Models\Renewal;

class OrderRenewalInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $renewal;

    /**
     * Create a new message instance.
     */
    public function __construct(OrderDetail $order, Renewal $renewal)
    {
        $this->order = $order;
        $this->renewal = $renewal;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Renewal Invoice',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.renewal-invoice',
            with: [
                'order' => $this->order,
                'renewal' => $this->renewal,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
