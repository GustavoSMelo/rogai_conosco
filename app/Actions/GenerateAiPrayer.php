<?php

namespace App\Actions;

class GenerateAiPrayer
{
    public function generate(string $description, string $religion): string
    {
        return sprintf(
            "Senhor, que conheces o fundo do nosso coração, ouve esta oração que elevamos a ti.\n\nPedido: %s\n\nConcede, segundo a tua vontade, aquilo que está no coração de quem clama a ti. Que a paz que excede todo entendimento guarde os corações e as mentes. Que o teu amor envolva, a tua força sustente e a tua luz ilumine cada passo.\n\nEm teu nome confiamos. Amém.",
            $description
        );
    }
}
