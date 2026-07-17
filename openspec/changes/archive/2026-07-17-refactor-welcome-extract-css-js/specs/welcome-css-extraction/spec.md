## ADDED Requirements

### Requirement: Repeated utility patterns extracted to CSS
The module SHALL define CSS classes that replace Tailwind utility combinations used 2+ times in the Blade template, using semantic class names prefixed with `welcome-`.

#### Scenario: Nav link class replaces repeated link styles
- **WHEN** a navigation link uses `.welcome-nav-link`
- **THEN** it SHALL have `font-family: 'Source Serif 4', Georgia, serif`, `font-size: 1.125rem` (`text-lg`), `color: #1c1c14` (`text-brand-ink`), `text-decoration: none`, and `transition` for color
- **THEN** on hover, color SHALL change to `#7d8a5a` (`text-brand-primary`)

#### Scenario: Section heading class replaces repeated heading styles
- **WHEN** a section `<h2>` uses the heading class
- **THEN** it SHALL have `text-wrap: balance`, `font-family`, font size `clamp(1.75rem, 3vw, 2.75rem)`, `line-height: 1.2`, and `color: #1c1c14`

#### Scenario: Section padding class replaces repeated padding
- **WHEN** a section uses the section padding class
- **THEN** it SHALL have `padding: 6rem 1.5rem` on mobile and `padding: 8rem 2rem` on `sm:` breakpoint

#### Scenario: Card class replaces repeated card styles
- **WHEN** an element uses the card class
- **THEN** it SHALL have `border-radius: 0.125rem`, `background: rgba(255,255,255,0.8)`, `padding: 2rem`, `box-shadow` with transition
- **THEN** on hover it SHALL translate up by `-0.125rem` and deepen shadow

### Requirement: One-off utilities remain inline
Tailwind utility combinations used only once in the template SHALL remain as inline classes in the Blade file.

#### Scenario: Unique button hover is not extracted
- **WHEN** a button has a hover effect used nowhere else on the page
- **THEN** the Tailwind classes remain inline on that element

### Requirement: Extracted CSS is imported via Vite
The `welcome.css` file SHALL be imported in the Blade template using `@vite('resources/css/welcome.css')`.

#### Scenario: CSS is loaded on the welcome page
- **WHEN** the welcome page renders
- **THEN** the extracted styles are applied to the page

### Requirement: No visual regression
After extraction, the rendered page SHALL appear identical to the original.

#### Scenario: Page layout is unchanged
- **WHEN** the page renders after refactoring
- **THEN** all elements maintain their original position, size, color, spacing, and animation behavior
