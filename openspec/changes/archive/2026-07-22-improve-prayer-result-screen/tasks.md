## 1. Layout

- [x] 1.1 Create `resources/views/layouts/minimal.blade.php` with DOCTYPE, charset, viewport, Vite assets, OG meta slots, and `@yield('content')`
- [x] 1.2 Add OG meta tags to layout: `og:title`, `og:description`, `og:image` with dynamic content from `$meta` array

## 2. Styles

- [x] 2.1 Create `resources/css/result.css` with result-specific classes (`.result-card`, `.result-heading`, `.result-body`, `.result-btn-primary`, `.result-btn-outline`, `.result-back-link`)
- [x] 2.2 Add `@keyframes fade-up` usage via `.reveal.visible` staggered delays (0ms, 150ms, 300ms) on result content children
- [x] 2.3 Add `@media (prefers-reduced-motion: reduce)` overrides in result.css to disable animations

## 3. View

- [x] 3.1 Rewrite `resources/views/prayer/result.blade.php` to extend `layouts.minimal`, remove raw `<html>` boilerplate and inline Google Fonts `<link>`
- [x] 3.2 Replace all `welcome-card`, `welcome-modal-title`, `welcome-modal-btn`, `welcome-btn-outline` classes with result-specific classes from result.css
- [x] 3.3 Update copy for AI result heading (reverent tone), instant result heading (blessing tone), and person result heading (received-with-faith tone)
- [x] 3.4 Apply `.reveal.visible` staggered fade-up animation to card, heading, body, and buttons
- [x] 3.5 Pass `$meta` array (title, description) from controller to layout for OG tags

## 4. Controller

- [x] 4.1 Update `PrayerResultController::__invoke` to pass `$meta` array with dynamic `og:title` and `og:description` based on `$type` and `$religion`

## 5. Tests

- [x] 5.1 Write `tests/Feature/PrayerResultPageTest.php` covering: all prayer types render with correct status, invalid type shows fallback, response uses minimal layout, OG meta tags present, result-specific CSS classes used, no welcome.css classes present, reduced-motion override works via CSS class presence

## 6. Verify

- [x] 6.1 Run `php artisan test --filter=PrayerResultPageTest` and confirm all tests pass
- [x] 6.2 Run `php artisan test` to confirm no regressions
- [x] 6.3 Manual check: mobile layout stacks correctly, desktop layout centers card, animations play, reduced-motion disables animations
