## Why

`PrayerMatcher::match()` uses `usort` which is not stable — prayers with identical scores return in arbitrary order across runs. Same description can yield different top-1 prayers when multiple prayers tie on score. Users perceive broken/unreliable matching.

## What Changes

- Make score tie-breaking deterministic in `PrayerMatcher::match()` — secondary sort by prayer title (alphabetical) when scores are equal
- Add test verifying same description always returns same top-1 prayer across multiple calls

## Capabilities

### New Capabilities

*(none)*

### Modified Capabilities

- `conversational-matching`: match results SHALL be deterministic — tied scores broken by stable secondary sort

## Impact

- `app/Services/PrayerMatcher.php` — `usort` comparator in `match()` method
- `openspec/specs/conversational-matching/spec.md` — delta spec for deterministic tie-breaking