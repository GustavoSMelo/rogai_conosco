## 1. View Setup

- [x] 1.1 Replace `resources/views/welcome.blade.php` with the Rogai Conosco branding layout
- [x] 1.2 Add the CSS `@keyframes` intro animation (fade-in + scale-up) for the brand name
- [x] 1.3 Add `prefers-reduced-motion` media query to skip animation for accessibility

## 2. Styling

- [x] 2.1 Add custom Tailwind styles or arbitrary values matching the prototype color palette
- [x] 2.2 Style the three prayer delivery form cards with icons, titles, and descriptions
- [x] 2.3 Ensure responsive grid layout (stack on mobile, side-by-side on desktop)

## 3. Header & Footer

- [x] 3.1 Integrate the `livewire:welcome.navigation` component for login/register links
- [x] 3.2 Add footer with application version info

## 4. Verification

- [x] 4.1 Run `php artisan test` to ensure no regressions
- [x] 4.2 Manually verify landing page renders correctly at `/`
- [x] 4.3 Verify animation plays on load and respects `prefers-reduced-motion`
