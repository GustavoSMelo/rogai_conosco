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
                $this->assertArrayHasKey('tags', $prayer, "$tradition #$i missing tags");
                $this->assertNotEmpty($prayer['title'], "$tradition #$i empty title");
                $this->assertNotEmpty($prayer['category'], "$tradition #$i empty category");
                $this->assertIsArray($prayer['subcategory'], "$tradition #$i subcategory must be array");
                $this->assertNotEmpty($prayer['body'], "$tradition #$i empty body");
                $this->assertIsArray($prayer['tags'], "$tradition #$i tags must be array");
            }
        }
    }

    public function test_tags_are_non_empty_strings(): void
    {
        foreach ($this->traditions as $tradition => $prayers) {
            foreach ($prayers as $i => $prayer) {
                $this->assertGreaterThanOrEqual(10, count($prayer['tags']), "$tradition #$i has fewer than 10 tags");
                foreach ($prayer['tags'] as $j => $tag) {
                    $this->assertIsString($tag, "$tradition #$i tag #$j is not string");
                    $this->assertNotEmpty($tag, "$tradition #$i tag #$j is empty");
                }
            }
        }
    }

    public function test_tags_use_natural_language(): void
    {
        foreach ($this->traditions as $tradition => $prayers) {
            foreach ($prayers as $i => $prayer) {
                foreach ($prayer['tags'] as $tag) {
                    $this->assertNotEmpty($tag, "$tradition #$i has empty tag");
                }
            }
        }
    }

    public function test_tags_have_no_religious_terms(): void
    {
        $forbidden = [
            'sao ',
            'santa ',
            'santo ',
            'theotokos',
            'virgem maria',
            'salve rainha',
            'ave maria',
            'magnificat',
            'angelus',
            'trisagio',
            'tropario',
            'pentecostes',
            'imaculada',
            'consagracao',
            'eucaristia',
            'comunhao',
            'cordeiro de deus',
            'pai nosso',
            'cred o',
        ];

        foreach ($this->traditions as $tradition => $prayers) {
            foreach ($prayers as $i => $prayer) {
                foreach ($prayer['tags'] as $tag) {
                    $lower = mb_strtolower($tag, 'UTF-8');
                    foreach ($forbidden as $term) {
                        $this->assertStringNotContainsString(
                            $term,
                            $lower,
                            "$tradition #$i tag '$tag' contains forbidden term '$term'"
                        );
                    }
                }
            }
        }
    }

    public function test_known_prayer_has_expected_tags(): void
    {
        $catholic = $this->traditions['catholic'];
        $paiNosso = current(array_filter($catholic, fn($p) => $p['title'] === 'Pai Nosso'));
        $this->assertNotEmpty($paiNosso, 'Pai Nosso not found');
        $tags = $paiNosso['tags'];
        $this->assertGreaterThanOrEqual(10, count($tags), 'Pai Nosso should have at least 10 tags');
        $expected = ['pedindo perdao', 'buscando forca', 'confiando em Deus', 'lutando contra tentacao', 'precisando de livramento', 'humildade'];
        foreach ($expected as $tag) {
            $this->assertContains($tag, $tags, "Pai Nosso missing expected tag '$tag'");
        }
    }
}
