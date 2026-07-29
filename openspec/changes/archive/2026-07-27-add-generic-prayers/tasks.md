## 1. Data Layer

- [x] 1.1 Add `"other"` key to `App\Data\Prays::getPrays()` with 20 curated universal prayers from protestant tradition
- [x] 1.2 Verify each other entry has title, category, subcategory (array), and body

## 2. Fix Consumer Code

- [x] 2.1 Update `prayer-result.blade.php` to use `App\Data\Prays::getPrays()` instead of raw `require`

## 3. Tests

- [x] 3.1 Update `tests/Unit/PrayersDataTest.php` to assert 4 keys (not 3) and validate `other` key presence
- [x] 3.2 Add `other` entries validation in `PrayersDataTest` (structure + min count)
- [x] 3.3 Add feature test for `?type=instant&religion=other` in `PrayerResultPageTest`

## 4. Verify

- [x] 4.1 Run `php artisan test` — all tests pass
