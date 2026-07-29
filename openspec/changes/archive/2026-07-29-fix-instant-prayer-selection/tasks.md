## 1. Pass description in welcome form redirect

- [x] 1.1 Add `'description' => $this->message` to the `redirect()` call in `resources/views/welcome.blade.php` line 59
- [x] 1.2 Update existing Feature test `PrayerResultPageTest` to verify description query param is passed in redirect

## 2. Improve fallback for empty description

- [x] 2.1 Modify the fallback logic in `resources/views/prayer-result.blade.php` line 44-48 to detect truly empty description and use `array_rand()` for random selection
- [x] 2.2 Keep deterministic fallback (`crc32`) for short but non-empty descriptions (1-2 tokens)
- [x] 2.3 Add/update tests for empty-description fallback returning a random prayer from the correct tradition

## 3. Verify and cleanup

- [x] 3.1 Run full test suite (`php artisan test`) to confirm no regressions
- [x] 3.2 Manual verification: submit an instant prayer with a description and confirm the result page shows a matching prayer, not always "Pai Nosso"
