## ADDED Requirements

### Requirement: Match results are deterministic
The system SHALL produce identical match results for identical input text across multiple invocations. When multiple prayers share the same score, ties SHALL be broken by a stable secondary sort on prayer title in alphabetical order.

#### Scenario: Tied scores yield consistent top result
- **WHEN** user submits text that produces multiple prayers with the same score
- **THEN** the top-1 prayer SHALL always be the same across repeated calls with the same input

#### Scenario: Alphabetical tie-breaking
- **WHEN** two prayers have identical scores
- **THEN** the prayer whose title comes first alphabetically SHALL rank higher
