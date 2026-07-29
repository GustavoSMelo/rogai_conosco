## 1. Update Tests

- [x] 1.1 Update `test_tags_are_non_empty_strings` minimum from `>= 3` to `>= 10`
- [x] 1.2 Update `test_known_prayer_has_expected_tags` — Pai Nosso expects ~12 informal tags, no religious-specific terms
- [x] 1.3 Add test `test_tags_have_no_religious_terms` — verify no saint names, prayer titles, or latin terms in any tag

## 2. Rewrite Catholic Tags

- [x] 2.1 Rewrite all catholic prayer tags to ~12 informal tags each, no religious-specific terms
- [x] 2.2 Run `php artisan test --filter=PrayersDataTest` — verify catholic section passes

## 3. Rewrite Protestant Tags

- [x] 3.1 Rewrite all protestant prayer tags to ~12 informal tags each, no religious-specific terms
- [x] 3.2 Run `php artisan test --filter=PrayersDataTest` — verify protestant section passes

## 4. Rewrite Orthodox Tags

- [x] 4.1 Rewrite all orthodox prayer tags to ~12 informal tags each, no religious-specific terms
- [x] 4.2 Run `php artisan test --filter=PrayersDataTest` — verify orthodox section passes

## 5. Rewrite Other Tags

- [x] 5.1 Rewrite all other prayer tags to ~12 informal tags each, no religious-specific terms
- [x] 5.2 Run `php artisan test` — all tests pass
