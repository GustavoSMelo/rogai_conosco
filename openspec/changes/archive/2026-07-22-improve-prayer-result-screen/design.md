## Context

The prayer result page is a standalone Blade view served by `PrayerResultController` via a GET route `/prayer/result?type=ai|instant|person-*&religion=...`. It currently includes raw `<html>` boilerplate (no layout), loads Google Fonts directly, and relies on `welcome.css` classes (`.welcome-card`, `.welcome-modal-title`, `.welcome-modal-btn`, `.welcome-btn-outline`) that were designed for the landing page modal. There are no result-page-specific CSS utilities, no fade-up animations applied, and the copy is functional rather than reverent.

## Goals / Non-Goals

**Goals:**
- Extract result page into a Blade layout (e.g., `layouts/minimal.blade.php`) to eliminate raw `<html>` duplication
- Create a dedicated `resources/css/result.css` with result-page-specific styles and utility classes
- Redesign visual layout: pure white `#ffffff` card surface, brand-olive accents, terracotta CTA, reverent typography (Source Serif 4 for headings, Figtree for body)
- Add fade-up reveal animation on content load (respecting `prefers-reduced-motion`)
- Improve copy: warmer, more pastoral tone for each prayer type result
- Add Open Graph / meta tags for shareable result URLs
- Add a brief loading transition between form POST and result display
- Responsive: stacked layout on mobile, centered card on desktop

**Non-Goals:**
- Changing the controller logic, route structure, or query parameter format
- Rewriting `welcome.css` or other landing page styles
- Adding Livewire interactivity to the result page
- Implementing user accounts, history, or persistence on this page
- Changing the prayer submission flow or modal

## Decisions

- **Use `layouts/minimal.blade.php` instead of the full app layout**: The result page is minimalist (no nav, no sidebar, no footer). A dedicated minimal layout with `@yield('content')` and meta/OG slots avoids pulling in unused landing-page markup while keeping the page valid HTML.
- **New `result.css` file, not inline styles**: Keep CSS in a separate file loaded via `@vite`. This file contains only result-specific classes (`.result-card`, `.result-heading`, `.result-body`, `.result-btn`, `.result-back-link`) avoiding any dependency on `welcome.css`. This also means moving the old `welcome-modal-btn` / `welcome-card` usage out.
- **Pure white card surface (`bg-white`)**: The brand calls for "pure white surface, not tinted". The current card uses `bg-white/80`. On the result page, use full `bg-white` with subtle shadow for a clean, reverent look.
- **Fade-up via CSS animation, not JS**: Use the existing `@keyframes fade-up` in `app.css` (opacity 0→1, translateY 12px→0) applied via a `.reveal.visible` class. Add `animation-delay` staggered per child (0ms, 150ms, 300ms) for a gentle sequence.
- **Copy tone**: Shift from functional ("Sua oração por IA", "Oração instantânea", "Oração recebida") to reverent ("Sua oração foi ouvida", "Uma bênção para seu momento", "Sua intenção está em oração"). Avoid hype or overly emotional language.
- **Loading transition**: A brief (600ms) fade-in of the entire result card using the existing `page-in` keyframe. The page body starts `opacity: 0`, then fades in after the splash-style delay — or simply animate the card in on render.
- **No font duplication**: Remove the explicit Google Fonts `<link>` from the result blade. Fonts will be loaded via `@vite('resources/css/app.css')` which already imports them (or via the layout head).
- **OG tags**: Add `og:title`, `og:description`, `og:image` to the layout head. The description varies by prayer type — the controller can pass a `$metaDescription` variable.

## Risks / Trade-offs

- **[New layout file]** If other pages also need a minimal layout, this creates a third layout option. Acceptable — keeps separation clean.
- **[Separate CSS file]** An extra HTTP request (or Vite chunk). Mitigation: Vite bundles and hashes it; negligible overhead.
- **[Copy changes]** Existing users may expect the old text. Mitigation: the new copy is more reverent, not structurally different — low friction.
- **[Animation on slow devices]** The fade-up animation uses CSS only, with `prefers-reduced-motion` fallback. Safe.
