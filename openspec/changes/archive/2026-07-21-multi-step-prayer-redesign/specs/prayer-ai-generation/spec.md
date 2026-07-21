## ADDED Requirements

### Requirement: AI prayer generation (stub)
The system SHALL provide an action/service to generate a prayer text. Initially, this SHALL return a placeholder prayer.

#### Scenario: Generate prayer returns placeholder
- **WHEN** the AI prayer generation service is called with a prayer description and religion
- **THEN** it SHALL return a non-empty string with a placeholder prayer text

#### Scenario: Generate prayer is called with religion context
- **WHEN** the AI prayer generation service is invoked
- **THEN** the religion string SHALL be passed as context for future real integration
