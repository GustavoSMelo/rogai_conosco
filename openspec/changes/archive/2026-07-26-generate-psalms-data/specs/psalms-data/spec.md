## ADDED Requirements

### Requirement: Psalms data file exists
The system SHALL provide a `psalms.php` file in the `resources/data/` directory containing all 150 Psalms in NTLH (Nova Tradução na Linguagem de Hoje) translation.

#### Scenario: File is loadable as PHP
- **WHEN** the application requires `resources/data/psalms.php`
- **THEN** the file SHALL return a PHP array with exactly 150 entries

### Requirement: Psalm entry structure
Each Psalm entry SHALL contain a `chapter` integer and a `verses` associative array keyed by verse number.

#### Scenario: Each Psalm has chapter and verses keys
- **WHEN** iterating each entry in the array
- **THEN** each entry SHALL have an integer `chapter` field and an array `verses` field

#### Scenario: Verses are keyed by integer
- **WHEN** accessing the `verses` array of any Psalm
- **THEN** each verse SHALL be keyed by its verse number (integer) with the NTLH text as the value

### Requirement: Psalm 1 coverage
The dataset SHALL include Psalm 1 with at minimum 6 verses.

#### Scenario: Psalm 1 has expected content
- **WHEN** loading Psalm 1 from the data
- **THEN** it SHALL have `chapter` = 1 and at least 6 verses with NTLH text

### Requirement: Psalm 150 coverage
The dataset SHALL include Psalm 150 with at minimum 6 verses.

#### Scenario: Psalm 150 has expected content
- **WHEN** loading Psalm 150 from the data
- **THEN** it SHALL have `chapter` = 150 and at least 6 verses with NTLH text

### Requirement: Consecutive chapter numbering
The dataset SHALL contain chapters numbered consecutively from 1 to 150.

#### Scenario: Chapters are sequential
- **WHEN** mapping the `chapter` field of each entry
- **THEN** the chapters SHALL be the integers 1 through 150 in order, with no gaps or duplicates
