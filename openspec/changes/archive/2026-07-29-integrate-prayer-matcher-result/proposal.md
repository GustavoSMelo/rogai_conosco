## Why

Currently `type=instant` picks a random prayer from the user's religion group. User's written description is ignored during selection, losing relevance. PrayerMatcher already scores prayers against text — wire it to show the best match instead.

## What Changes

- Replace random `array_rand()` prayer selection with `PrayerMatcher::match($description)` in prayer result page
- Extract keywords via `KeywordExtractor::extract()` and display as tags above prayer body
- Show fallback random prayer when match returns empty (e.g., description too short)

## Capabilities

### New Capabilities

- `prayer-result-page`: instant mode picks best prayer via PrayerMatcher instead of random

### Modified Capabilities

*(none — existing capabilities unchanged)*

## Impact

- `resources/views/prayer-result.blade.php` — Volt component PHP logic + Blade template
- `app/Services/PrayerMatcher.php` — already exists, no changes needed
- `app/Actions/KeywordExtractor.php` — already exists, no changes needed