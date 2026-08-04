<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WelcomePrayerRequestTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_submit_requires_at_least_one_contact_method(): void
    {
        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração por um familiar.')
            ->call('submit')
            ->assertHasErrors('contact');

        $this->assertDatabaseCount('prayer_requests', 0);
    }

    public function test_submit_with_only_email_creates_prayer_request(): void
    {
        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração por um familiar.')
            ->set('email', 'alguem@example.com')
            ->set('whatsapp', '')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('prayer_requests', [
            'prayer_type' => 'ai',
            'delivery' => 'ai',
        ]);
    }

    public function test_submit_with_only_whatsapp_creates_prayer_request(): void
    {
        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração.')
            ->set('whatsapp', '+5511999999999')
            ->set('email', '')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('prayer_requests', [
            'prayer_type' => 'ai',
            'delivery' => 'ai',
        ]);
    }

    public function test_submit_accepts_nullable_contact_fields(): void
    {
        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração.')
            ->set('email', 'alguem@example.com')
            ->set('whatsapp', null)
            ->call('submit')
            ->assertHasNoErrors();

        $request = PrayerRequest::query()->latest('id')->first();
        $this->assertNotNull($request->email);
        $this->assertNull($request->whatsapp);
    }
}
