## 1. Data creation

- [x] 1.1 Create `resources/data/proverbs.php` with the full NTLH text of all 31 chapters of Proverbs
- [x] 1.2 Structure each chapter entry with `chapter` (int) and `verses` (associative array int => string)

## 2. Validation

- [x] 2.1 Write a unit test verifying the file loads and returns an array with exactly 31 entries
- [x] 2.2 Write a unit test verifying each entry has `chapter` and `verses` keys
- [x] 2.3 Write a unit test verifying chapters are consecutive 1-31
- [x] 2.4 Write a unit test verifying Proverbs 1 has at least 7 verses
- [x] 2.5 Write a unit test verifying Proverbs 31 has at least 31 verses
- [x] 2.6 Verify all tests pass with `php artisan test`
