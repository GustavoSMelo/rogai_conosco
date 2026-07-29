<?php

namespace Tests\Unit;

use App\Services\PrayerMatcher;
use PHPUnit\Framework\TestCase;

class PrayerMatcherTest extends TestCase
{
    private PrayerMatcher $matcher;

    protected function setUp(): void
    {
        $this->matcher = new PrayerMatcher();
    }

    public function test_basic_text_matching(): void
    {
        $results = $this->matcher->match('hoje foi um dia dificil no trabalho precisei de muita paciencia');

        $this->assertNotEmpty($results);
        $this->assertGreaterThanOrEqual(1, count($results));
    }

    public function test_stopwords_are_filtered(): void
    {
        $signalWords = $this->matcher->tokenize('hoje foi um dia dificil no trabalho precisei de muita paciencia');

        $this->assertContains('hoje', $signalWords);
        $this->assertContains('dificil', $signalWords);
        $this->assertContains('trabalho', $signalWords);
        $this->assertContains('paciencia', $signalWords);
        $this->assertNotContains('um', $signalWords);
        $this->assertNotContains('foi', $signalWords);
        $this->assertNotContains('de', $signalWords);
    }

    public function test_minimum_signal_word_threshold(): void
    {
        $results = $this->matcher->match('ola tudo bem');

        $this->assertEmpty($results);
    }

    public function test_score_calculation(): void
    {
        $tags = ['fe em deus', 'gratidao pela vida'];
        $signalWords = ['paciencia', 'fe', 'trabalho'];
        $score = $this->matcher->score($tags, $signalWords);

        $this->assertEquals(1 / 3, $score);
    }

    public function test_zero_score_prayers_excluded(): void
    {
        $tags = ['amor', 'alegria'];
        $signalWords = ['tristeza', 'dor', 'solidao'];
        $score = $this->matcher->score($tags, $signalWords);

        $this->assertEquals(0, $score);
    }

    public function test_top_n_matches(): void
    {
        $results = $this->matcher->match('preciso de paciencia fe e esperanca neste momento dificil');

        $this->assertNotEmpty($results);
        $this->assertLessThanOrEqual(3, count($results));
    }
}
