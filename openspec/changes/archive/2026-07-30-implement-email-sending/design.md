## Context

Painel responder view (`resources/views/painel-responder.blade.php`) is a Livewire Volt component. Its `simulateEmail()` method sets `$this->emailSent = true` — no real delivery. Mailtrap API token exists in `.env` but SMTP mailer is set to `log`. The component has `decryptedEmail` available but never uses it for actual sending.

## Goals / Non-Goals

**Goals:**
- Replace `simulateEmail()` with `sendEmail()` that delivers via Mailtrap SMTP
- Create `App\Mail\PrayerResponseMail` mailable with prayer response content
- Configure Mailtrap SMTP mailer in `config/mail.php`
- Show success/error feedback to panelist after send attempt
- Write Feature test covering the send-and-redirect flow
- After click in sending email button, this button should be disabled and with a loading indicator, after the email was sended the button should be disabled with a success message

**Non-Goals:**
- Not adding email queue/job system — send synchronously for now (MVP)
- Not changing WhatsApp behavior
- Not adding email templates beyond basic mailable view
- Not adding email history table/persistent DB log (future)

## Decisions

1. **Laravel Mailables over Notification** — Mailable is simpler for one-off transactional email. Notifications add channel abstraction we don't need yet.
2. **Synchronous send** — Queue adds complexity (queue worker, failed jobs table). MVP sends inline. If latency becomes an issue, wrap in `Mail::later()`.
3. **Mailtrap SMTP, not API** — Mailtrap API (`mailtrap-php`) requires extra package. SMTP with existing Laravel mailer works out of box. Switch API later if rate limits or analytics needed.
4. **Inline Blade view for email body** — Keep `resources/views/emails/prayer-response.blade.php` minimal. No markdown mailables (extra dependency).
5. **Laravel Log facade for app-level logging** — Use `Log::info()` on success, `Log::error()` on failure. Lighter than events/DB table. No persistent queryable log.

## Risks / Trade-offs

- **Blocking send** → If Mailtrap is slow, panelist waits. Mitigation: short timeout config. Add queue later if needed.
- **Credential leak** → SMTP password in `.env` is standard Laravel practice. Already follows existing pattern.
- **Undeliverable email** → Invalid address, mailbox full. Mitigation: try/catch, `Log::error` with exception details, show "falha no envio" message.
- **No audit trail** → Operator can't confirm delivery. Mitigation: `Log::info` on success (request ID, email). No DB persistence yet.
