## ADDED Requirements

### Requirement: Left-Aligned Layout for All Elements
The system SHALL ensure all UI elements in DescribePage are left-aligned with consistent spacing from the left edge.

#### Scenario: Mood images are left-aligned
- **WHEN** user views the mood selection section
- **THEN** system displays the three mood images aligned to the left with equal spacing between them (not distributed across the full width)

#### Scenario: Instructional text is left-aligned
- **WHEN** user views the instructional text below mood images
- **THEN** system displays "( Toque em uma das carinhas para continuar )" aligned to the left edge

#### Scenario: Conditional section elements are left-aligned
- **WHEN** user has selected a mood and the conditional section is visible
- **THEN** system displays all elements (subtitle, label, textarea, button) aligned to the left edge with consistent horizontal positioning

#### Scenario: Consistent horizontal spacing from left edge
- **WHEN** user views any section of the DescribePage
- **THEN** system maintains consistent horizontal spacing from the left edge of the screen for all aligned elements