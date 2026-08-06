# Tasks — Painel Soft Delete Request

## 1. Migration + Model

- [x] 1.1 Create migration adding nullable `deleted_at` (timestamp) and `delete_reason` (text) to `prayer_requests`
- [x] 1.2 Add `SoftDeletes` trait to `PrayerRequest` model
- [x] 1.3 Add `delete_reason` to `$fillable` and `deleted_at` cast (datetime) in `PrayerRequest`

## 2. Tests

- [x] 2.1 Write unit/feature test: migration adds nullable columns and existing rows keep null values
- [x] 2.2 Write model test: `delete()` sets `deleted_at`; default queries exclude soft-deleted rows; `withTrashed()` returns them
- [x] 2.3 Write feature test: trash button shown on pending card, hidden on answered card
- [x] 2.4 Write feature test: confirm deletion with reason soft-deletes request (sets `deleted_at`, stores `delete_reason`)
- [x] 2.5 Write feature test: confirm with empty reason shows validation error and does not delete
- [x] 2.6 Write feature test: cancel closes dialog without modifying request
- [x] 2.7 Write feature test: painel lists and pending/answered/total counts exclude soft-deleted requests

## 3. Volt Component (backend of blade)

- [x] 3.1 Add public properties: `showDeleteModal`, `deleteRequestId`, `deleteReason`
- [x] 3.2 Add `openDeleteModal(int $id)` method (guard: pending + delivery person)
- [x] 3.3 Add `cancelDelete()` method resetting modal state
- [x] 3.4 Add `deleteRequest()` method with `required|string|max:2000` validation, soft delete, reload list

## 4. UI (blade + css)

- [x] 4.1 Add trash icon button next to "Responder" link (pending cards only) with `painel-btn-trash` class
- [x] 4.2 Add delete-reason modal markup (textarea, error, Cancelar/Confirmar buttons) bound to component state
- [x] 4.3 Add `painel-btn-trash` styles in `resources/css/painel.css` (icon button, danger hover)
- [x] 4.4 Add modal styles in `resources/css/painel.css` (overlay, card, form input reuse)

## 5. Verification

- [x] 5.1 Run `php artisan test` — all tests pass
- [x] 5.2 Run `php artisan test --coverage` — coverage ≥ 75%
- [x] 5.3 Run Pint + Larastan (pre-commit hook) — no violations
