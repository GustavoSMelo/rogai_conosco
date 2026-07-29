<?php

namespace App\Actions;

use App\Data\Prays;

class KeywordExtractor
{
    /** @var string[] All known tags from the prayer corpus */
    private readonly array $knownTags;

    /** @var string[] Tags containing spaces (matched first, by substring) */
    private readonly array $multiWordTags;

    /** @var string[] Single-word tags (matched by exact token match) */
    private readonly array $singleWordTags;

    /**
     * @param string[]|null $tags  Optional custom tag list; defaults to all tags from Prays::getPrays()
     */
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

    /**
     * Extract known tags present in the given text.
     *
     * Multi-word tags matched by substring; single-word tags by exact token match.
     * Results sorted: multi-word first (longest first), then single-word alphabetically.
     *
     * @return string[] Matched tags, deduplicated and sorted
     */
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

    /** @return string[] All known tags sorted alphabetically */
    public function getKnownTags(): array
    {
        return $this->knownTags;
    }

    /**
     * Collect and sort all unique tags from the prayer corpus.
     *
     * @return string[] Sorted unique tags
     */
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
