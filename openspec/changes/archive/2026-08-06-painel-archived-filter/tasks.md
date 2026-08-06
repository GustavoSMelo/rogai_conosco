# Tasks — Painel Archived Filter

## 1. Tests

- [x] 1.1 Feature test: archived tab shows with archived count badge
- [x] 1.2 Feature test: selecting archived filter lists only soft-deleted requests ordered by deleted_at desc
- [x] 1.3 Feature test: archived card shows deletion date and delete_reason and hides Responder/trash buttons
- [x] 1.4 Feature test: unarchiveRequest clears deleted_at and delete_reason and reloads archived list
- [x] 1.5 Feature test: unarchived pending request returns to pending list; answered returns to answered list
- [x] 1.6 Feature test: pending/answered/total counts continue to exclude archived requests

## 2. Volt Component

- [x] 2.1 Add `archivedCount` public property computed with `onlyTrashed()`
- [x] 2.2 Extend `setFilter` to accept `archived`
- [x] 2.3 Add archived branch to `loadRequests()` using `onlyTrashed()` ordered by `deleted_at` desc
- [x] 2.4 Add `deleted_at` and `delete_reason` to requests array mapping
- [x] 2.5 Add `unarchiveRequest(int $id)` method (guard onlyTrashed + delivery person, clear reason, restore, reload)

## 3. UI (blade + css)

- [x] 3.1 Add "Arquivados" filter tab with archived count badge
- [x] 3.2 Render archived card branch: archived date, delete_reason, "Desarquivar" button
- [x] 3.3 Add `painel-btn-unarchive` styles in `resources/css/painel.css`

## 4. Verification

- [x] 4.1 Run `php artisan test` — all pass
- [x] 4.2 Run `php artisan test --coverage` — coverage ≥ 75%
- [x] 4.3 Run Pint + Larastan — no new violations