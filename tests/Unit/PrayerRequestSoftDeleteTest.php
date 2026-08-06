<?php

namespace Tests\Unit;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PrayerRequestSoftDeleteTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function createRequest(array $overrides = []): PrayerRequest
    {
        return PrayerRequest::create(array_merge([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ], $overrides));
    }

    public function test_migration_adds_nullable_columns_and_existing_rows_keep_null(): void
    {
        $existing = $this->createRequest();

        $this->assertTrue(Schema::hasColumn('prayer_requests', 'deleted_at'));
        $this->assertTrue(Schema::hasColumn('prayer_requests', 'delete_reason'));

        $deletedAtColumn = collect(Schema::getColumns('prayer_requests'))
            ->firstWhere('name', 'deleted_at');
        $this->assertTrue($deletedAtColumn['nullable']);
        $this->assertNull($deletedAtColumn['default']);

        $deleteReasonColumn = collect(Schema::getColumns('prayer_requests'))
            ->firstWhere('name', 'delete_reason');
        $this->assertTrue($deleteReasonColumn['nullable']);

        $existing->refresh();
        $this->assertNull($existing->deleted_at);
        $this->assertNull($existing->delete_reason);
    }

    public function test_delete_sets_deleted_at_and_reason_is_stored(): void
    {
        $request = $this->createRequest();

        $request->update(['delete_reason' => 'Sem contato para envio']);
        $request->delete();

        $request->refresh();

        $this->assertNotNull($request->deleted_at);
        $this->assertEquals('Sem contato para envio', $request->delete_reason);
    }

    public function test_default_queries_exclude_soft_deleted_rows(): void
    {
        $kept = $this->createRequest();
        $deleted = $this->createRequest(['name' => 'Ana']);
        $deleted->delete();

        $all = PrayerRequest::query()->pluck('id');

        $this->assertTrue($all->contains($kept->id));
        $this->assertFalse($all->contains($deleted->id));
    }

    public function test_with_trashed_returns_soft_deleted_rows(): void
    {
        $deleted = $this->createRequest();
        $deleted->delete();

        $trashed = PrayerRequest::withTrashed()->find($deleted->id);

        $this->assertNotNull($trashed);
        $this->assertNotNull($trashed->deleted_at);
    }

    public function test_restore_clears_deleted_at(): void
    {
        $deleted = $this->createRequest();
        $deleted->delete();

        $deleted->restore();

        $this->assertNull($deleted->fresh()->deleted_at);
    }
}
