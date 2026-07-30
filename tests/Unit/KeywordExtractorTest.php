<?php

namespace Tests\Unit;

use App\Services\KeywordExtractorService;
use PHPUnit\Framework\TestCase;

class KeywordExtractorTest extends TestCase
{
    private KeywordExtractorService $extractor;

    protected function setUp(): void
    {
        $this->extractor = new KeywordExtractorService();
    }

    public function test_returns_empty_array_for_empty_string(): void
    {
        $this->assertSame([], $this->extractor->extract(''));
    }

    public function test_returns_empty_array_for_text_without_known_tags(): void
    {
        $this->assertSame([], $this->extractor->extract('xyzzy zork'));
    }

    public function test_extracts_single_word_tag(): void
    {
        $result = $this->extractor->extract('preciso de muito amor no meu coracao');

        $this->assertContains('amor', $result);
    }

    public function test_extracts_multi_word_tag_as_phrase(): void
    {
        $result = $this->extractor->extract('estou buscando paz interior e tranquilidade');

        $this->assertContains('paz interior', $result);
    }

    public function test_does_not_match_partial_multi_word_tag(): void
    {
        $result = $this->extractor->extract('estou em paz hoje');

        $this->assertNotContains('paz interior', $result);
        $this->assertContains('paz', $result);
    }

    public function test_case_insensitive_matching(): void
    {
        $result = $this->extractor->extract('PRECISO DE PAZ INTERIOR E AMOR');

        $this->assertContains('paz interior', $result);
        $this->assertContains('amor', $result);
    }

    public function test_returns_multiple_tags(): void
    {
        $result = $this->extractor->extract('senhor me da forca interior fe e esperanca');

        $this->assertContains('forca interior', $result);
        $this->assertContains('fe', $result);
        $this->assertContains('esperanca', $result);
    }

    public function test_sorts_multi_word_tags_first(): void
    {
        $result = $this->extractor->extract('preciso de fe e forca interior');

        $first = $result[0];
        $this->assertStringContainsString(' ', $first, 'multi-word tag should appear first');
    }

    public function test_returns_known_tags(): void
    {
        $tags = $this->extractor->getKnownTags();

        $this->assertIsArray($tags);
        $this->assertNotEmpty($tags);
        $this->assertContains('amor', $tags);
        $this->assertContains('paz interior', $tags);
    }

    public function test_accepts_custom_tag_list(): void
    {
        $extractor = new KeywordExtractorService(['custom tag', 'foo']);
        $result = $extractor->extract('this is a custom tag test');

        $this->assertContains('custom tag', $result);
    }

    public function test_no_false_positives_from_substring(): void
    {
        $result = $this->extractor->extract('amoroso');

        $this->assertNotContains('amor', $result);
    }

    public function test_extracts_all_relevant_tags(): void
    {
        $result = $this->extractor->extract('gratidao pela vida e pela familia');

        $this->assertContains('gratidao', $result);
        $this->assertContains('familia', $result);
    }
}
