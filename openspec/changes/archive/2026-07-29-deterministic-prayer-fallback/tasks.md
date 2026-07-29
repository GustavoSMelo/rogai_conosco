## 1. Fix Fallback Determinism

- [x] 1.1 Replace `array_rand($list)` with `$list[crc32($this->description) % count($list)]` in Volt component

## 2. Add Test

- [x] 2.1 Write Unit test asserting same description returns same fallback prayer
- [x] 2.2 Write Unit test asserting different descriptions may return different prayers

## 3. Verify

- [x] 3.1 Run `php artisan test` — all tests pass