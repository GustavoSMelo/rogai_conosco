# Design — Painel Soft Delete Request

## Context

The painel is a Livewire Volt page (`resources/views/painel/painel.blade.php`) listing prayer requests with `delivery = 'person'`, filtered by `has_answered`. Cards show a "Responder" link (pending only). The `PrayerRequest` model does not currently support soft deletion; the table lacks `deleted_at`/`delete_reason` columns. The painel CSS lives in `resources/css/painel.css` using Tailwind `@apply`.

## Goals / Non-Goals

**Goals:**

- Operator can dismiss a pending request with a mandatory reason, via a trash button + modal.
- Data preserved: soft delete (`deleted_at` + `delete_reason`), not hard delete.
- Painel lists/counts exclude soft-deleted requests.
- Follow project TDD: spec → failing tests → implementation.

**Non-Goals:**

- No restore/untrash UI in this change.
- No hard delete / purge.
- No changes to public-facing pages that show prayers (out of scope unless they query through the model — SoftDeletes trait handles this automatically).
- No changes to answered-request flows.

## Decisions

### 1. SoftDeletes trait instead of manual filtering

Use Laravel's `SoftDeletes` trait on `PrayerRequest`. All model queries (painel, public pages, jobs) automatically exclude soft-deleted rows; `withTrashed()` available for future restore.

- Alternative: manual `whereNull('deleted_at')` in every query — rejected, error-prone, easy to miss a query.

### 2. Migration: nullable columns, no defaults needed

`deleted_at` → `$table->timestamp('deleted_at')->nullable()`; `delete_reason` → `$table->text('delete_reason')->nullable()`. SQLite/MySQL both keep existing rows at NULL automatically; no data backfill needed.

### 3. Modal state lives in the Volt component

Add public properties to the Volt class: `bool $showDeleteModal`, `int $deleteRequestId`, `string $deleteReason`. Trash click sets `$deleteRequestId` and opens modal; confirm validates `deleteReason` (required) and performs `softDelete()`. Cancel resets state.

- Alternative: separate Livewire component for the modal — rejected, single-use dialog on one page doesn't justify it.

### 4. Delete action: `deleteRequest()`

Volt method `deleteRequest()`:

1. Validate `delete_reason` required (`required|string|max:2000`).
2. Load request by id, guard: must be pending (`has_answered = false`), `delivery = person`, not already deleted.
3. Set `delete_reason`, call `delete()` (sets `deleted_at`).
4. Close modal, reset fields, reload list (`loadRequests()`).

### 5. Queries updated in `loadRequests()`

All counts and the list query use `PrayerRequest::where(...)` — with SoftDeletes trait these already exclude trashed rows. No explicit `whereNull` needed. `prayerRequestCount` (total count) must switch to `PrayerRequest::query()->count()` — already uses model query, automatically excludes trashed.

### 6. UI: trash button + modal

- Trash button: SVG trash icon button next to `painel-btn-respond`, shown only in the `@else` branch (pending cards). New CSS class `painel-btn-trash` (icon button, terracotta/danger hover) in `painel.css`.
- Modal: follows existing welcome modal pattern (overlay + centered card). Textarea bound `wire:model="deleteReason"`, error message, "Cancelar" + "Confirmar exclusão" buttons. Only rendered when `$showDeleteModal`.

## Risks / Trade-offs

- [Soft delete hides data from existing public queries that used the model directly] → Expected; that's the intent. Public pages continue working, no hard-delete data loss.
- [User deletes a request by accident] → Modal with explicit confirmation + required reason provides a two-step guard; restore can be added later via `withTrashed()`.
- [Soft-deleted rows accumulate in DB] → Acceptable; keeps audit trail. Purge job possible future work.
- [Validation failure closes no modal / keeps text] → Keep modal open, show inline error, preserve typed reason.

## Migration Plan

1. Add migration with the two columns.
2. Update model (`SoftDeletes`, fillable, casts).
3. Write failing tests (model + Volt feature tests).
4. Implement UI + methods.
5. Run `php artisan test` and pre-commit hooks (Pint, Larastan, PHPUnit).

Rollback: `php artisan migrate:rollback` drops the two columns; data loss limited to reason strings.
