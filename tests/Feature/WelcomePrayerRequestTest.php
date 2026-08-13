<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use App\Services\SendPrayerResponseEmailService;
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

    public function test_submit_person_type_with_email_sends_confirmation_email(): void
    {
        $this->mock(SendPrayerResponseEmailService::class)
            ->shouldReceive('send')
            ->once()
            ->withArgs(function (string $to, string $name, string $prayerMessage): bool {
                return $to === 'alguem@example.com'
                    && $name === 'Maria'
                    && $prayerMessage === 'Pedido de oração por um familiar.';
            });

        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração por um familiar.')
            ->set('name', 'Maria')
            ->set('email', 'alguem@example.com')
            ->set('whatsapp', '')
            ->set('prayerType', 'person-prayer-audio')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('prayer_requests', [
            'prayer_type' => 'person-prayer-audio',
            'delivery' => 'person',
        ]);
    }

    public function test_submit_ai_type_with_email_does_not_send_email(): void
    {
        $this->mock(SendPrayerResponseEmailService::class)
            ->shouldNotReceive('send');

        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração.')
            ->set('email', 'alguem@example.com')
            ->set('whatsapp', '')
            ->set('prayerType', 'ai')
            ->call('submit')
            ->assertHasNoErrors();
    }

    public function test_submit_person_type_without_email_does_not_send_email(): void
    {
        $this->mock(SendPrayerResponseEmailService::class)
            ->shouldNotReceive('send');

        Livewire::test('app::welcome')
            ->set('message', 'Pedido de oração.')
            ->set('whatsapp', '+5511999999999')
            ->set('email', '')
            ->set('prayerType', 'person-bible-video')
            ->call('submit')
            ->assertHasNoErrors();
    }
}
