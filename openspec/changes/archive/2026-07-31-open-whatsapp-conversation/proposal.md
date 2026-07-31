## Why

The painel responder page's WhatsApp button calls `simulateWhatsApp()` — a mock that only sets a flag and opens nothing. Panelists have no way to actually reach the requester on WhatsApp with the prepared prayer response, despite the requester's phone being decrypted and available.

## What Changes

- Replace `simulateWhatsApp()` in `resources/views/painel/painel-responder.blade.php` with a real action that opens a WhatsApp Web/app conversation with the requester's phone number
- Create `App\Services\WhatsAppDeepLinkService` that builds a `wa.me` deep link with a prefilled message: greeting, prayer message, and the response media link when one is provided (link input or uploaded file URL — uploaded files already produce a public `/storage/...` URL)
- Sanitize the phone number to digits only for the deep link; when no WhatsApp number is available, disable the button with an explanatory hint instead of silently succeeding
- Preserve the existing flag UX: after opening the conversation the button becomes disabled and shows "Notificação enviada por WhatsApp"
- Log `Log::info` when the conversation is opened (request ID, phone)

## Capabilities

### New Capabilities
- `whatsapp-deep-link`: Opens a WhatsApp conversation with the requester from the painel responder, prefilled with the prayer response and media link

### Modified Capabilities
- (none — new capability)

## Impact

- New file: `app/Services/WhatsAppDeepLinkService.php`
- `resources/views/painel/painel-responder.blade.php`: replace `simulateWhatsApp()` with deep-link opening + `markWhatsappOpened()`; WhatsApp button becomes a link (`target="_blank"`), disabled without a number
- Tests: `tests/Unit/WhatsAppDeepLinkServiceTest.php`, `tests/Feature/PainelResponderWhatsAppTest.php`
- No API/dependency changes — uses public `wa.me` links only
