<?php

namespace Tests\Unit;

use App\Data\Prays;
use PHPUnit\Framework\TestCase;

class PrayersDataTest extends TestCase
{
    private array $traditions;

    protected function setUp(): void
    {
        $this->traditions = Prays::getPrays();
    }

    public function test_file_returns_array_with_4_tradition_keys(): void
    {
        $this->assertCount(4, $this->traditions);
        $this->assertArrayHasKey('catholic', $this->traditions);
        $this->assertArrayHasKey('protestant', $this->traditions);
        $this->assertArrayHasKey('orthodox', $this->traditions);
        $this->assertArrayHasKey('other', $this->traditions);
    }

    public function test_catholic_section_has_at_least_25_entries(): void
    {
        $this->assertGreaterThanOrEqual(25, count($this->traditions['catholic']));
    }

    public function test_protestant_section_has_at_least_25_entries(): void
    {
        $this->assertGreaterThanOrEqual(25, count($this->traditions['protestant']));
    }

    public function test_orthodox_section_has_at_least_25_entries(): void
    {
        $this->assertGreaterThanOrEqual(25, count($this->traditions['orthodox']));
    }

    public function test_other_section_has_at_least_15_entries(): void
    {
        $this->assertGreaterThanOrEqual(15, count($this->traditions['other']));
    }

    public function test_each_prayer_has_required_fields(): void
    {
        foreach ($this->traditions as $tradition => $prayers) {
            foreach ($prayers as $i => $prayer) {
                $this->assertArrayHasKey('title', $prayer, "$tradition #$i missing title");
                $this->assertArrayHasKey('category', $prayer, "$tradition #$i missing category");
                $this->assertArrayHasKey('subcategory', $prayer, "$tradition #$i missing subcategory");
                $this->assertArrayHasKey('body', $prayer, "$tradition #$i missing body");
                $this->assertNotEmpty($prayer['title'], "$tradition #$i empty title");
                $this->assertNotEmpty($prayer['category'], "$tradition #$i empty category");
                $this->assertIsArray($prayer['subcategory'], "$tradition #$i subcategory must be array");
                $this->assertNotEmpty($prayer['body'], "$tradition #$i empty body");
            }
        }
    }
}
