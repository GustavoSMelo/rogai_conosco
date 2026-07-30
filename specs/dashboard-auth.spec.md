# Dashboard Auth Spec

## Scope
Password-protected admin dashboard for viewing unanswered prayer requests.

## Authentication
- Password stored encrypted in `DASHBOARD_PASSWORD` env var via `Crypt::encryptString()`
- Login form decrypts stored value and compares with user input
- Session-based auth (`dashboard_authenticated` flag)
- Middleware protects dashboard route group

## Routes
- `GET /painel/login` — login form
- `POST /painel/login` — authenticate
- `GET /painel` — dashboard (protected)
- `POST /painel/logout` — logout

## Dashboard
- Lists `PrayerRequest` where `has_answered = false`
- Shows: name, message (decrypted), email (decrypted), whatsapp (decrypted), delivery type, prayer type, religion, created_at
- Responsive table layout (desktop) / cards (mobile)
- Each row shows elapsed time since creation
- Empty state when no unanswered requests

## Edge Cases
- Invalid password → error message, no redirect
- Missing DASHBOARD_PASSWORD env → error message
- Decryption failure → error message
- Anonymous requesters show "Anônimo"
- Message truncation at reasonable length
