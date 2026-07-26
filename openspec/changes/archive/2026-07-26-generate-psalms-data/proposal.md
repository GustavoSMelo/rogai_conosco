## Why

The prayer app needs a curated dataset of Psalms to power instant prayer and AI-generated prayer features. Currently, the Bible's richest prayer-and-praise book is absent from the data layer, limiting the biblical authenticity of generated prayers. Adding the entire Book of Psalms in BLT (Bíblia Livre para Todos) translation provides a canonical base for referencing scripture in user-facing prayers.

## What Changes

- Create `resources/data/psalms.php` with the full 150 Psalms in array format
- Each Psalm entry will include chapter number, verses array, and per-verse text in BLT translation
- Follow the existing pattern in `resources/data/prays.php`

## Capabilities

### New Capabilities
- `psalms-data`: Structured repository of all 150 Psalms in BLT translation, accessible as a PHP array for prayer generation and scripture reference features

### Modified Capabilities

None.

## Impact

- `resources/data/psalms.php` — new file, ~600KB
- `resources/data/` — adds to the data directory alongside `prays.php`
- No database, API, or schema changes
