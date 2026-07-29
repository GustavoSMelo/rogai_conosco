## Why

Same short description (e.g., "teste") returns different prayers each time. `PrayerMatcher::match()` returns empty for <3 tokens → fallback `array_rand()` is non-deterministic. Users perceive broken/unreliable matching.

## What Changes

- Replace `array_rand()` fallback with deterministic hash-based selection (`crc32` mod count)
- `prayer-result-page`: MODIFIED fallback behavior requirement (deterministic, not random)
- No changes to `PrayerMatcher` or `KeywordExtractor` internals

## Capabilities

### New Capabilities

*(none — behavioral fix only)*

### Modified Capabilities

- `prayer-result-page`: instant prayer fallback when match returns empty SHALL be deterministic — same description always picks same prayer

## Impact

- `resources/views/prayer-result.blade.php` — Volt component PHP logic (fallback line)
- `openspec/specs/prayer-result-page/spec.md` — delta spec for modified requirement