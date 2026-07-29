## Context

Prayer result page (`type=instant`) uses `array_rand()` to pick prayer. `PrayerMatcher::match()` and `KeywordExtractor::extract()` exist but unused. Both are already instantiatable via container.

## Goals / Non-Goals

**Goals:**
- Instant prayers shown by relevance to user description
- Extracted tags displayed above prayer body for transparency
- Graceful fallback when description too short (<3 tokens)

**Non-Goals:**
- Change `PrayerMatcher` or `KeywordExtractor` internals
- Touch other prayer types (ai, person-prayer-*)
- Add new DB tables or queued jobs

## Decisions

- **Inline in Volt component** — no new service/middleware. Both matcher and extractor are lightweight (no IO), safe to call synchronously in `mount()`.
- **Top-1 match** — `PrayerMatcher::match($description, limit: 1)`. Returns the single best-scored prayer. Fallback to random if empty.
- **Tags from extractor, not matcher** — `KeywordExtractor::extract()` returns known tag labels. More readable than raw token overlap.
- **Tags below title, above body** — Chips styled same as existing tag chip pattern (cf. other Volt components). Small visual cue, not primary focus.

## Risks / Trade-offs

- [Cold description] User types 1-2 words → empty match → falls back to random (same UX as today). Acceptable.
- [Over-match] Stopword filter in PrayerMatcher already handles noisy input. Low risk.