## ADDED Requirements

### Requirement: All raw CSS values replaced with @apply
Every CSS property in `welcome.css` that corresponds to a Tailwind utility class SHALL use `@apply` instead of a raw value.

#### Scenario: Colors use Tailwind tokens
- **WHEN** a class sets a color value
- **THEN** it SHALL use `@apply text-brand-ink`, `@apply text-brand-primary`, `@apply text-brand-muted`, `@apply text-white`, or another Tailwind text/color utility instead of raw `#1c1c14`, `#7d8a5a`, etc.

#### Scenario: Spacing uses Tailwind tokens
- **WHEN** a class sets padding, margin, or gap
- **THEN** it SHALL use `@apply p-8`, `@apply px-6`, `@apply gap-3`, or another Tailwind spacing utility instead of raw `2rem`, `1.5rem`, `0.75rem`, etc.

#### Scenario: Font sizes use Tailwind tokens
- **WHEN** a class sets font-size
- **THEN** it SHALL use `@apply text-lg`, `@apply text-sm`, `@apply text-xl`, `@apply text-2xl`, `@apply text-xs`, or another Tailwind font-size utility instead of raw `1.125rem`, `0.875rem`, `1.25rem`, etc.

#### Scenario: Border radius uses Tailwind tokens
- **WHEN** a class sets border-radius
- **THEN** it SHALL use `@apply rounded-sm`, `@apply rounded-full`, or another Tailwind radius utility instead of raw `0.125rem` or `9999px`

#### Scenario: Transitions use Tailwind tokens
- **WHEN** a class sets transition properties
- **THEN** it SHALL use `@apply transition-colors duration-150`, `@apply transition-all duration-150`, `@apply transition-opacity duration-150`, or another Tailwind transition utility instead of raw `transition: color 150ms` etc.

### Requirement: Hover and responsive states use @apply variants
Hover states and responsive breakpoints SHALL use Tailwind variant syntax within `@apply`.

#### Scenario: Hover states use @apply with hover: prefix
- **WHEN** a class defines a hover state
- **THEN** it SHALL use `@apply hover:text-brand-primary` or similar instead of separate `.class:hover` rules

#### Scenario: Responsive breakpoints use @apply with sm: prefix (or @media blocks)
- **WHEN** a class changes at the sm breakpoint
- **THEN** it SHALL use `@apply sm:flex-row sm:items-center sm:gap-3` or similar; if `@apply` with responsive variants is unsupported, use `@media (min-width: 640px)` with `@apply` inside

### Requirement: All inline Tailwind classes removed from Blade template
Every Tailwind utility class in `welcome.blade.php` SHALL be moved into a named CSS class in `welcome.css` using `@apply`.

#### Scenario: Sidebar nav button uses CSS class
- **WHEN** the sidebar "Pedido de oração" button renders
- **THEN** its `class` attribute SHALL contain only a CSS class name (no inline Tailwind utilities)

#### Scenario: Hero section uses CSS classes
- **WHEN** the hero button and "Saiba mais" link render
- **THEN** their `class` attributes SHALL contain only CSS class names

#### Scenario: Modal form fields use CSS classes
- **WHEN** input, select, and textarea elements render
- **THEN** their `class` attributes SHALL contain only CSS class names

#### Scenario: Footer link uses CSS class
- **WHEN** the footer "Apoie esta missão" link renders
- **THEN** its `class` attribute SHALL contain only a CSS class name
