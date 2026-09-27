<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FreeIndicatorRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $indicatorName,
        public ?string $requesterName,
        public string $requesterEmail,
        public ?string $requestMessage,
        public string $adminUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New free indicator access request: ' . $this->indicatorName,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.free-indicator-request',
        );
    }
}
