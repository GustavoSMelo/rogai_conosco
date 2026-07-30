<?php

namespace App\Services;

use App\Data\Prays;

class PrayerMatcherService
{
    /** @var string[] Portuguese stopwords filtered during tokenization */
    private array $stopwords;

    public function __construct()
    {
        $this->stopwords = [
            "a",
            "as",
            "o",
            "os",
            "e",
            "de",
            "do",
            "da",
            "dos",
            "das",
            "em",
            "no",
            "na",
            "nos",
            "nas",
            "para",
            "pra",
            "pro",
            "com",
            "que",
            "se",
            "por",
            "ao",
            "aos",
            "num",
            "numa",
            "dum",
            "duma",
            "ele",
            "ela",
            "eles",
            "elas",
            "me",
            "te",
            "se",
            "nos",
            "vos",
            "lhe",
            "lhes",
            "eu",
            "tu",
            "ele",
            "nós",
            "vós",
            "eles",
            "um",
            "uma",
            "uns",
            "umas",
            "este",
            "esta",
            "estes",
            "estas",
            "esse",
            "essa",
            "esses",
            "essas",
            "aquele",
            "aquela",
            "aqueles",
            "aquelas",
            "isto",
            "isso",
            "aquilo",
            "já",
            "mais",
            "menos",
            "muito",
            "pouco",
            "todo",
            "toda",
            "todos",
            "todas",
            "tudo",
            "também",
            "ainda",
            "quando",
            "onde",
            "como",
            "qual",
            "quais",
            "quem",
            "cada",
            "sem",
            "sobre",
            "depois",
            "antes",
            "entre",
            "contra",
            "tal",
            "tais",
            "outro",
            "outra",
            "mesmo",
            "mesma",
            "meu",
            "minha",
            "teu",
            "tua",
            "seu",
            "sua",
            "nosso",
            "nossa",
            "vosso",
            "vossa",
            "dela",
            "dele",
            "delas",
            "deles",
            "até",
            "após",
            "mas",
            "porém",
            "contudo",
            "todavia",
            "então",
            "logo",
            "porque",
            "pois",
            "caso",
            "embora",
            "assim",
            "bem",
            "mal",
            "sim",
            "não",
            "era",
            "são",
            "está",
            "estão",
            "ser",
            "ter",
            "tem",
            "tinha",
            "tido",
            "sido",
            "vai",
            "vão",
            "foi",
            "fui",
            "ir",
            "há",
            "hão",
            "haja",
            "ter",
            "teve",
            "tiver",
            "tiveram",
            "daí",
            "nisso",
            "nesse",
            "nessa",
            "nisto",
            "nesse",
            "nessa",
            "lá",
            "cá",
            "ali",
            "aqui",
            "sim",
            "talvez",
            "ora",
        ];
    }

    /**
     * Split text into tokens, lowercased, stopwords removed.
     *
     * @return string[] Non-empty tokens
     */
    public function tokenize(string $text): array
    {
        $text = mb_strtolower($text, "UTF-8");
        $words = preg_split("/[\s\p{P}]+/u", $text, -1, PREG_SPLIT_NO_EMPTY);

        return array_values(
            array_filter(
                $words,
                fn(string $w) => !in_array($w, $this->stopwords, true),
            ),
        );
    }

    /**
     * Score prayers by tag overlap with the given text and return the top matches.
     *
     * @return list<array{prayer: array, score: float}> Scored results, highest first
     */
    public function match(string $text, int $limit = 3): array
    {
        $signalWords = $this->tokenize($text);

        if (count($signalWords) < 3) {
            return [];
        }

        $prayers = Prays::getPrays();
        $allPrayers = [];

        foreach ($prayers as $tradition => $entries) {
            foreach ($entries as $entry) {
                $allPrayers[] = $entry;
            }
        }

        $scored = [];

        foreach ($allPrayers as $prayer) {
            $score = $this->score($prayer["tags"], $signalWords);
            if ($score > 0) {
                $scored[] = [
                    "prayer" => $prayer,
                    "score" => $score,
                ];
            }
        }

        usort($scored, function ($a, $b) {
            $cmp = $b["score"] <=> $a["score"];
            if ($cmp !== 0) {
                return $cmp;
            }

            return $a["prayer"]["title"] <=> $b["prayer"]["title"];
        });

        return array_slice($scored, 0, $limit);
    }

    /**
     * Compute fraction of signal words that appear in the prayer tags.
     *
     * @param string[] $tags         Prayer tags
     * @param string[] $signalWords  User-tokenized signal words
     */
    public function score(array $tags, array $signalWords): float
    {
        $tagText = implode(" ", $tags);
        $tagWords = preg_split(
            "/[\s\p{P}]+/u",
            mb_strtolower($tagText, "UTF-8"),
            -1,
            PREG_SPLIT_NO_EMPTY,
        );

        $matches = 0;
        foreach ($signalWords as $word) {
            if (in_array($word, $tagWords, true)) {
                $matches++;
            }
        }

        return $matches / count($signalWords);
    }
}
