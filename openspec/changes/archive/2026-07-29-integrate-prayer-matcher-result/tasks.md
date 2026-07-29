## 1. Integrate PrayerMatcher into Volt Component

- [x] 1.1 Add `use App\Services\PrayerMatcher` and `use App\Actions\KeywordExtractor` imports
- [x] 1.2 Add `$extractedTags` property to component state
- [x] 1.3 Replace `array_rand()` with `PrayerMatcher::match($description, limit: 1)` in `mount()` for `type=instant`
- [x] 1.4 Fallback to random prayer when match returns empty

## 2. Display Extracted Tags and Match Info in UI

- [x] 2.1 Call `KeywordExtractor::extract($description)` and store in `$extractedTags`
- [x] 2.2 Add "Temas identificados:" section above prayer body when tags exist
- [x] 2.3 Show match score as subtle badge next to prayer title

## 3. Verify

- [x] 3.1 Run `php artisan test` — all existing tests pass