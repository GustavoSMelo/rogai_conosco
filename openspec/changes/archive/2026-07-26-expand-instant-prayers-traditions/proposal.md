## Why

The `prays.php` dataset currently only contains Catholic prayers, excluding Protestant and Orthodox Christian traditions. Since the app serves users across all Christian traditions, the prayer library needs to represent the full breadth of Christian devotional life with ~30 curated prayers per tradition.

## What Changes

- Restructure `resources/data/prays.php` to include `catholic`, `protestant`, and `orthodox` sections
- Add ~30 Protestant/Evangelical prayers with biblical and devotional content
- Add ~30 Orthodox prayers drawn from Byzantine and Slavic traditions
- Duplicate prayers common to multiple traditions in each section with tradition-appropriate wording
- Keep existing Catholic prayers in the `catholic` section
- Update tests to validate the new structure

## Capabilities

### New Capabilities
- `expand-prayers`: Expanded instant-prayer dataset with 3 tradition-specific sections, each with ~30 curated prayers

### Modified Capabilities

None.

## Impact

- `resources/data/prays.php` — restructured with new sections, approximately doubles in size
- `tests/Unit/InstantPrayersDataTest.php` — new test file to validate structure across all sections
- No database, API, or schema changes
- UI/prayer display code may need minor updates if it assumes flat structure under a single key
