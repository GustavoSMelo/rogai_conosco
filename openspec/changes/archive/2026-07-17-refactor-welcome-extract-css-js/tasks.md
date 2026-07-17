## 1. Create CSS extraction file

- [x] 1.1 Create `resources/css/welcome.css` with extracted classes for nav links, section headings, section padding, cards, and badge chips
- [x] 1.2 Add CSS transitions and hover states matching original Tailwind hover utilities
- [x] 1.3 Add responsive variants for mobile/desktop breakpoints

## 2. Create JS extraction file

- [x] 2.1 Create `resources/js/welcome.js` with DOMContentLoaded wrapper
- [x] 2.2 Extract splash screen lifecycle (splash-in, delay 800ms, splash-hide, page-show)
- [x] 2.3 Extract mobile navigation toggle (menu btn, close btn, overlay click, Escape key, nav link close)
- [x] 2.4 Extract delivery method toggle (show/hide contact fields)
- [x] 2.5 Extract modal behavior (backdrop click close, scroll lock on open/close)
- [x] 2.6 Extract IntersectionObserver reveal animations
- [x] 2.7 Extract form submission (disable button, show spinner)
- [x] 2.8 Extract character count updater
- [x] 2.9 Extract scroll spy for sidebar section highlighting

## 3. Update Blade template

- [x] 3.1 Remove inline `<script>` block from `welcome.blade.php`
- [x] 3.2 Add `@vite('resources/js/welcome.js')` directive
- [x] 3.3 Replace repeated inline Tailwind classes with CSS class names (`welcome-nav-link`, `welcome-section`, `welcome-heading`, `welcome-card`, `welcome-chips`, `welcome-btn-outline`)
- [x] 3.4 Verify `@vite('resources/css/app.css')` and `@vite('resources/js/welcome.js')` are present

## 4. Verify

- [x] 4.1 Run `php artisan test` to confirm no test failures
- [ ] 4.2 Visually confirm splash, nav, modal, form, reveal animations, and scroll spy work identically
