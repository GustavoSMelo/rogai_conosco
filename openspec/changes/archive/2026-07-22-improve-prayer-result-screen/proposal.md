## Why

The prayer result screen (`/prayer/result`) is the first thing users see after submitting a prayer request — a moment of heightened emotion and spiritual openness. The current page reuses generic `welcome.css` classes (designed for the landing page modal), lacks brand-specific visual design, duplicates raw `<head>` markup instead of using a layout, and communicates functionally rather than reverently. The experience should feel peaceful, trustworthy, and humble — matching the brand's "quiet confidence" personality.

## What Changes

- Replace raw `<html>` boilerplate with a proper Blade layout (`layouts/app.blade.php` or similar)
- Create result-page-specific CSS (removing dependency on `welcome.css` classes like `.welcome-card`, `.welcome-modal-title`, `.welcome-modal-btn`, `.welcome-btn-outline`)
- Redesign the visual presentation: card layout, typography scale, spacing, and motion to match the brand system (pure white bg, olive primary, terracotta accent)
- Add gentle fade-up reveal animation for result content
- Improve copy tone for each prayer type (AI, instant, person) — warmer, more reverent
- Ensure the page respects `prefers-reduced-motion`
- Add proper meta tags and Open Graph tags for shareability
- Add a brief loading/transition state between submission and result render
- Ensure full responsiveness on mobile

## Capabilities

### New Capabilities
- `prayer-result-redesign`: Visual and UX overhaul of the post-submission prayer result page

### Modified Capabilities
- `prayer-result-page`: Update existing result page spec to reflect new design requirements, copy, and motion behavior

## Impact

- `resources/views/prayer/result.blade.php` — complete rewrite of the view
- `resources/views/layouts/` — create a minimal layout (or extend existing) for the result page
- `resources/css/result.css` — new CSS file for result-page-specific styles (or extend `app.css`)
- `app/Http/Controllers/PrayerResultController.php` — minor adjustments if layout/asset references change
- `resources/views/welcome.blade.php` — no changes (welcome.css stays as-is for the landing page)
