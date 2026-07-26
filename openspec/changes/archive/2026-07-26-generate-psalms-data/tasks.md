## 1. Data creation

- [x] 1.1 Create `resources/data/psalms.php` with the full NTLH text of all 150 Psalms
- [x] 1.2 Structure each Psalm entry with `chapter` (int) and `verses` (associative array int => string)

## 2. Validation

- [x] 2.1 Write a unit test verifying the file loads and returns an array with exactly 150 entries
- [x] 2.2 Write a unit test verifying each entry has `chapter` and `verses` keys
- [x] 2.3 Write a unit test verifying chapters are consecutive 1-150
- [x] 2.4 Write a unit test verifying Psalm 1 has at least 6 verses
- [x] 2.5 Write a unit test verifying Psalm 150 has at least 6 verses
- [x] 2.6 Verify all tests pass with `php artisan test`
