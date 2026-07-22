# Prayer Result Redesign

**Purpose:** Redesign the prayer result page with updated visual presentation, reverent copy, fade-up animations, OG meta tags, and responsive layout.

## Requirements

### Requirement: Prayer result visual redesign
The system SHALL present the prayer result page with an updated visual design that is peaceful, reverent, and aligned with the brand system.

#### Scenario: Result page uses dedicated minimal layout
- **WHEN** user navigates to `/prayer/result`
- **THEN** the page SHALL extend a minimal Blade layout (`layouts/minimal.blade.php`) instead of raw HTML boilerplate

#### Scenario: Result page does not use welcome.css classes
- **WHEN** user views the result page
- **THEN** the page SHALL use result-specific CSS classes, not `.welcome-card`, `.welcome-modal-title`, `.welcome-modal-btn`, or `.welcome-btn-outline`

#### Scenario: Result card has pure white background
- **WHEN** user views the result card
- **THEN** the card SHALL use `bg-white` (pure white) surface with subtle shadow

#### Scenario: Result content fades up on load
- **WHEN** the result page renders
- **THEN** the content SHALL animate with a fade-up reveal (opacity 0→1, translateY 12px→0) using CSS keyframes

#### Scenario: Animation respects reduced motion
- **WHEN** user has `prefers-reduced-motion: reduce`
- **THEN** all animations SHALL be disabled and content SHALL be fully visible immediately

### Requirement: OG and meta tags
The result page SHALL include proper meta tags for sharing.

#### Scenario: Result page has Open Graph tags
- **WHEN** the result page is rendered
- **THEN** the page SHALL include `og:title`, `og:description`, and `og:image` meta tags

#### Scenario: OG description varies by prayer type
- **WHEN** viewing an AI prayer result
- **THEN** `og:description` SHALL describe the AI prayer experience
- **WHEN** viewing an instant prayer result
- **THEN** `og:description` SHALL describe the instant prayer experience
- **WHEN** viewing a person prayer result
- **THEN** `og:description` SHALL describe the recorded prayer experience

### Requirement: Responsive result layout
The result page SHALL be fully responsive across device sizes.

#### Scenario: Mobile layout stacks vertically
- **WHEN** viewed on a viewport narrower than 640px
- **THEN** the card SHALL span full width with adequate padding

#### Scenario: Desktop layout centers the card
- **WHEN** viewed on a viewport 640px or wider
- **THEN** the card SHALL be centered with constrained max-width

### Requirement: Copy tone is reverent
The result page copy SHALL use warm, pastoral, reverent language.

#### Scenario: AI prayer result shows reverent heading
- **WHEN** viewing an AI prayer result
- **THEN** the heading SHALL convey reverence (e.g., "Sua oração foi ouvida") rather than a functional label

#### Scenario: Instant prayer result shows reverent heading
- **WHEN** viewing an instant prayer result
- **THEN** the heading SHALL convey blessing (e.g., "Uma bênção para seu momento")

#### Scenario: Person prayer result shows reverent heading
- **WHEN** viewing a person prayer result
- **THEN** the heading SHALL convey that the intention was received with faith

### Requirement: Google Fonts loaded via Vite pipeline
The result page SHALL NOT include raw Google Fonts `<link>` tags; fonts SHALL be loaded through the Vite asset pipeline.

#### Scenario: No direct font link in result page
- **WHEN** inspecting the rendered result page HTML
- **THEN** there SHALL be no `<link href="https://fonts.googleapis.com...">` tag in the `<head>`
