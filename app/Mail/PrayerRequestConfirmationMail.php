<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PrayerRequestConfirmationMail extends Mailable
{
    use Queueable;

    public function __construct(
        public string $name,
        public string $prayerMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rogai Conosco — Sua Oração Está Sendo Preparada',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.prayer-confirmation',
        );
    }
}
