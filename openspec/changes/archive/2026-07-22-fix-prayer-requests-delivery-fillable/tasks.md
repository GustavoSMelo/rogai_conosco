## 1. Model Fix

- [x] 1.1 Add `'delivery'` to the `$fillable` array in `app/Models/PrayerRequest.php`

## 2. Controller Fix

- [x] 2.1 Add `delivery` validation rule and derivation logic in `PrayerRequestController::store()`

## 3. Verification

- [x] 3.1 Run `php artisan test` to confirm no regressions — 1 test passed
- [x] 3.2 Submit a prayer request form to confirm the error is resolved
