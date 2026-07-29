## 1. Fix Tie-Breaking in PrayerMatcher

- [x] 1.1 Add secondary sort by prayer title (alphabetical) to `usort` comparator in `match()` when scores are equal

## 2. Add Tests

- [x] 2.1 Write Unit test asserting same description returns same top-1 prayer across 10 calls
- [x] 2.2 Write Unit test asserting tied scores are broken alphabetically by title

## 3. Verify

- [x] 3.1 Run `php artisan test` — all tests pass