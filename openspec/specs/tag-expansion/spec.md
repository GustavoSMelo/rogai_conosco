# Tag Expansion

## Purpose

Increase the minimum tag count per prayer to improve content-based discovery and matching coverage.

## Requirements

### Requirement: Minimum 10 tags per prayer

Every prayer entry SHALL have at least 10 tags in its `tags` array.

#### Scenario: Catholic prayers meet minimum

- **WHEN** checking any catholic prayer entry
- **THEN** its `tags` array MUST contain at least 10 entries

#### Scenario: All traditions meet minimum

- **WHEN** checking any prayer entry across all traditions (catholic, protestant, orthodox, other)
- **THEN** its `tags` array MUST contain at least 10 string entries
