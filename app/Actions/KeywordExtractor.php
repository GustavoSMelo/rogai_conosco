<?php

namespace App\Actions;

use App\Data\Prays;

class KeywordExtractor
{
    private readonly array $knownTags;

    private readonly array $multiWordTags;

    private readonly array $singleWordTags;

    public function __construct(?array $tags = null)
    {
        $this->knownTags = $tags ?? $this->loadTagsFromPrays();
        $this->multiWordTags = array_values(array_filter(
            $this->knownTags,
            fn(string $t) => str_contains($t, ' '),
        ));
        $this->singleWordTags = array_values(array_filter(
            $this->knownTags,
            fn(string $t) => !str_contains($t, ' '),
        ));
    }

    public function extract(string $text): array
    {
        if ($text === '') {
            return [];
        }

        $normalized = mb_strtolower(trim($text));

        $matched = [];

        foreach ($this->multiWordTags as $tag) {
            if (mb_strpos($normalized, $tag) !== false) {
                $matched[] = $tag;
            }
        }

        $tokens = preg_split('/[\s\p{P}]+/u', $normalized, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($this->singleWordTags as $tag) {
            if (in_array($tag, $tokens, true)) {
                $matched[] = $tag;
            }
        }

        $matched = array_values(array_unique($matched));

        usort($matched, function (string $a, string $b) {
            $aMulti = str_contains($a, ' ');
            $bMulti = str_contains($b, ' ');

            if ($aMulti && !$bMulti) {
                return -1;
            }
            if (!$aMulti && $bMulti) {
                return 1;
            }

            if ($aMulti && $bMulti) {
                return strlen($b) <=> strlen($a);
            }

            return $a <=> $b;
        });

        return $matched;
    }

    public function getKnownTags(): array
    {
        return $this->knownTags;
    }

    private function loadTagsFromPrays(): array
    {
        $prays = Prays::getPrays();
        $tags = [];

        foreach ($prays as $group) {
            foreach ($group as $pray) {
                foreach ($pray['tags'] as $tag) {
                    $tags[$tag] = true;
                }
            }
        }

        $sorted = array_keys($tags);
        sort($sorted);

        return $sorted;
    }
}
