<?php

namespace App\Services;

class WhatsAppDeepLinkService
{
    public function build(
        ?string $phone,
        string $name,
        string $prayerMessage,
        ?string $mediaUrl = null,
    ): ?string {
        $digits = preg_replace('/\D/', '', $phone ?? '');

        if ($digits === null || $digits === '') {
            return null;
        }

        $message = $this->buildMessage($name, $prayerMessage, $mediaUrl);

        return "https://wa.me/{$digits}?text=".rawurlencode($message);
    }

    private function buildMessage(
        string $name,
        string $prayerMessage,
        ?string $mediaUrl,
    ): string {
        $mediaUrl = $this->absoluteMediaUrl($mediaUrl);

        return $this->greeting().
            ', '.
            ($name !== '' ? $name : 'Anônimo').
            '.'.
            PHP_EOL.
            PHP_EOL.
            'Recebemos seu pedido de oração e preparamos uma resposta para você:'.
            PHP_EOL.
            PHP_EOL.
            "\"{$prayerMessage}\"".
            PHP_EOL.
            PHP_EOL.
            ($mediaUrl
                ? "Ouvir mensagem: {$mediaUrl}".PHP_EOL.PHP_EOL
                : '').
            'Que Deus abençoe sua vida e traga paz ao seu coração.';
    }

    private function greeting(): string
    {
        $hour = (int) now()->format('G');

        if ($hour >= 5 && $hour < 12) {
            return 'Bom dia';
        }

        if ($hour >= 12 && $hour < 18) {
            return 'Boa tarde';
        }

        return 'Boa noite';
    }

    private function absoluteMediaUrl(?string $mediaUrl): ?string
    {
        if (
            $mediaUrl === null ||
            str_starts_with($mediaUrl, 'http://') ||
            str_starts_with($mediaUrl, 'https://')
        ) {
            return $mediaUrl;
        }

        return url($mediaUrl);
    }
}
