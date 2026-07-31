## 1. Service (TDD)

- [x] 1.1 Write `tests/Unit/WhatsAppDeepLinkServiceTest.php` — covers: digits-only sanitization, message with media link (absolute URL + urlencoded), message without media, relative `/storage/...` URL made absolute, null phone → null, null mediaUrl → no media line
- [x] 1.2 Create `app/Services/WhatsAppDeepLinkService.php` with `build(?string $phone, string $name, string $prayerMessage, ?string $mediaUrl): ?string` returning `https://wa.me/<digits>?text=<urlencoded message>` or null for empty phone
- [x] 1.3 Run `php artisan test --filter=WhatsAppDeepLinkServiceTest` — all green

## 2. Livewire Component

- [x] 2.1 Remove `simulateWhatsApp()`; add `markWhatsappOpened()` setting `whatsappSent = true` + `Log::info` with request ID and phone
- [x] 2.2 Compute `$this->whatsappUrl` in `render()` via the service (fresh after `wire:set('mediaUrl', ...)`)
- [x] 2.3 Replace WhatsApp button with `<a :href="$whatsappUrl" target="_blank" rel="noopener" wire:click="markWhatsappOpened">` keeping the existing flag/disabled styling; render plain disabled button + hint when `$decryptedWhatsapp` is empty or `$whatsappUrl` is null

## 3. Feature Tests

- [x] 3.1 Write `tests/Feature/PainelResponderWhatsAppTest.php` — anchor renders wa.me href with digits + urlencoded text containing media link; no media → no "Ouvir mensagem" line; uploaded-file relative URL absolutized; missing whatsapp → disabled button, no link; click → `whatsappSent` true + `Log::info`
- [x] 3.2 Run `php artisan test --filter=PainelResponderWhatsAppTest` — all green

## 4. Verification

- [x] 4.1 Run `php artisan test` — full suite green
- [x] 4.2 Run `vendor/bin/pint` and `vendor/bin/phpstan` — clean
