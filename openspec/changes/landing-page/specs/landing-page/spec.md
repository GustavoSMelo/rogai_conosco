## ADDED Requirements

### Requirement: Introduction animation on page load
The landing page SHALL play a CSS-driven introduction animation when the page first loads. The animation SHALL reveal the "Rogai Conosco" brand name with a fade-in and scale-up effect. The animation SHALL run exactly once per pageload and SHALL respect the user's `prefers-reduced-motion` setting by skipping the animation.

#### Scenario: Animation plays on first visit
- **WHEN** a user navigates to the landing page
- **THEN** the brand name SHALL fade in and scale up over 1.5 seconds

#### Scenario: Animation respects reduced motion
- **WHEN** a user has `prefers-reduced-motion: reduce` set
- **THEN** the brand name SHALL appear immediately without animation

### Requirement: Brand identity display
The landing page SHALL display "Rogai Conosco" as the brand name prominently at the top center. Below the name SHALL appear a tagline that communicates the platform's mission (prayer requests). The visual style SHALL match the prototype at `storage/app/public/prototype.png`.

#### Scenario: Brand name and tagline visible
- **WHEN** the landing page loads
- **THEN** the user SHALL see "Rogai Conosco" and a supporting tagline

### Requirement: Three prayer delivery form cards
The landing page SHALL display three action cards representing the three prayer delivery forms: recorded prayer, instant prayer, and AI-generated prayer. Each card SHALL include an icon, a title, and a brief description. Cards SHALL be arranged in a responsive grid (stack on mobile, side-by-side on desktop).

#### Scenario: Cards visible
- **WHEN** a user views the landing page
- **THEN** three cards SHALL be visible representing each delivery form

#### Scenario: Cards stack on mobile
- **WHEN** a user views the landing page on a viewport ≤ 768px
- **THEN** the three cards SHALL stack vertically

### Requirement: Login and Register navigation
The landing page SHALL provide login and register links visible in the top-right corner for unauthenticated users. Links SHALL match the prototype's visual style.

#### Scenario: Auth links visible
- **WHEN** a user is not logged in
- **THEN** "Log in" and "Register" links SHALL be visible in the header

### Requirement: Responsive layout
The landing page SHALL be fully responsive, matching the prototype layout across mobile, tablet, and desktop viewports. All content SHALL remain readable without horizontal scrolling.

#### Scenario: Mobile layout
- **WHEN** the viewport is ≤ 640px
- **THEN** all content SHALL fit within the viewport without horizontal scroll

### Requirement: Footer with version info
The landing page SHALL include a footer displaying the application version.

#### Scenario: Footer visible
- **WHEN** a user scrolls to the bottom
- **THEN** the version SHALL be displayed in the footer
