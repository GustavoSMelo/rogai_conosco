<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotFoundPageTest extends TestCase
{
    public function test_unknown_route_returns_404_status(): void
    {
        $response = $this->get('/rota-que-nao-existe');

        $response->assertNotFound();
    }

    public function test_404_page_has_branded_title(): void
    {
        $response = $this->get('/rota-que-nao-existe');

        $response->assertSee('Página não encontrada');
    }

    public function test_404_page_offers_way_back_home(): void
    {
        $response = $this->get('/rota-que-nao-existe');

        $response->assertSee('Voltar ao início');
    }

    public function test_404_page_shows_comforting_verse(): void
    {
        $response = $this->get('/rota-que-nao-existe');

        $response->assertSee('ovelha que se perdeu');
        $response->assertSee('Lucas 15:4');
    }

    public function test_404_page_has_noindex_meta(): void
    {
        $response = $this->get('/rota-que-nao-existe');

        $response->assertSee('noindex', false);
    }

    public function test_404_page_uses_error_specific_css_classes(): void
    {
        $response = $this->get('/rota-que-nao-existe');

        $response->assertSee('error-heading', false);
        $response->assertSee('error-btn', false);
        $response->assertSee('error-reveal', false);
    }
}
