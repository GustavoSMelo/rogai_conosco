## 1. Component Logic

- [ ] 1.1 Add `$loadingInstant` property and `loadInstantPrayer()` method to the Volt component in `resources/views/prayer-result.blade.php`
- [ ] 1.2 Wire `loadInstantPrayer()` to `wire:init` so it fires after initial render for `type === 'instant'`
- [ ] 1.3 In `loadInstantPrayer()`: try `AiService::findBestPrayMatch()`, catch exceptions, fall back to `PrayerMatcherService::match()` + `KeywordExtractorService::extract()`
- [ ] 1.4 Keep `AiService::generate()` unchanged for `type === 'ai'`

## 2. Template Changes

- [ ] 2.1 Add loading spinner HTML/CSS for `$loadingInstant` state in the instant prayer section
- [ ] 2.2 Update instant prayer result display to handle both LLM-matched prayer (from `findBestPrayMatch`) and keyword-matched prayer (from `PrayerMatcherService`)

## 3. Tests

- [ ] 3.1 Update `PrayerResultPageTest` to account for async loading behavior in instant prayer
- [ ] 3.2 Add unit test for `AiService::findBestPrayMatch` error handling (HTTP failure → null)

## 4. Verify

- [ ] 4.1 Run `php artisan test` to confirm no regressions
- [ ] 4.2 Manual verification: visit `/prayer/result?type=instant&description=teste` and confirm loading state + prayer result
