## Context

The `prayer-matcher` Volt component accepts user text, passes it to `PrayerMatcher::match()`, and displays ranked prayer results. The `KeywordExtractor` class (already built and tested) can detect which of the 81 known prayer tags appear in the user's text, but this data is currently unused in the UI.

## Goals / Non-Goals

**Goals:**
- Call `KeywordExtractor::extract()` after `PrayerMatcher::match()` in the Volt component
- Display extracted tags as visual chips above the matched prayer results
- Keep extracted tags distinct from per-prayer tags (they represent what the user wrote, not what the prayer contains)

**Non-Goals:**
- No changes to `PrayerMatcher` or its matching algorithm
- No changes to `KeywordExtractor` itself
- No new database tables or data structures

## Decisions

1. **Separate visual section** — Extracted tags shown as a "Temas identificados:" section above prayer results, not merged into per-prayer tag displays. This keeps the distinction between user input themes and prayer content themes clear.

2. **No minimum threshold** — If the user's text yields zero extracted tags, simply omit the section. No artificial fallback messages.

3. **Component state** — Add a `$extractedTags` property to the Volt component, populated alongside `$results` during the `match()` method.

## Risks / Trade-offs

- **[Duplicate tags]** Extracted tags may overlap with prayer result tags — this is intentional (shows the connection). Mitigation: visual separation clarifies the distinction.
- **[Performance]** `KeywordExtractor` iterates all known tags — negligible for 81 tags.
