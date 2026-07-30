<?php

use App\Models\PrayerRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
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
                        PrayerRequest::withoutEvents(fn () =>
                            DB::table('prayer_requests')->where('id', $row->id)->update($encrypted)
                        );
                    }
                }
            });
    }

    public function down(): void
    {
        DB::table('prayer_requests')
            ->whereNotNull('whatsapp')
            ->orWhereNotNull('email')
            ->orderBy('id')
            ->chunk(100, function ($rows) {
                foreach ($rows as $row) {
                    $decrypted = [];
                    if ($row->whatsapp !== null) {
                        $decrypted['whatsapp'] = $this->decryptIfEncrypted($row->whatsapp);
                    }
                    if ($row->email !== null) {
                        $decrypted['email'] = $this->decryptIfEncrypted($row->email);
                    }
                    if (!empty($decrypted)) {
                        PrayerRequest::withoutEvents(fn () =>
                            DB::table('prayer_requests')->where('id', $row->id)->update($decrypted)
                        );
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

    private function decryptIfEncrypted(string $value): string
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Illuminate\Contracts\Encryption\DecryptException) {
            return $value;
        }
    }
};
