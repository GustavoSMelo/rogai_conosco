## 1. Write Tests

- [x] 1.1 Add `tags` key assertion to `test_each_prayer_has_required_fields` in `tests/Unit/PrayersDataTest.php`
- [x] 1.2 Add test `test_tags_are_non_empty_strings` — every prayer's tags array has >= 3 entries, each entry is a non-empty string
- [x] 1.3 Add test `test_tags_use_snake_case` — every tag matches `/^[a-z0-9_]+$/`
- [x] 1.4 Add test `test_known_prayer_has_expected_tags` — e.g., "Pai Nosso" includes `pai_nosso`, `perdao`, `tentacao`

## 2. Add Tags to Prays Data

- [x] 2.1 Add `tags` array to every catholic prayer entry in `resources/data/Prays.php`
- [x] 2.2 Add `tags` array to every protestant prayer entry in `resources/data/Prays.php`
- [x] 2.3 Add `tags` array to every orthodox prayer entry in `resources/data/Prays.php`
- [x] 2.4 Add `tags` array to every other prayer entry in `resources/data/Prays.php`

## 3. Verify

- [x] 3.1 Run `php artisan test --filter=PrayersDataTest` — all tests pass
