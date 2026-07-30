<?php

namespace App\Services;

use App\Data\Prays;
use Illuminate\Support\Facades\Http;

class AiService
{
    public function generate(string $description, string $religion): string
    {
        return sprintf(
            "Senhor, que conheces o fundo do nosso coração, ouve esta oração que elevamos a ti.\n\nPedido: %s\n\nConcede, segundo a tua vontade, aquilo que está no coração de quem clama a ti. Que a paz que excede todo entendimento guarde os corações e as mentes. Que o teu amor envolva, a tua força sustente e a tua luz ilumine cada passo.\n\nEm teu nome confiamos. Amém.",
            $description,
        );
    }

    public function findBestPrayMatch(string $religion, string $prayDescription): ?array
    {
        $prays = json_encode(Prays::getPrays());

        $prompt =
            "Baseado nessas oracoes: " .
            $prays .
            "\n\n" .
            "Religião: " .
            $religion .
            "\n\n" .
            "Descricao: " .
            $prayDescription .
            "\n\n" .
            "Escolha apenas 1 oracao que melhor se encaixa. Retorne APENAS JSON valido dentro de ```json ... ```: {\"title\":\"\",\"category\":\"\",\"subcategory\":[],\"body\":\"\",\"tags\":[]}";

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . config("services.openrouter.key"),
            "Content-Type" => "application/json",
        ])->post(config("services.openrouter.url"), [
            "model" => config("services.openrouter.model"),
            "messages" => [["role" => "user", "content" => $prompt]],
        ]);

        $body = $response->json();

        $content = $body['choices'][0]['message']['content'] ?? null;
        if ($content === null) {
            return null;
        }

        if (preg_match('/```(?:json)?\s*(\{.*?\})\s*```/s', $content, $matches)) {
            $parsed = json_decode($matches[1], true);
            return is_array($parsed) ? $parsed : null;
        }

        $parsed = json_decode($content, true);

        return is_array($parsed) ? $parsed : null;
    }
}
