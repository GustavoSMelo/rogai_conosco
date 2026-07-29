## ADDED Requirements

### Requirement: Deterministic fallback when match returns empty
The system SHALL select the same fallback prayer for the same description when the match returns empty (fewer than 3 signal words).

#### Scenario: Same short description yields same fallback prayer
- **WHEN** user submits type=instant with description "teste" (fewer than 3 signal words)
- **THEN** the same prayer SHALL be selected every time that description is submitted

#### Scenario: Different short descriptions may yield different fallback prayers
- **WHEN** user submits type=instant with description "abc" and again with "xyz"
- **THEN** the selected fallback prayer MAY differ between the two descriptions