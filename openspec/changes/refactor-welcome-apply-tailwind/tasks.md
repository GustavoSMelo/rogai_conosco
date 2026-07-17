## 1. Rewrite welcome.css with @apply

- [x] 1.1 Replace nav link classes (`.welcome-sidebar-link`, `.welcome-mobile-nav-link`, `.welcome-brand-link`) with `@apply` directives
- [x] 1.2 Replace section classes (`.welcome-section`, `.welcome-section-heading`, `.welcome-section-text`) with `@apply` directives
- [x] 1.3 Replace feature item (`.welcome-feature-item`) with `@apply`
- [x] 1.4 Replace card (`.welcome-card`), chip (`.welcome-chip`), and outline button (`.welcome-btn-outline`) with `@apply`
- [x] 1.5 Replace step classes (`.welcome-step`, `.welcome-step-body`, `.welcome-step-number`, `.welcome-step-number-sm`, `.welcome-step-divider`, `.welcome-step-connector`) with `@apply`
- [x] 1.6 Replace modal action classes (`.welcome-modal-btn`, `.welcome-modal-cancel`) with `@apply`
- [x] 1.7 Remove all raw hex/rgba color, spacing, and font-size values from `welcome.css`

## 2. Move inline Tailwind classes from Blade to welcome.css

- [x] 2.1 Extract sidebar button class (`.mt-4.self-start.rounded.border.border-brand-accent...`) into `welcome.css`
- [x] 2.2 Extract mobile header and menu button classes into `welcome.css`
- [x] 2.3 Extract hero section classes (CTA button, Saiba mais link) into `welcome.css`
- [x] 2.4 Extract mobile nav close button and nav link button classes into `welcome.css`
- [x] 2.5 Extract footer link class (`.text-sm.text-brand-primary.no-underline...`) into `welcome.css`
- [x] 2.6 Extract modal form field classes (input, textarea, select) into `welcome.css`
- [x] 2.7 Extract modal close button, success message, and info box classes into `welcome.css`

## 3. Build and verify

- [x] 3.1 Run `npm run build` to rebuild Vite manifest
- [x] 3.2 Run `php artisan test` to confirm no test failures
