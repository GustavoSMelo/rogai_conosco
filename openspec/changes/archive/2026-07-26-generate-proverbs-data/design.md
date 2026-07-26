## Context

The app needs a structured dataset of Proverbs in NTLH translation to power prayer features alongside Psalms. Proverbs has 31 chapters with 915 verses total — each verse is a self-contained wisdom saying, making them ideal for prayer generation. The data structure follows the same pattern as `psalms.php`.

## Goals / Non-Goals

**Goals:**
- Create `resources/data/proverbs.php` with all 31 chapters of Proverbs in NTLH translation
- Each chapter structured as `chapter` (int) + `verses` (associative array of verse_number => text)

**Non-Goals:**
- Database storage or Eloquent model
- API endpoints or controllers
- Search or indexing capabilities
- Translation validation or proofreading
- Multi-translation support

## Decisions

- **Structure:** Same as Psalms — `return [ [ "chapter" => 1, "verses" => [ 1 => "text..." ] ] ]` — chapters as sequential array entries, verses keyed by integer.
- **File location:** `resources/data/proverbs.php` — alongside `prays.php` and `psalms.php`.
- **NTLH translation** — follows the same choice established for Psalms.

## Risks / Trade-offs

- **Chapter 31** is long (31 verses, acrostic poem about the virtuous woman) — verify complete text coverage.
- **Self-contained verses** — each verse is a complete thought, so verse splitting is straightforward.
