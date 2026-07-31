<?php

namespace App\Services;

use App\Data\Prays;
use Illuminate\Support\Facades\Http;

class AiService
{
    public function generate(string $description, string $religion): string
    {
        $prompt =
            "Religião: " .
            $religion .
            "\n\n" .
            "Descricao: " .
            $description .
            "\n\n" .
            "Escreva uma oracao tocante e respeitosa em portugues, alinhada com a religiao informada, que acolha o pedido acima. Responda APENAS com o texto da oracao, sem titulo, sem aspas e sem formatacao extra.";

        try {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . config("services.openrouter.key"),
                "Content-Type" => "application/json",
            ])->post(config("services.openrouter.url"), [
                "model" => config("services.openrouter.model"),
                "messages" => [["role" => "user", "content" => $prompt]],
            ]);

            $content = $response->json('choices.0.message.content');

            if (!is_string($content) || trim($content) === '') {
                return $this->fallbackPrayer();
            }

            return trim($content);
        } catch (\Throwable $e) {
            return $this->fallbackPrayer();
        }
    }

    private function fallbackPrayer(): string
    {
        return "Pai nosso que estais nos céus, santificado seja o vosso nome. Venha a nós o vosso reino, seja feita a vossa vontade, assim na terra como no céu. O pão nosso de cada dia nos dai hoje. Perdoai-nos as nossas ofensas, assim como nós perdoamos a quem nos tem ofendido. E não nos deixeis cair em tentação, mas livrai-nos do mal. Amém.";
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
