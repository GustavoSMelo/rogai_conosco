## ADDED Requirements

### Requirement: Data layer provides other prayer collection

The `App\Data\Prays::getPrays()` method SHALL include an `"other"` key in its returned array containing denomination-neutral prayers.

#### Scenario: Other key exists in Prays data

- **WHEN** `Prays::getPrays()` is called
- **THEN** the returned array SHALL contain an `"other"` key

#### Scenario: Other array has at least 15 entries

- **WHEN** the `"other"` array is inspected
- **THEN** it SHALL contain at least 15 prayer entries

#### Scenario: Each other prayer has required fields

- **WHEN** inspecting each entry in the `"other"` array
- **THEN** each entry SHALL have non-empty `title`, `category`, `subcategory` (array), and `body` fields

### Requirement: Prayer result page handles other religion

The prayer result page SHALL return a valid prayer when `religion=other` is passed for instant prayer type.

#### Scenario: Instant prayer with religion=other shows a prayer

- **WHEN** user visits `/prayer/result?type=instant&religion=other`
- **THEN** the page SHALL display a prayer title and body (not empty)
