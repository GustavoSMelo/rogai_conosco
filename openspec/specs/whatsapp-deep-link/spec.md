# WhatsApp Deep Link

## Purpose

Allow panelists to open a WhatsApp Web/app conversation with the requester from the responder page, prefilled with the prayer response and media link.

## Requirements

### Requirement: Panelist can open a WhatsApp conversation with the requester

The system SHALL allow a panelist on the responder page to open a WhatsApp Web/app conversation with the requester's phone number, prefilled with a message containing the prayer response and the media link when available.

#### Scenario: Panelist clicks WhatsApp button with valid number and media link
- **WHEN** the panelist clicks "Enviar WhatsApp" and the request has a decrypted WhatsApp number and a media link is set in the link input
- **THEN** the system opens `https://wa.me/<digits-only-number>?text=<urlencoded-message>` in a new tab, where the message contains the greeting, the prayer message, and the line "Ouvir mensagem: {media-url}", sets `whatsappSent` to true, and logs `Log::info` with the request ID

#### Scenario: Panelist clicks WhatsApp button but no link was filled in
- **WHEN** the panelist has a decrypted WhatsApp number but no media link is set in the link input
- **THEN** the WhatsApp button is disabled, no wa.me link is rendered, and the panelist is shown a hint that a media link is required to send via WhatsApp

#### Scenario: Panelist fills in a link that is not a valid https URL
- **WHEN** the panelist fills in a link that does not start with `https://` or whose domain does not end in `.com`, `.com.br`, `.dev`, `.dev.br`, `.app`, or `.app.br`
- **THEN** the WhatsApp button is disabled, no wa.me link is rendered, and the panelist is shown a hint describing the required format

#### Scenario: Panelist fills in a valid https URL with an allowed TLD
- **WHEN** the panelist fills in a link starting with `https://` whose domain ends in `.com`, `.com.br`, `.dev`, `.dev.br`, `.app`, or `.app.br` (with or without a path)
- **THEN** the WhatsApp button is enabled and renders the wa.me deep link with the media link in the message

#### Scenario: Request has no WhatsApp number
- **WHEN** the request has no decrypted WhatsApp number
- **THEN** the WhatsApp button is disabled and no wa.me link is rendered; the panelist is shown a hint that the requester did not provide a WhatsApp number

#### Scenario: Uploaded file is ignored for WhatsApp
- **WHEN** the panelist uploaded an audio/video file but did not fill in a media link
- **THEN** the WhatsApp button is disabled and no wa.me link is rendered; the uploaded file is never used as the WhatsApp message link

#### Scenario: Link input is used even when a file is uploaded
- **WHEN** the panelist both uploaded a file and filled in a media link
- **THEN** the prefilled message includes the link input value, never the uploaded file's storage URL

#### Scenario: Phone number contains formatting characters
- **WHEN** the decrypted WhatsApp number contains non-digit characters (e.g., `+55 (11) 91234-5678`)
- **THEN** the wa.me deep link uses the number with all non-digit characters removed

#### Scenario: Message opens with a greeting based on time of day
- **WHEN** the panelist opens the WhatsApp conversation between 05:00 and 11:59
- **THEN** the prefilled message starts with "Bom dia, {name}."

#### Scenario: Message opens with an afternoon greeting
- **WHEN** the panelist opens the WhatsApp conversation between 12:00 and 17:59
- **THEN** the prefilled message starts with "Boa tarde, {name}."

#### Scenario: Message opens with an evening greeting
- **WHEN** the panelist opens the WhatsApp conversation between 18:00 and 04:59
- **THEN** the prefilled message starts with "Boa noite, {name}."

### Requirement: WhatsApp button state after opening the conversation

After the panelist opens the WhatsApp conversation, the button SHALL be disabled and the page SHALL show the success message "Notificação enviada por WhatsApp".

#### Scenario: Button disabled after opening
- **WHEN** the panelist has opened the WhatsApp conversation (`whatsappSent` is true)
- **THEN** the button is disabled and the success message "Notificação enviada por WhatsApp" is displayed
