<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProverbsDataTest extends TestCase
{
    private array $proverbs;

    protected function setUp(): void
    {
        $this->proverbs = require __DIR__ . '/../../resources/data/proverbs.php';
    }

    public function test_file_returns_array_with_31_entries(): void
    {
        $this->assertCount(31, $this->proverbs);
    }

    public function test_each_entry_has_chapter_and_verses_keys(): void
    {
        foreach ($this->proverbs as $entry) {
            $this->assertArrayHasKey('chapter', $entry);
            $this->assertArrayHasKey('verses', $entry);
            $this->assertIsInt($entry['chapter']);
            $this->assertIsArray($entry['verses']);
        }
    }

    public function test_chapters_are_consecutive_1_to_31(): void
    {
        $chapters = array_map(fn($e) => $e['chapter'], $this->proverbs);
        $this->assertSame(range(1, 31), $chapters);
    }

    public function test_proverbs_1_has_at_least_7_verses(): void
    {
        $this->assertGreaterThanOrEqual(7, count($this->proverbs[0]['verses']));
    }

    public function test_proverbs_31_has_at_least_31_verses(): void
    {
        $this->assertGreaterThanOrEqual(31, count($this->proverbs[30]['verses']));
    }

    public function test_verses_are_keyed_by_integers_with_ntlh_text(): void
    {
        foreach ($this->proverbs as $entry) {
            foreach ($entry['verses'] as $verseNum => $verseText) {
                $this->assertIsInt($verseNum);
                $this->assertIsString($verseText);
                $this->assertNotEmpty($verseText);
            }
        }
    }
}
