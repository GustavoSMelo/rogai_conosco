## ADDED Requirements

### Requirement: Proverbs data file exists
The system SHALL provide a `proverbs.php` file in the `resources/data/` directory containing all 31 chapters of Proverbs in NTLH (Nova Tradução na Linguagem de Hoje) translation.

#### Scenario: File is loadable as PHP
- **WHEN** the application requires `resources/data/proverbs.php`
- **THEN** the file SHALL return a PHP array with exactly 31 entries

### Requirement: Chapter entry structure
Each chapter entry SHALL contain a `chapter` integer and a `verses` associative array keyed by verse number.

#### Scenario: Each chapter has chapter and verses keys
- **WHEN** iterating each entry in the array
- **THEN** each entry SHALL have an integer `chapter` field and an array `verses` field

#### Scenario: Verses are keyed by integer
- **WHEN** accessing the `verses` array of any chapter
- **THEN** each verse SHALL be keyed by its verse number (integer) with the NTLH text as the value

### Requirement: Chapter 1 coverage
The dataset SHALL include Proverbs 1 with at minimum 7 verses.

#### Scenario: Proverbs 1 has expected content
- **WHEN** loading Proverbs 1 from the data
- **THEN** it SHALL have `chapter` = 1 and at least 7 verses with NTLH text

### Requirement: Chapter 31 coverage
The dataset SHALL include Proverbs 31 with at minimum 31 verses.

#### Scenario: Proverbs 31 has expected content
- **WHEN** loading Proverbs 31 from the data
- **THEN** it SHALL have `chapter` = 31 and at least 31 verses with NTLH text

### Requirement: Consecutive chapter numbering
The dataset SHALL contain chapters numbered consecutively from 1 to 31.

#### Scenario: Chapters are sequential
- **WHEN** mapping the `chapter` field of each entry
- **THEN** the chapters SHALL be the integers 1 through 31 in order, with no gaps or duplicates
