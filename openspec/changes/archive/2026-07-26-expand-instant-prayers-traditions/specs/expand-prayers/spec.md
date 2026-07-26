## ADDED Requirements

### Requirement: Instant prayers organized by tradition
The system SHALL organize instant prayers under three top-level keys: `catholic`, `protestant`, and `orthodox`.

#### Scenario: File returns associative array with 3 tradition keys
- **WHEN** requiring `resources/data/prays.php`
- **THEN** the returned array SHALL have exactly 3 keys: `catholic`, `protestant`, and `orthodox`

#### Scenario: Each tradition key contains an array
- **WHEN** accessing any of the 3 tradition keys
- **THEN** the value SHALL be an array of prayer entries

### Requirement: Catholic section preserved
The `catholic` section SHALL contain the existing Catholic prayers.

#### Scenario: Catholic section has at least 25 prayers
- **WHEN** counting entries in the `catholic` section
- **THEN** it SHALL contain at least 25 prayers

### Requirement: Protestant section has minimum content
The `protestant` section SHALL contain at least 25 prayers with biblical and devotional content.

#### Scenario: Protestant section has at least 25 prayers
- **WHEN** counting entries in the `protestant` section
- **THEN** it SHALL contain at least 25 prayers

### Requirement: Orthodox section has minimum content
The `orthodox` section SHALL contain at least 25 prayers drawn from Orthodox tradition.

#### Scenario: Orthodox section has at least 25 prayers
- **WHEN** counting entries in the `orthodox` section
- **THEN** it SHALL contain at least 25 prayers

### Requirement: Each prayer has required fields
Every prayer entry across all sections SHALL have `title`, `category`, `subcategory`, and `body` fields.

#### Scenario: Each prayer has all required fields
- **WHEN** iterating all entries across all 3 sections
- **THEN** each entry SHALL have non-empty `title`, `category`, and `body` fields, and an array `subcategory` field
