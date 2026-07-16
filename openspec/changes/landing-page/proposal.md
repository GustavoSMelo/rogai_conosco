## Why

The current landing page is the default Laravel welcome page — it has no branding for "Rogai Conosco," the prayer request platform. The project needs a custom branded landing page that immediately communicates the platform's mission and offers a polished introduction animation, styled after the prototype design at `storage/app/public/prototype.png`.

## What Changes

- Replace the default Laravel welcome view with a custom "Rogai Conosco" landing page
- Add an introduction animation (CSS/SVG based) on page load
- Style the landing page to match the prototype image (`storage/app/public/prototype.png`)
- Replace the default Laravel logo/svg with the "Rogai Conosco" branding
- Showcase the 3 prayer delivery forms (recorded prayer, instant prayer, AI-generated prayer) as action cards

## Capabilities

### New Capabilities
- `landing-page`: Branded landing page with introduction animation and CTAs for the 3 prayer delivery forms

### Modified Capabilities

## Impact

- `resources/views/welcome.blade.php` — full rewrite
- `resources/css/app.css` — landing page styles
- `resources/js/app.js` — introduction animation logic
- `public/storage/` symlink — ensure `prototype.png` is accessible (already symlinked via `php artisan storage:link`)
- `routes/web.php` — may need root route adjustment if landing page route changes
