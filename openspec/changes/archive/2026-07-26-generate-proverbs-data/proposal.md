## Why

The app needs biblical wisdom literature to power instant prayer and AI-generated prayer features. The Book of Proverbs, rich in concise, prayer-like wisdom sayings, complements the Psalms dataset already in progress. Adding Proverbs in NTLH translation provides a second canonical base for scripture-backed content.

## What Changes

- Create `resources/data/proverbs.php` with all 31 chapters of Proverbs in NTLH translation
- Each chapter entry will include chapter number, verses array, and per-verse text
- Follow the same pattern established by `resources/data/psalms.php`

## Capabilities

### New Capabilities
- `proverbs-data`: Structured repository of all 31 chapters of Proverbs in NTLH translation, accessible as a PHP array for prayer generation and scripture reference features

### Modified Capabilities

None.

## Impact

- `resources/data/proverbs.php` — new file
- `resources/data/` — adds alongside `prays.php` and the upcoming `psalms.php`
- No database, API, or schema changes
