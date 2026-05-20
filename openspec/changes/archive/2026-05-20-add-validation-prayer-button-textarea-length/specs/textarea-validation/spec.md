## ADDED Requirements

### Requirement: Textarea Character Validation
The system SHALL validate that the description textarea contains at least 20 characters before allowing the prayer button to be active.

#### Scenario: Button disabled with insufficient characters
- **WHEN** user has typed fewer than 20 characters in the textarea
- **THEN** system disables the prayer button and styles it with gray color

#### Scenario: Button enabled with sufficient characters
- **WHEN** user has typed 20 or more characters in the textarea
- **THEN** system enables the prayer button and styles it with the primary app color

#### Scenario: Character count updates in real-time
- **WHEN** user types or deletes characters in the textarea
- **THEN** system immediately updates the button state based on current character count