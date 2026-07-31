## Context

`resources/views/painel/painel-responder.blade.php` is a Livewire Volt component. Its WhatsApp button calls `simulateWhatsApp()` which only sets `$this->whatsappSent = true` — no real action. The component already decrypts the requester's phone (`$this->decryptedWhatsapp`) and tracks the response media via `$this->mediaUrl` (set either by the link input or by file upload, which stores to the public disk and produces a `/storage/response-media/...` URL). The email flow already has a service (`SendPrayerResponseEmailService`) with an `absoluteMediaUrl()` helper that turns relative storage URLs into absolute ones — the WhatsApp flow should reuse the same pattern.

## Goals / Non-Goals

**Goals:**
- Replace `simulateWhatsApp()` with a real action that opens a `wa.me` deep link in a new tab
- Prefill the message with greeting, prayer message, and media link (from link input or uploaded file)
- Sanitize the phone to digits only; guard when no number exists (disabled button + hint)
- Keep the existing flag UX: button disabled after open + "Notificação enviada por WhatsApp" alert
- Extract link building into a testable service; cover with Unit + Feature tests

**Non-Goals:**
- No WhatsApp Business / Cloud API — deep links only, no actual message sending
- No file attachment (wa.me cannot attach files; the file's public URL is sent as text instead)
- No changes to the email flow, media upload flow, or `has_answered` status
- No persistence/history table for opens

## Decisions

1. **`wa.me` deep link over WhatsApp Cloud API** — Zero setup, no API key, works from any browser/device, exactly matches the manual panelist workflow. Alternative (Cloud API) rejected: requires business account, template approvals, webhook infra — overkill for a panelist-driven flow.
2. **New `App\Services\WhatsAppDeepLinkService`** — Mirrors `SendPrayerResponseEmailService`'s place in `app/Services/`. `build(?string $phone, string $name, string $prayerMessage, ?string $mediaUrl): ?string`. Returns `null` when phone is empty after sanitization so the component can render the disabled state. Pure function → trivially unit-testable.
3. **Digits-only sanitization** — `preg_replace('/\D/', '', $phone)`. Brazilian numbers typically come as `+55 (11) 91234-5678`; digits-only is what `wa.me` accepts.
4. **Reuse the absolute-URL pattern** — Uploaded files yield relative `/storage/...` URLs; convert via `url()` helper exactly like `SendPrayerResponseEmailService::absoluteMediaUrl()` (app/Services/SendPrayerResponseEmailService.php:118). Link-input URLs (`https://...` or `/...`) pass through unchanged.
5. **Message text mirrors the email body** — "Olá, {name}. Recebemos seu pedido de oração e preparamos uma resposta para você:\n\n\"{prayerMessage}\"\n\nOuvir mensagem: {mediaUrl}\n\nQue Deus abençoe sua vida e traga paz ao seu coração." URL-encoded for the `text=` query param. Consistency across channels.
6. **Button becomes an anchor** — `<a href="{{ $whatsappUrl }}" target="_blank" rel="noopener">` so WhatsApp opens in a new tab, with `wire:click="markWhatsappOpened"` to set the flag + log. When no number: render plain disabled button + hint. Alternative (JS `window.open` on wire:click) rejected: anchor is more robust (middle-click, no JS timing issues) and the href is directly assertable in feature tests.
7. **`whatsappUrl` computed in `render()`** — `$this->whatsappUrl = app(WhatsAppDeepLinkService::class)->build(...)` at the top of `render()`, so it stays fresh after every `wire:set('mediaUrl', ...)` from the link input. Alternative (computed property) rejected: plain assignment in render is simpler in a Volt self-contained component and has no cache-staleness concerns.
8. **`markWhatsappOpened()`** — sets `whatsappSent = true`, `Log::info('WhatsApp aberto', ['request_id' => ..., 'phone' => ...])`. No double-open guard needed: button disables after first open, matching email UX.

## Risks / Trade-offs

- **`wa.me` opens WhatsApp Web, not the chat directly** → WhatsApp requires an active session; panelist may see the app's landing page. Mitigation: `wa.me` is the official standard; with a prefilled `text` param it starts the conversation draft.
- **Phone without country code may not resolve** → digits are used as provided; if the requester entered a local number, WhatsApp may not find the account. Mitigation: document in hint text; out of scope to normalize (no reliable BR→E.164 inference).
- **Local `/storage/...` URL unreachable from panelist's WhatsApp** → In dev the URL points at the local server. Mitigation: same trade-off as email flow; production serves the public disk properly.
- **No delivery confirmation** → Deep links can't confirm the panelist actually sent the message. Mitigation: `Log::info` on open (request ID, phone); consistent with current mock-level logging.
