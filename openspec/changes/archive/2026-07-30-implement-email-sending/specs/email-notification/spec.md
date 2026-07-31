## ADDED Requirements

### Requirement: Panelist can send prayer response via email

The system SHALL allow a panelist to send the prayer response to the requester's email address using Mailtrap SMTP. The email SHALL include a greeting, the decrypted prayer message, and a comforting biblical message. On success, the panelist sees a confirmation; on failure, an error message with the reason.

#### Scenario: Panelist clicks "Enviar Email" with valid email and media URL
- **WHEN** the panelist clicks "Enviar Email" and the request has a decrypted email and a media URL
- **THEN** the system sends an email via Mailtrap SMTP with subject "Rogai Conosco — Sua Oração Foi Respondida" containing the prayer message and media link, displays a success message, and logs `Log::info` with "Email enviado" and the request ID

#### Scenario: Panelist clicks "Enviar Email" but email is missing
- **WHEN** the panelist clicks "Enviar Email" and the request has no decrypted email
- **THEN** the system shows an error message "Email do solicitante não disponível", does not attempt to send, and logs `Log::warning` with "Email não disponível" and the request ID

#### Scenario: Panelist clicks "Enviar Email" but Mailtrap SMTP fails
- **WHEN** the panelist clicks "Enviar Email" and the Mailtrap SMTP server returns an error or is unreachable
- **THEN** the system catches the exception, logs `Log::error` with the exception message and request ID, and displays a failure message "Falha ao enviar email. Tente novamente."

#### Scenario: Email send is idempotent (no double-send guard yet)
- **WHEN** the panelist clicks "Enviar Email" multiple times
- **THEN** the system sends a new email each time (no dedup — future enhancement)

### Requirement: Mailtrap SMTP mailer is configured

The `config/mail.php` file SHALL define a `mailtrap` mailer using SMTP transport with host, port, username, and password read from `.env`. The `default` mailer SHALL switch to `mailtrap` for the painel environment (or override in `.env`).

#### Scenario: Mailtrap mailer is configured correctly
- **WHEN** the system reads `config('mail.mailers.mailtrap')`
- **THEN** it returns an array with `transport=smtp`, `host=sandbox.smtp.mailtrap.io`, `port=2525`, `username` from `MAILTRAP_USERNAME`, `password` from `MAILTRAP_PASSWORD`, and `encryption=tls`

### Requirement: PrayerResponseMail mailable is sendable

The `App\Mail\PrayerResponseMail` class SHALL accept the prayer message, requester name, and optional media URL. It SHALL render from `resources/views/emails/prayer-response.blade.php`.

#### Scenario: Mailable renders with all fields
- **WHEN** `PrayerResponseMail` is constructed with a message, name, and media URL, then converted to a `Mailables\Content`
- **THEN** the content has `subject=Rogai Conosco — Sua Oração Foi Respondida` and the view contains the message text, the name (or "Anônimo"), and the media link
