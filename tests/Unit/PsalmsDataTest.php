<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Data\Psalms;

class PsalmsDataTest extends TestCase
{
    private array $psalms;

    protected function setUp(): void
    {
        $this->psalms = Psalms::getPsalms();
    }

    public function test_file_returns_array_with_150_entries(): void
    {
        $this->assertCount(150, $this->psalms);
    }

    public function test_each_entry_has_chapter_and_verses_keys(): void
    {
        foreach ($this->psalms as $entry) {
            $this->assertArrayHasKey('chapter', $entry);
            $this->assertArrayHasKey('verses', $entry);
            $this->assertIsInt($entry['chapter']);
            $this->assertIsArray($entry['verses']);
        }
    }

    public function test_chapters_are_consecutive_1_to_150(): void
    {
        $chapters = array_map(fn($e) => $e['chapter'], $this->psalms);
        $this->assertSame(range(1, 150), $chapters);
    }

    public function test_psalm_1_has_at_least_6_verses(): void
    {
        $this->assertGreaterThanOrEqual(6, count($this->psalms[0]['verses']));
    }

    public function test_psalm_150_has_at_least_6_verses(): void
    {
        $this->assertGreaterThanOrEqual(6, count($this->psalms[149]['verses']));
    }

    public function test_verses_are_keyed_by_integers_with_ntlh_text(): void
    {
        foreach ($this->psalms as $entry) {
            foreach ($entry['verses'] as $verseNum => $verseText) {
                $this->assertIsInt($verseNum);
                $this->assertIsString($verseText);
                $this->assertNotEmpty($verseText);
            }
        }
    }
}
