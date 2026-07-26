## Why

`resources/data/prays.php` has verbose Portuguese formal names for `category` and `subcategory` fields, while `resources/data/new-prays.php` uses a concise snake_case keyword system. The two files need to be merged into one canonical source, with unified category/subcategory taxonomy.

## What Changes

- Merge all unique prayers from `resources/data/new-prays.php` into `resources/data/prays.php`
- Re-categorize all entries in `prays.php` to use the snake_case keyword pattern from `new-prays.php`
- Remove `namespace App\Data;` from `prays.php`
- Delete `resources/data/new-prays.php` after merge

## Capabilities

### New Capabilities
- `prayer-category-taxonomy`: unified snake_case keyword taxonomy for prayer categories and subcategories

### Modified Capabilities
- (none — no existing specs define prayer data structure)

## Impact

- `resources/data/prays.php` — restructured categories, new entries added
- `resources/data/new-prays.php` — deleted after merge
- `tests/Unit/PrayersDataTest.php` — assertions may need updating if category values are tested
