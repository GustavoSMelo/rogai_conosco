## ADDED Requirements

### Requirement: Prayer result page
The system SHALL redirect to a dedicated result page after prayer submission, with content varying by prayer type.

#### Scenario: AI prayer redirects to result with AI content
- **WHEN** user submits with prayer type "AI"
- **THEN** the result page SHALL display the AI-generated prayer text

#### Scenario: Instant prayer redirects to result with pre-written prayer
- **WHEN** user submits with prayer type "Instant"
- **THEN** the result page SHALL display a pre-written prayer from the instant library

#### Scenario: Person prayer redirects to thank-you message
- **WHEN** user submits with prayer type "Prayer by person" (any variant)
- **THEN** the result page SHALL display a thank-you message stating the video will be ready in 2 days

#### Scenario: Result page shows AI-to-instant cross-link
- **WHEN** user views the AI prayer result
- **THEN** a button SHALL be available to request an instant prayer instead

#### Scenario: Result page shows instant-to-AI cross-link
- **WHEN** user views the instant prayer result
- **THEN** a button SHALL be available to request an AI prayer instead

#### Scenario: Person result shows AI and instant buttons
- **WHEN** user views the person prayer result
- **THEN** buttons for both AI prayer and instant prayer SHALL be shown

#### Scenario: All result pages show donation button
- **WHEN** user views any prayer result page
- **THEN** a "Apoie esta missão" donation button SHALL be visible

### Requirement: Prayer result route
The system SHALL provide a GET route at `/prayer/result` to display the result page.

#### Scenario: Route accepts prayer type query param
- **WHEN** user navigates to `/prayer/result?type=ai&religion=catholic`
- **THEN** the page SHALL render the AI prayer result for Catholic tradition

#### Scenario: Invalid type shows fallback
- **WHEN** user navigates to `/prayer/result?type=invalid`
- **THEN** the page SHALL render a generic thank-you message
