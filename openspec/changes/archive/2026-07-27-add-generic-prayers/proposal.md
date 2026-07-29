## Why

Users who select "Outra" (other) religion in the prayer request form get no instant prayer — the `other` key missing in `prays.php` causes `$prayers['other'] ?? []` to resolve to an empty array. Adding a curated set of universal prayers ensures every user receives a meaningful prayer regardless of denomination.

## What Changes

- **`resources/data/prays.php`**: Add `"other"` key to `App\Data\Prays::getPrays()` return with ~20 denomination-neutral prayers curated from all three existing traditions
- **`resources/views/prayer-result.blade.php`**: Use `Prays::getPrays()` instead of raw `require` (religion dropdown value `other` directly matches the data key)
- **`tests/Unit/PrayersDataTest.php`**: Update assertion from 3 keys to 4; validate `other` key presence and entry structure
- **`tests/Feature/PrayerResultPageTest.php`**: Add test for `type=instant&religion=other`

## Capabilities

### New Capabilities

- `other-prayers`: An `other` prayer collection in the data layer that serves users who select "Outra" in the religion dropdown. Contains universal Christian prayers free of denomination-specific content (e.g., no Marian prayers, no saint-specific petitions, no tradition-specific creeds).

### Modified Capabilities

- `prayer-data`: The existing prayer dataset (`prays.php`) gains a fourth top-level key. All existing keys (`catholic`, `protestant`, `orthodox`) remain unchanged.

## Impact

- `App\Data\Prays` class: one new key in return array (no breaking changes)
- `prayer-result.blade.php`: small logic addition (religion mapping)
- No database, API, or dependency changes
