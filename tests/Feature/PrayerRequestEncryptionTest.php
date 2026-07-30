<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class PrayerRequestEncryptionTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_whatsapp_and_email_are_stored_encrypted(): void
    {
        Livewire::test('app::welcome')
            ->set('name', 'Test User')
            ->set('whatsapp', '+5511999999999')
            ->set('email', 'test@example.com')
            ->set('message', 'Pray for me')
            ->set('prayerType', 'instant')
            ->call('submit');

        $prayerRequest = PrayerRequest::where('name', 'Test User')->first();

        $this->assertNotNull($prayerRequest);
        $rawWhatsapp = DB::table('prayer_requests')->where('id', $prayerRequest->id)->value('whatsapp');
        $rawEmail = DB::table('prayer_requests')->where('id', $prayerRequest->id)->value('email');
        $this->assertNotEquals('+5511999999999', $rawWhatsapp);
        $this->assertNotEquals('test@example.com', $rawEmail);
        $this->assertEquals('+5511999999999', Crypt::decryptString($rawWhatsapp));
        $this->assertEquals('test@example.com', Crypt::decryptString($rawEmail));
    }

    public function test_model_level_encryption_works_directly(): void
    {
        $prayerRequest = PrayerRequest::create([
            'name' => 'direct',
            'message' => Crypt::encryptString('test'),
            'delivery' => 'ai',
            'whatsapp' => '+5511888888888',
            'email' => 'direct@example.com',
            'prayer_type' => 'ai',
            'has_answered' => true,
            'date_answered' => now(),
        ]);

        $rawWhatsapp = DB::table('prayer_requests')->where('id', $prayerRequest->id)->value('whatsapp');
        $this->assertNotEquals('+5511888888888', $rawWhatsapp);
        $this->assertEquals('+5511888888888', $prayerRequest->whatsapp);
        $this->assertEquals('direct@example.com', $prayerRequest->email);
    }

    public function test_migration_encrypts_existing_plain_text_fields(): void
    {
        $record = PrayerRequest::create([
            'name' => 'legacy',
            'message' => Crypt::encryptString('old prayer'),
            'delivery' => 'ai',
            'prayer_type' => 'ai',
            'has_answered' => true,
            'date_answered' => now(),
        ]);

        DB::table('prayer_requests')
            ->where('id', $record->id)
            ->update([
                'email' => 'plain@example.com',
                'whatsapp' => '+5511777777777',
            ]);

        $this->runMigrationUp();

        $rawWhatsapp = DB::table('prayer_requests')->where('id', $record->id)->value('whatsapp');
        $prayerRequest = PrayerRequest::find($record->id);
        $this->assertNotEquals('+5511777777777', $rawWhatsapp);
        $this->assertEquals('+5511777777777', $prayerRequest->whatsapp);
        $this->assertEquals('plain@example.com', $prayerRequest->email);
    }

    public function test_migration_leaves_null_fields_null(): void
    {
        PrayerRequest::create([
            'name' => 'null_contact',
            'message' => Crypt::encryptString('test'),
            'delivery' => 'ai',
            'prayer_type' => 'ai',
            'has_answered' => true,
            'date_answered' => now(),
            'email' => null,
            'whatsapp' => null,
        ]);

        $this->runMigrationUp();

        $prayerRequest = PrayerRequest::where('name', 'null_contact')->first();
        $this->assertNull($prayerRequest->whatsapp);
        $this->assertNull($prayerRequest->email);
    }

    public function test_migration_does_not_double_encrypt_already_encrypted_values(): void
    {
        PrayerRequest::create([
            'name' => 'already_enc',
            'message' => Crypt::encryptString('test'),
            'delivery' => 'ai',
            'prayer_type' => 'ai',
            'has_answered' => true,
            'date_answered' => now(),
            'email' => Crypt::encryptString('enc@example.com'),
            'whatsapp' => Crypt::encryptString('+5511666666666'),
        ]);

        $before = DB::table('prayer_requests')->where('name', 'already_enc')->first();

        $this->runMigrationUp();

        $after = DB::table('prayer_requests')->where('name', 'already_enc')->first();

        $this->assertEquals($before->whatsapp, $after->whatsapp);
        $this->assertEquals($before->email, $after->email);
    }

    private function runMigrationUp(): void
    {
        DB::table('prayer_requests')
            ->whereNotNull('whatsapp')
            ->orWhereNotNull('email')
            ->orderBy('id')
            ->chunk(100, function ($rows) {
                foreach ($rows as $row) {
                    $encrypted = [];
                    if ($row->whatsapp !== null) {
                        $encrypted['whatsapp'] = $this->encryptIfPlain($row->whatsapp);
                    }
                    if ($row->email !== null) {
                        $encrypted['email'] = $this->encryptIfPlain($row->email);
                    }
                    if (!empty($encrypted)) {
                        DB::table('prayer_requests')->where('id', $row->id)->update($encrypted);
                    }
                }
            });
    }

    private function encryptIfPlain(string $value): string
    {
        try {
            Crypt::decryptString($value);

            return $value;
        } catch (\Illuminate\Contracts\Encryption\DecryptException) {
            return Crypt::encryptString($value);
        }
    }
}
