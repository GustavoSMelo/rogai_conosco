## Context

`PrayerMatcher::match()` scores prayers by tag overlap with user text. Multiple prayers often share the same score (e.g., 0.6 for 3 prayers when 3 of 5 signal words match). Current `usort` comparator only compares scores — PHP's `usort` is unstable, so tied elements swap positions unpredictably across runs.

## Goals / Non-Goals

**Goals:**
- Same description always returns same top-1 prayer, even when scores tie
- Minimal change — comparator only

**Non-Goals:**
- Not changing scoring algorithm
- Not adding weights or tag prioritization
- Not changing fallback behavior

## Decisions

- **Secondary sort by prayer title** — when scores are equal, sort alphabetically by `prayer['title']`. Deterministic, stable, no extra data needed.
- **Alternative considered: preserve insertion order** — would require replacing `usort` with custom stable sort. More code, same result since title sort is stricter and more predictable.

## Risks / Trade-offs

- [Alphabetical bias] Alphabetically-first prayer wins ties. Acceptable — deterministic is better than random. Future: weighted tags could break ties more meaningfully.