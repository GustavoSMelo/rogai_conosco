## ADDED Requirements

### Requirement: Mood Description Textarea
The system SHALL provide a textarea for users to describe their day after selecting a mood.

#### Scenario: Textarea appears after mood selection
- **WHEN** user taps on any of the mood images (happy, neutral, or saddiest)
- **THEN** system displays a textarea below the mood selection row

#### Scenario: Textarea hidden when no mood selected
- **WHEN** no mood has been selected (selectedHumor is empty)
- **THEN** system does not display the textarea

### Requirement: Textarea Content State
The system SHALL maintain state for the text entered in the description textarea.

#### Scenario: Textarea content updates as user types
- **WHEN** user types in the textarea
- **THEN** system updates the descriptionText state variable with the current content

#### Scenario: Textarea content persists through rebuilds
- **WHEN** textarea content is set and widget rebuilds occur
- **THEN** system preserves the entered text in the textarea