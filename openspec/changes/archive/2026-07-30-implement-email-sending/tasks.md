## 1. Configuration

- [x] 1.1 Add `mailtrap` mailer entry to `config/mail.php` with SMTP transport, host, port, username, password from env
- [x] 1.2 Add `MAILTRAP_USERNAME` and `MAILTRAP_PASSWORD` to `.env.example` (real values in `.env`)
- [x] 1.3 Set `MAIL_MAILER=mailtrap` in `.env`

## 2. Mailable

- [x] 2.1 Create `app/Mail/PrayerResponseMail.php` — accept message, name, mediaUrl; build subject and content
- [x] 2.2 Create `resources/views/emails/prayer-response.blade.php` — simple HTML email with greeting, prayer text, media link, closing

## 3. Livewire Component

- [x] 3.1 Replace `simulateEmail()` with `sendEmail()` method in `resources/views/painel-responder.blade.php`
- [x] 3.2 Add `$emailError` property and error display in the Blade template
- [x] 3.3 Import `Mail` facade and `PrayerResponseMail` at top of component
- [x] 3.4 Add `Log::info` on success, `Log::error` on SMTP failure, `Log::warning` on missing email in `sendEmail()`

## 4. Tests

- [x] 4.1 Write `tests/Feature/PainelResponderEmailTest.php` covering: successful send, missing email error, SMTP failure handling
- [x] 4.2 Run tests: `php artisan test --filter=PainelResponderEmailTest` — all green
