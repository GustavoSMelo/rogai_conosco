## ADDED Requirements

### Requirement: Prayer Initiative Button
The system SHALL provide a button labeled "Vamos orar pelo seu dia ->" that appears when a mood is selected.

#### Scenario: Button appears after mood selection
- **WHEN** user taps on any of the mood images (happy, neutral, or saddiest)
- **THEN** system displays the prayer button below the description textarea

#### Scenario: Button hidden when no mood selected
- **WHEN** no mood has been selected (selectedHumor is empty)
- **THEN** system does not display the prayer button

### Requirement: Prayer Button Styling
The system SHALL style the prayer button to match the primary button style from main.dart.

#### Scenario: Button has correct background color
- **WHEN** the prayer button is displayed
- **THEN** system applies backgroundColor: Color.fromRGBO(188, 126, 75, 1) to the button

#### Scenario: Button has correct text styling
- **WHEN** the prayer button is displayed
- **THEN** system applies text style with:
  - fontSize: 18
  - fontWeight: FontWeight.bold
  - color: Color.fromRGBO(245, 237, 220, 1) (white/off-white)

### Requirement: Conditional Display Logic
The system SHALL only show the textarea and prayer button when a mood has been selected.

#### Scenario: Both elements hidden initially
- **WHEN** app loads and no mood is selected
- **THEN** neither textarea nor prayer button is visible

#### Scenario: Both elements appear after mood selection
- **WHEN** user selects a mood (sets selectedHumor to non-empty value)
- **THEN** both textarea and prayer button become visible

#### Scenario: Both elements hidden when mood cleared
- **WHEN** selectedHumor is reset to empty string
- **THEN** both textarea and prayer button become hidden