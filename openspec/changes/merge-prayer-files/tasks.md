## 1. Normalize category/subcategory in prays.php

- [x] 1.1 Re-categorize all catholic entries using snake_case taxonomy
- [x] 1.2 Re-categorize all protestant entries using snake_case taxonomy
- [x] 1.3 Re-categorize all orthodox entries using snake_case taxonomy

## 2. Merge new-prays.php entries

- [x] 2.1 Identify which prayers from new-prays.php are already in prays.php (skip duplicates)
- [x] 2.2 Add remaining unique prayers from new-prays.php into catholic section with proper snake_case categories
- [x] 2.3 Remove `namespace App\Data;` line from prays.php

## 3. Cleanup and validation

- [x] 3.1 Delete resources/data/new-prays.php
- [x] 3.2 Run `php artisan test --filter=PrayersDataTest` to verify all tests pass
- [x] 3.3 Run full test suite to confirm no regressions
