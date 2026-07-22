## Why

Prayer request submission fails with `NOT NULL constraint failed: prayer_requests.delivery` because the controller never passes `delivery` to `PrayerRequest::create()` — the validation rules don't include `delivery`, and the form only sends `prayer_type`. The `delivery` column needs to be derived from `prayer_type` before insertion.

## What Changes

- Add `'delivery'` to the `$fillable` array in `app/Models/PrayerRequest.php`
- Add `delivery` validation rule and derivation logic in `PrayerRequestController::store()`, mapping `prayer_type` values to their higher-level delivery method

## Capabilities

### New Capabilities
- None — this is a bug fix, not a new capability.

### Modified Capabilities
- None — no spec-level behavior changes.

## Impact

- `app/Models/PrayerRequest.php`: one-line change to `$fillable`
- `app/Http/Controllers/PrayerRequestController.php`: add validation rule and mapping logic
- No migration, no schema change — the column already exists
