<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IndicatorAccessLink extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $indicatorName,
        public string $accessUrl,
        public string $deliveryType,
        public string $subject,
        public string $body,
        public string $recipientEmail,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.indicator-access-link',
        );
    }
}
