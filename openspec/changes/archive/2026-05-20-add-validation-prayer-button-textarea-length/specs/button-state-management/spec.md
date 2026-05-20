## ADDED Requirements

### Requirement: Button State Management Based on Validation
The system SHALL control the prayer button's appearance and behavior based on the validation state of the description textarea.

#### Scenario: Button reflects validation state
- **WHEN** the description textarea has fewer than 20 characters
- **THEN** the prayer button is disabled and styled with gray background color

#### Scenario: Button reflects validation state when sufficient
- **WHEN** the description textarea has 20 or more characters
- **THEN** the prayer button is enabled and styled with the primary app color background

#### Scenario: Button text includes arrow
- **WHEN** the prayer button is displayed
- **THEN** the button text is "Vamos orar pelo seu dia ->"