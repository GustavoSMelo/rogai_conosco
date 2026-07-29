<?php

namespace Tests\Feature;

use Tests\TestCase;

class PrayerResultPageTest extends TestCase
{
    public function test_ai_prayer_result_renders_correctly(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertStatus(200);
        $response->assertSee('Sua oração foi ouvida');
    }

    public function test_instant_prayer_result_renders_correctly(): void
    {
        $response = $this->get('/prayer/result?type=instant&religion=catholic');

        $response->assertStatus(200);
        $response->assertSee('Uma bênção para seu momento');
    }

    public function test_person_prayer_result_renders_correctly(): void
    {
        $response = $this->get('/prayer/result?type=person-prayer&religion=catholic');

        $response->assertStatus(200);
        $response->assertSee('Sua intenção está em oração');
        $response->assertSee('2 dias');
    }

    public function test_person_bible_result_shows_video_message(): void
    {
        $response = $this->get('/prayer/result?type=person-bible&religion=catholic');

        $response->assertStatus(200);
        $response->assertSee('2 dias');
    }

    public function test_invalid_type_shows_fallback(): void
    {
        $response = $this->get('/prayer/result?type=invalid');

        $response->assertStatus(200);
        $response->assertSee('Sua intenção está em oração');
    }

    public function test_response_uses_minimal_layout(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('og:title', false);
        $response->assertSee('result-card', false);
        $response->assertDontSee('fonts.googleapis.com', false);
    }

    public function test_response_has_og_meta_tags(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('og:title', false);
        $response->assertSee('og:description', false);
        $response->assertSee('og:image', false);
    }

    public function test_ai_result_og_description_is_specific(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('oração gerada por IA');
    }

    public function test_person_result_og_description_is_specific(): void
    {
        $response = $this->get('/prayer/result?type=person-prayer&religion=catholic');

        $response->assertSee('pessoa real está orando por você');
    }

    public function test_result_page_uses_result_specific_css_classes(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('result-card', false);
        $response->assertSee('result-heading', false);
        $response->assertSee('result-btn-primary', false);
    }

    public function test_result_page_does_not_use_welcome_css_classes(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertDontSee('welcome-card', false);
        $response->assertDontSee('welcome-modal-title', false);
        $response->assertDontSee('welcome-modal-btn', false);
        $response->assertDontSee('welcome-btn-outline', false);
    }

    public function test_result_page_has_reveal_animations(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('reveal-delay-1', false);
        $response->assertSee('reveal-delay-2', false);
        $response->assertSee('reveal-delay-3', false);
    }

    public function test_all_result_types_show_donation_button(): void
    {
        $ai = $this->get('/prayer/result?type=ai&religion=catholic');
        $instant = $this->get('/prayer/result?type=instant&religion=catholic');
        $person = $this->get('/prayer/result?type=person-prayer&religion=catholic');

        $ai->assertSee('Apoie esta missão');
        $instant->assertSee('Apoie esta missão');
        $person->assertSee('Apoie esta missão');
    }

    public function test_result_page_has_no_inline_font_link(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertDontSee('fonts.googleapis.com', false);
    }

    public function test_result_page_shows_back_link(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('Voltar para página inicial');
    }

    public function test_ai_result_shows_instant_prayer_cross_link(): void
    {
        $response = $this->get('/prayer/result?type=ai&religion=catholic');

        $response->assertSee('Pedir oração instantânea');
    }

    public function test_instant_result_shows_ai_prayer_cross_link(): void
    {
        $response = $this->get('/prayer/result?type=instant&religion=catholic');

        $response->assertSee('Pedir oração por IA');
    }

    public function test_person_result_shows_both_cross_links(): void
    {
        $response = $this->get('/prayer/result?type=person-prayer&religion=catholic');

        $response->assertSee('Pedir oração por IA');
        $response->assertSee('Pedir oração instantânea');
    }

    public function test_instant_prayer_with_other_religion_shows_prayer(): void
    {
        $response = $this->get('/prayer/result?type=instant&religion=other');

        $response->assertStatus(200);
        $response->assertSee('Uma bênção para seu momento');
    }

    public function test_same_short_description_returns_same_fallback_prayer(): void
    {
        $first = $this->get('/prayer/result?type=instant&religion=catholic&description=teste');
        $second = $this->get('/prayer/result?type=instant&religion=catholic&description=teste');

        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $first->getContent(), $firstTitle);
        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $second->getContent(), $secondTitle);

        $this->assertSame(trim($firstTitle[1] ?? ''), trim($secondTitle[1] ?? ''));
    }

    public function test_different_short_descriptions_may_return_different_prayers(): void
    {
        $first = $this->get('/prayer/result?type=instant&religion=catholic&description=abc');
        $second = $this->get('/prayer/result?type=instant&religion=catholic&description=xyz');

        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $first->getContent(), $firstTitle);
        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $second->getContent(), $secondTitle);

        $this->assertNotSame(trim($firstTitle[1] ?? ''), trim($secondTitle[1] ?? ''));
    }

    public function test_instant_prayer_with_description_triggers_matcher(): void
    {
        $response = $this->get('/prayer/result?type=instant&religion=catholic&description=precisando+de+livramento+buscando+forca+confiando+em+Deus');

        $response->assertStatus(200);
        $response->assertSee('Uma bênção para seu momento');
        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $response->getContent(), $title);
        $this->assertNotEmpty(trim($title[1] ?? ''));
    }

    public function test_instant_prayer_without_description_renders_random_prayer(): void
    {
        $response = $this->get('/prayer/result?type=instant&religion=catholic&description=');

        $response->assertStatus(200);
        $response->assertSee('Uma bênção para seu momento');
        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $response->getContent(), $title);
        $this->assertNotEmpty(trim($title[1] ?? ''));
    }

    public function test_instant_prayer_no_description_param_renders_random_prayer(): void
    {
        $response = $this->get('/prayer/result?type=instant&religion=catholic');

        $response->assertStatus(200);
        $response->assertSee('Uma bênção para seu momento');
        preg_match('/<h1 class="result-heading mb-2">(.*?)\s*<\/h1>/s', $response->getContent(), $title);
        $this->assertNotEmpty(trim($title[1] ?? ''));
    }
}
