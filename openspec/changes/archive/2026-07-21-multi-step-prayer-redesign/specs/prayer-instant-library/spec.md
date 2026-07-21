## ADDED Requirements

### Requirement: Instant prayer library
The system SHALL maintain a static library of pre-written prayers organized by religion.

#### Scenario: Library returns prayers by religion
- **WHEN** the instant prayer library is queried for a religion (e.g., "catholic")
- **THEN** it SHALL return an array of prayer texts for that religion

#### Scenario: Unknown religion returns generic prayers
- **WHEN** the instant prayer library is queried for an unknown religion
- **THEN** it SHALL return an array of generic/Christian prayers as fallback

#### Scenario: Instant prayer has structure
- **WHEN** the instant prayer library returns a prayer
- **THEN** each prayer SHALL have a title and body text
