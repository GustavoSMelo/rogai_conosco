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
}
