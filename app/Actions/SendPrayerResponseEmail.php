<?php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;

class SendPrayerResponseEmail
{
    public function send(
        string $to,
        string $name,
        string $prayerMessage,
        ?string $mediaUrl = null,
        ?string $mediaFilePath = null,
        ?string $mediaFileName = null,
    ): void {
        Log::info("SendPrayerResponseEmail payload", [
            "to" => $to,
            "mediaUrl" => $mediaUrl,
            "mediaFilePath" => $mediaFilePath,
            "mediaFileName" => $mediaFileName,
            "fileExists" =>
                $mediaFilePath !== null && file_exists($mediaFilePath),
            "fileSize" =>
                $mediaFilePath !== null && file_exists($mediaFilePath)
                    ? filesize($mediaFilePath)
                    : null,
        ]);

        $email = $this->buildEmail(
            $to,
            $name,
            $prayerMessage,
            $mediaUrl,
            $mediaFilePath,
            $mediaFileName,
        );

        Log::info("SendPrayerResponseEmail built", [
            "attachments" => count($email->getAttachments()),
            "attachmentNames" => array_map(
                fn($attachment) => $attachment->getFilename(),
                $email->getAttachments(),
            ),
        ]);

        $response = MailtrapClient::initSendingEmails(
            apiKey: config("services.mailtrap-sdk.api_key"),
        )->send($email);

        $result = json_decode($response->getBody()->getContents(), true) ?? [];

        Log::info("SendPrayerResponseEmail result", [
            "message_id" => $result["message_id"] ?? null,
            "success" => $result["success"] ?? null,
            "status" => $response->getStatusCode(),
        ]);
    }

    public function buildEmail(
        string $to,
        string $name,
        string $prayerMessage,
        ?string $mediaUrl = null,
        ?string $mediaFilePath = null,
        ?string $mediaFileName = null,
    ): MailtrapEmail {
        $mediaUrl = $this->absoluteMediaUrl($mediaUrl);

        $email = new MailtrapEmail()
            ->from(
                new Address(
                    config("mail.from.address", "hello@example.com"),
                    config("mail.from.name", "Rogai Conosco"),
                ),
            )
            ->to($to)
            ->subject("Rogai Conosco — Sua Oração Foi Respondida")
            ->text(
                "Olá, {$name}." .
                    PHP_EOL .
                    PHP_EOL .
                    "Recebemos seu pedido de oração e preparamos uma resposta para você:" .
                    PHP_EOL .
                    PHP_EOL .
                    "\"{$prayerMessage}\"" .
                    PHP_EOL .
                    PHP_EOL .
                    ($mediaUrl
                        ? "Ouvir mensagem: {$mediaUrl}" . PHP_EOL . PHP_EOL
                        : "") .
                    "Que Deus abençoe sua vida e traga paz ao seu coração.",
            )
            ->html(
                view("emails.prayer-response", [
                    "name" => $name,
                    "prayerMessage" => $prayerMessage,
                    "mediaUrl" => $mediaUrl,
                ])->render(),
            );

        if ($mediaFilePath) {
            if (!file_exists($mediaFilePath)) {
                throw new \RuntimeException(
                    "Response media file not found at: {$mediaFilePath}",
                );
            }

            $email->attachFromPath($mediaFilePath, $mediaFileName);
        }

        return $email;
    }

    private function absoluteMediaUrl(?string $mediaUrl): ?string
    {
        if (
            $mediaUrl === null ||
            str_starts_with($mediaUrl, "http://") ||
            str_starts_with($mediaUrl, "https://")
        ) {
            return $mediaUrl;
        }

        return url($mediaUrl);
    }
}
