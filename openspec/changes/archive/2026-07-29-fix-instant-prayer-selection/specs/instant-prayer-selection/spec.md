## ADDED Requirements

### Requirement: Prayer description passed to result page
The system SHALL pass the user's prayer description from the welcome form to the prayer result page when redirecting after submission.

#### Scenario: Description included in redirect
- **WHEN** user submits a prayer request with type "instant" and a description
- **THEN** the redirect URL SHALL include the description as a `description` query parameter

#### Scenario: AI prayer also passes description
- **WHEN** user submits a prayer request with type "AI" and a description
- **THEN** the redirect URL SHALL include the description as a `description` query parameter

### Requirement: Instant prayer selection uses user description
When the description has 3 or more signal words, the instant prayer SHALL be selected by matching against the user's description using the PrayerMatcher.

#### Scenario: Long description triggers matcher
- **WHEN** user submits with type "instant" and a description containing 3+ meaningful words
- **THEN** the PrayerMatcher SHALL score prayers against the description tokens and return the best match

#### Scenario: Empty description shows random prayer
- **WHEN** user submits with type "instant" and an empty description
- **THEN** the result page SHALL display a random prayer from the user's selected tradition

#### Scenario: Short description stays deterministic
- **WHEN** user submits with type "instant" and a description with 1-2 meaningful words
- **THEN** the same short description SHALL always select the same fallback prayer
