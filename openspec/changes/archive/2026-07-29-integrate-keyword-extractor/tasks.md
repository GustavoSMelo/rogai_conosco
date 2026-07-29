## 1. Integrate KeywordExtractor into Volt Component

- [x] 1.1 Add `use App\Actions\KeywordExtractor` import to the Volt component
- [x] 1.2 Add `$extractedTags` property to component state
- [x] 1.3 Call `KeywordExtractor::extract()` in the `match()` method alongside `PrayerMatcher`

## 2. Display Extracted Tags in UI

- [x] 2.1 Add "Temas identificados:" section above prayer results when extracted tags exist
- [x] 2.2 Render extracted tags as chips using the same tag chip styling

## 3. Verify

- [x] 3.1 Run `php artisan test` — all existing tests pass
