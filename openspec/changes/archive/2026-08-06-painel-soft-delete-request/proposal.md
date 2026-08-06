# Painel Soft Delete Request

## Why

Operators need to dismiss prayer requests they will not answer (e.g., no contact info, duplicate, out of scope) without losing the historical record. Today there is no way to remove a request from the dashboard besides answering it, which misrepresents the request as "answered".

## What Changes

- Add a trash icon button on each pending request card, next to the "Responder" button.
- Clicking the trash icon opens a dialog where the operator provides the reason for not answering.
- The dialog confirms and soft-deletes the request: sets `deleted_at` and stores `delete_reason`.
- Add two nullable columns to `prayer_requests`:
  - `deleted_at` (timestamp, nullable, default null) — date of deletion.
  - `delete_reason` (text, nullable) — user-provided reason.
- Soft-deleted requests are excluded from painel pending/answered lists and counts. They remain in the database (soft delete) as an audit trail.
- Standard soft delete via the `SoftDeletes` trait on the `PrayerRequest` model.

## Capabilities

### New Capabilities

- `painel-prayer-request-deletion`: Painel permite marcar pedido como não respondido com motivo (soft delete). Abrange: botão lixeira, modal com motivo, persistência de `deleted_at` + `delete_reason`, exclusão de soft-deleted da listagem pendente/respondido.

### Modified Capabilities

- `<existing-name>`: Em branco — nenhuma spec existente muda de requisito nesta mudança.

## Impact

- **Model**: `app/Models/PrayerRequest.php` — adiciona `SoftDeletes`, cast `deleted_at`, `delete_reason` no `$fillable`.
- **Migration**: nova migration adiciona `deleted_at` e `delete_reason` na tabela `prayer_requests`.
- **Controller/Component**: `resources/views/painel/painel.blade.php` (Livewire Volt) — propriedades do modal, método de delete, sempre filtra `whereNull('deleted_at')`.
- **CSS**: `resources/css/painel.css` — estilos do botão lixeira e do modal.
- **Queries**: qualquer consulta em pedidos no painel passa a excluir soft-deleted (`loadRequests`).
- **Sem dependências novas**.