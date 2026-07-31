## Why

The painel responder page currently uses `simulateEmail()` — a mock that sets a flag without actually sending email. Users receiving prayer responses need real email delivery. Mailtrap API token already exists in `.env`. Need to wire it up.

## What Changes

- Add Mailtrap SMTP configuration to `config/mail.php`
- Replace `simulateEmail()` in `resources/views/painel-responder.blade.php` with real email sending via a Laravel Mailable class
- Create `App\Mail\PrayerResponseMail` mailable
- Create a notification action or use Laravel Mail facade directly
- Wire the send to use `config('mail.mailers.smtp')` with Mailtrap credentials from `.env`
- Add error handling: display success/error to panelist, log success and failures
- Write Feature test for email sending flow

## Capabilities

### New Capabilities
- `email-notification`: Send prayer response notification email via Mailtrap SMTP from the responder panel

### Modified Capabilities

- (none — new capability)

## Impact

- `config/mail.php`: add Mailtrap SMTP mailer config
- `resources/views/painel-responder.blade.php`: replace `simulateEmail()` with `sendEmail()`
- New file: `app/Mail/PrayerResponseMail.php`
- `.env` already has `MAILTRAP_API_TOKEN` — may need additional Mailtrap SMTP vars (`MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`)
- Tests: `tests/Feature/PainelResponderEmailTest.php`
