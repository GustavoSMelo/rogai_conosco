## Context

The landing page is served at `/` via `routes/web.php` → `resources/views/welcome.blade.php`, which currently renders the default Laravel welcome page with generic branding. The page needs to be replaced with a custom "Rogai Conosco" landing page styled after the prototype at `storage/app/public/prototype.png`.

Stack: Tailwind CSS 4 (already configured), Vite, Blade templates, no JS framework on the landing page.

## Goals / Non-Goals

**Goals:**
- Replace the welcome view with a branded "Rogai Conosco" landing page
- Add a CSS/SVG-based introduction animation on page load
- Match the layout, color scheme, typography, and visual style of `prototype.png`
- Showcase the 3 prayer delivery forms as CTA cards (recorded, instant, AI-generated)
- Provide login/register access links for authenticated flows

**Non-Goals:**
- Building the actual prayer request forms (separate scope)
- User authentication UI (already handled by Livewire components)
- Backend changes to routes or controllers

## Decisions

1. **Pure Blade view, not Livewire** — The landing page is static marketing content. No reactive state needed. Simple Blade + Tailwind + vanilla JS is sufficient and avoids unnecessary overhead.

2. **CSS-only intro animation** — Use `@keyframes` and opacity/transform transitions in Tailwind. No JavaScript animation library needed. The animation runs on page load (logo reveal + fade-in content) and is hidden after first play via `animation-fill-mode: forwards`.

3. **Prototype image as background reference** — `prototype.png` lives in `storage/app/public/` and is served via the `storage` symlink. The view references it at `{{ asset('storage/prototype.png') }}` or uses it as a design reference for colors/layout rather than as a background image in production.

4. **Tailwind arbitrary values for prototype colors** — Extract the exact color palette from the prototype and define them as Tailwind theme extensions if reused, or as inline arbitrary values (`bg-[#123456]`) if one-off.

5. **Keep auth navigation via `livewire:welcome.navigation`** — Reuse the existing `livewire:welcome.navigation` component for login/register links to maintain consistency with the auth scaffolding.

## Risks / Trade-offs

- [Prototype image not accessible] → Ensure `php artisan storage:link` has been run; add check in deployment
- [Animation feels slow on low-end devices] → Use `prefers-reduced-motion` media query to disable animation for accessibility
