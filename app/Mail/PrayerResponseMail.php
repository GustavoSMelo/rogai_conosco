<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PrayerResponseMail extends Mailable
{
    use Queueable;

    public function __construct(
        public string $prayerMessage,
        public string $name,
        public ?string $mediaUrl = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rogai Conosco — Sua Oração Foi Respondida',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.prayer-response',
        );
    }
}
