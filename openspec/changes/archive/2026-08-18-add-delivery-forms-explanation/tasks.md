## 1. Tests (TDD — red first)

- [x] 1.1 Write feature test asserting the welcome page renders a recorded-delivery options section positioned after the "Como sua oração chega até você" section
- [x] 1.2 Write feature test asserting the section presents the three option names: "Apenas oração", "Apenas palavra", "Oração + palavra"
- [x] 1.3 Write feature test asserting the "Apenas oração" option explains that a real person prays for the requester
- [x] 1.4 Write feature test asserting the "Apenas palavra" option explains that a Bible verse is searched for the requester's situation
- [x] 1.5 Write feature test asserting the "Oração + palavra" option explains both are combined in a single audio or video
- [x] 1.6 Run `php artisan test --filter=WelcomeDeliveryOptions` and confirm tests fail (red)

## 2. Implementation

- [x] 2.1 Add the recorded delivery options `<section>` to `resources/views/welcome.blade.php` after the `#delivery` section, reusing `welcome-section`, `welcome-cards-grid`, `welcome-card`, `welcome-chip`, and `reveal` classes with option titles matching the modal select labels
- [x] 2.2 Add any missing `welcome-*` classes to `resources/css/welcome.css` using Tailwind `@apply` only if existing classes are insufficient
- [x] 2.3 Run `php artisan test --filter=WelcomeDeliveryOptions` and confirm tests pass (green)

## 3. Quality gate

- [x] 3.1 Run `php artisan test` (full suite) and confirm all tests pass
- [x] 3.2 Run `vendor/bin/pint` and confirm code style is clean
- [x] 3.3 Run `vendor/bin/phpstan analyse` and confirm zero errors
- [x] 3.4 Run `php artisan test --coverage` and confirm ≥ 70% coverage on changed files
- [x] 3.5 Visually verify the section on desktop and mobile (responsive layout, motion respects `prefers-reduced-motion`)