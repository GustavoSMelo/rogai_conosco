## Context

The app needs a structured dataset of all 150 Psalms in BLT (Bíblia Livre para Todos) translation to feed instant prayer and AI-generated prayer features. The existing `resources/data/prays.php` returns a flat PHP array with `title`, `category`, `subcategory`, and `body` keys. Psalms data requires a different structure — chapter/verse organization rather than a flat prayer list.

## Goals / Non-Goals

**Goals:**
- Create `resources/data/psalms.php` with all 150 Psalms in BLT translation
- Each Psalm structured as `chapter` (int) + `verses` (associative array of verse_number => text)
- Follow PHP array pattern used by `prays.php`

**Non-Goals:**
- Database storage or Eloquent model
- API endpoints or controllers
- Search or indexing capabilities
- Translation validation or proofreading
- Multi-translation support

## Decisions

- **Structure:** `return [ [ "chapter" => 1, "verses" => [ 1 => "text...", 2 => "text..." ] ], ... ]` — verses keyed by integer for direct lookup, chapters as sequential array entries.
- **File location:** `resources/data/psalms.php` — same directory as `prays.php`, no namespace or class wrapper.
- **No `return` wrapper per entry:** The file returns a single array; each Psalm is an element. Matches existing data convention.
- **NTLH translation** (Nova Tradução na Linguagem de Hoje) — chosen because it uses modern, accessible Brazilian Portuguese similar to the original BLT intent, and covers the entire Bible (BLT is NT-only).

## Risks / Trade-offs

- **File size** (~600KB, 150 chapters) — loading all 150 Psalms into memory on every request is wasteful. Mitigation: the file loads only when prayer features need it. If this becomes a bottleneck, a future lazy-loading or database solution can replace it.
- **Manual data entry** — large surface for typos or transcription errors. Mitigation: verify against canonical BLT source. Automated validation test can spot structural integrity.
