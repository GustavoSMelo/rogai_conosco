## ADDED Requirements

### Requirement: Panelist can open a WhatsApp conversation with the requester

The system SHALL allow a panelist on the responder page to open a WhatsApp Web/app conversation with the requester's phone number, prefilled with a message containing the prayer response and the media link when available.

#### Scenario: Panelist clicks WhatsApp button with valid number and media link
- **WHEN** the panelist clicks "Enviar WhatsApp" and the request has a decrypted WhatsApp number and a media link is set (link input or uploaded file)
- **THEN** the system opens `https://wa.me/<digits-only-number>?text=<urlencoded-message>` in a new tab, where the message contains the greeting, the prayer message, and the line "Ouvir mensagem: {media-url}", sets `whatsappSent` to true, and logs `Log::info` with the request ID

#### Scenario: Panelist clicks WhatsApp button with valid number and no media
- **WHEN** the panelist clicks "Enviar WhatsApp", the request has a decrypted WhatsApp number, and no media link is set
- **THEN** the system opens the wa.me deep link with the greeting and prayer message only (no media line)

#### Scenario: Request has no WhatsApp number
- **WHEN** the request has no decrypted WhatsApp number
- **THEN** the WhatsApp button is disabled and no wa.me link is rendered; the panelist is shown a hint that the requester did not provide a WhatsApp number

#### Scenario: Uploaded file serves as media link
- **WHEN** the panelist uploaded an audio/video file (no link input) and clicks "Enviar WhatsApp"
- **THEN** the prefilled message includes the file's public storage URL, made absolute via the application URL

#### Scenario: Phone number contains formatting characters
- **WHEN** the decrypted WhatsApp number contains non-digit characters (e.g., `+55 (11) 91234-5678`)
- **THEN** the wa.me deep link uses the number with all non-digit characters removed

### Requirement: WhatsApp button state after opening the conversation

After the panelist opens the WhatsApp conversation, the button SHALL be disabled and the page SHALL show the success message "Notificação enviada por WhatsApp".

#### Scenario: Button disabled after opening
- **WHEN** the panelist has opened the WhatsApp conversation (`whatsappSent` is true)
- **THEN** the button is disabled and the success message "Notificação enviada por WhatsApp" is displayed
