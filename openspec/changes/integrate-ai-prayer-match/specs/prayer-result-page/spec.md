## MODIFIED Requirements

### Requirement: Prayer result page
The system SHALL redirect to a dedicated result page after prayer submission, with content varying by prayer type using the redesigned layout.

#### Scenario: AI prayer redirects to result with AI content
- **WHEN** user submits with prayer type "AI"
- **THEN** the result page SHALL display the AI-generated prayer text within the redesigned card layout

#### Scenario: Instant prayer redirects to result with pre-written prayer
- **WHEN** user submits with prayer type "Instant"
- **THEN** the result page SHALL initially show a loading state, then display an LLM-matched prayer from the instant library within the redesigned card layout

#### Scenario: Person prayer redirects to thank-you message
- **WHEN** user submits with prayer type "Prayer by person" (any variant)
- **THEN** the result page SHALL display a thank-you message stating the video will be ready in 2 days, within the redesigned card layout

#### Scenario: Result page shows AI-to-instant cross-link
- **WHEN** user views the AI prayer result
- **THEN** a button SHALL be available to request an instant prayer instead, styled with the result-specific button classes

#### Scenario: Result page shows instant-to-AI cross-link
- **WHEN** user views the instant prayer result
- **THEN** a button SHALL be available to request an AI prayer instead, styled with the result-specific button classes

#### Scenario: Person result shows AI and instant buttons
- **WHEN** user views the person prayer result
- **THEN** buttons for both AI prayer and instant prayer SHALL be shown, styled with the result-specific button classes

#### Scenario: All result pages show donation button
- **WHEN** user views any prayer result page
- **THEN** a "Apoie esta missão" donation button SHALL be visible, styled with the result-specific outline button class
