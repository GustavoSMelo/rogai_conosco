<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeDeliveryOptionsTest extends TestCase
{
    public function test_delivery_options_section_renders_after_how_it_works_section(): void
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSeeInOrder([
                'Como sua oração chega até você',
                'O que você pode receber',
            ]);
    }

    public function test_section_presents_the_three_recorded_sub_options(): void
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSee('Apenas oração')
            ->assertSee('Apenas palavra')
            ->assertSee('Oração + palavra');
    }

    public function test_pray_option_explains_that_a_real_person_prays(): void
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSee('Uma pessoa real ora por você');
    }

    public function test_word_option_explains_that_a_bible_verse_is_searched_for_the_situation(): void
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSee('Um versículo da Bíblia é escolhido para a sua situação');
    }

    public function test_pray_plus_word_option_explains_both_are_combined_in_one_audio_or_video(): void
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSee('a oração e a palavra em um único áudio ou vídeo');
    }
}
