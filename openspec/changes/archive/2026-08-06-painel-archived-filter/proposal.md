# Painel Archived Filter

## Why

Soft-deleted prayer requests currently disappear from the painel with no way to see or recover them. Operators need an "Arquivados" view to audit dismissed requests and a "Desarquivar" action to restore a request that was archived by mistake.

## What Changes

- Add a third filter tab "Arquivados" beside "Pendentes" and "Respondidos".
- The archived view lists requests whose `deleted_at` is not null, ordered by deletion date (desc).
- Archived cards show the deletion date and reason (`delete_reason`) when present.
- Add a "Desarquivar" button on each archived card that restores the request: sets `deleted_at = null` and `delete_reason = null`.
- Restored requests return to the pending/answered lists (a restored request keeps its `has_answered` state).
- Counts: add an archived count badge on the filter tab; pending/answered/total counts continue to exclude archived requests.
- No hard delete/purge in this change.

## Capabilities

### New Capabilities

- Em branco — nenhuma capacidade totalmente nova.

### Modified Capabilities

- `painel-prayer-request-deletion`: Adiciona o filtro "Arquivados" (lista de pedidos com `deleted_at` preenchido), a contagem de arquivados, a exibição do motivo/data de exclusão no cartão arquivado, e a ação "Desarquivar" que limpa `deleted_at` e `delete_reason`.

## Impact

- **Component**: `resources/views/painel/painel.blade.php` (Livewire Volt) — novo filtro `archived`, contagem `archivedCount`, listagem com `onlyTrashed()`, método `unarchiveRequest()`, cartão mostra motivo/data.
- **CSS**: `resources/css/painel.css` — estilos do botão "Desarquivar" e do cartão arquivado (badge/reason).
- **Model**: `PrayerRequest` — já possui `SoftDeletes`; `restore()` nativo cobre a limpeza de `deleted_at`; `delete_reason` limpo manualmente.
- **Tests**: `tests/Feature/PainelArchivedFilterTest.php` (novo) — filtro, contagem, desarquivar.
- **Sem dependências novas.**