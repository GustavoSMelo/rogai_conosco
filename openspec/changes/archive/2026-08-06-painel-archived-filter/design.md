# Design — Painel Archived Filter

## Context

The painel (`resources/views/painel/painel.blade.php`, Livewire Volt) is a two-tab page: "Pendentes" / "Respondidos", driven by the `$filter` string and a set of counts. Requests are soft-deleted via the `SoftDeletes` trait (`deleted_at` + `delete_reason`), and the current `loadRequests()` always filters through non-trashed model scopes. There is currently no way to see or restore archived requests.

## Goals / Non-Goals

**Goals:**

- Third "Arquivados" tab listing soft-deleted requests with deletion date/reason.
- "Desarquivar" button restoring a request (clears `deleted_at`, `delete_reason`).
- Archived count badge; pending/answered/total counts still exclude archived.
- TDD: spec → failing tests → implementation.

**Non-Goals:**

- No hard delete/purge UI.
- No bulk archive/unarchive.
- No changes to archive-on-delete behavior (existing trash flow unchanged).

## Decisions

### 1. `$filter` gains a third value: `archived`

Extend the existing `setFilter(string $filter)` mapping: `pending` | `answered` | `archived`. Blade tab buttons use the existing `painel-filter-btn` styles with a third button. `$filter` is already a public string; UI handles the active state generically.

### 2. Archived listing via `onlyTrashed()`

For `archived`, query `PrayerRequest::onlyTrashed()->where('delivery', 'person')`, ordered by `deleted_at` desc. Only `delivery = 'person'` to match the other tabs. Non-archived views keep the natural SoftDeletes-excluded queries.

- Alternative: same query + `whereNotNull('deleted_at')` — rejected, `onlyTrashed()` is the idiomatic SoftDeletes API.

### 3. Archived count + total count guard

- `archivedCount`: `PrayerRequest::onlyTrashed()->where('delivery', 'person')->count()`.
- `prayerRequestCount`: keep model query (`count()` excludes trashed) — total stays "oracoes realizadas" over non-archived.
- `pendingCount`/`answeredCount`: unchanged (already exclude trashed).

### 4. Unarchive action: `unarchiveRequest(int $id)`

1. `PrayerRequest::onlyTrashed()->where('id', $id)->where('delivery', 'person')->first()`; abort silently if missing (mirrors openDeleteModal guard).
2. Set `delete_reason = null`, then call `restore()` (clears `deleted_at` but NOT `delete_reason`, so null it first).
3. Reload list, keeping the current `archived` filter.

Order matters: set `delete_reason = null` before or via `update`, then `restore()`.

### 5. Archived card rendering

Reuse `painel-card`. The footer shows "Arquivado em {date}" plus a "Desarquivar" button (`painel-btn-unarchive`). Show `delete_reason` in the meta/footer area when present. No Responder/trash buttons in this view — the card footer else-branch already gates those on `date_answered`; render archived branch separately.

### 6. Data shape

Extend the mapped `$requests` array with `deleted_at` and `delete_reason` (decrypted not needed — these are plain text). The mapping already returns plain fields; add `deleted_at` and `delete_reason`.

## Risks / Trade-offs

- [Operator unarchives by accident] → "Desarquivar" is a single click but non-destructive; the request returns to its prior state; can be re-archived via trash flow. Acceptable.
- [delete_reason is not cleared by `restore()`] → Handled explicitly by clearing the field before restore; covered by test.
- [Archived list could grow unbounded] → Only `delivery = person` and ordered desc; pagination not in scope.

## Migration Plan

1. Tests (filter, counts, card content, unarchive) — red.
2. Volt component: filter value, archivedCount, loadRequests archived branch, unarchiveRequest, data mapping.
3. Blade: third tab + archived card branch.
4. CSS: unarchive button.
5. Run full suite + coverage.

Rollback: feature toggles off by removing the tab/branch; no schema change, no rollback needed.