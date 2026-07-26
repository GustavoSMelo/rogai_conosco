## ADDED Requirements

### Requirement: Prayer category taxonomy uses snake_case keywords

The system SHALL use a unified snake_case Portuguese keyword taxonomy for `category` and `subcategory` fields across all prayer entries.

#### Scenario: Category values are snake_case
- **WHEN** inspecting any `category` field across all tradition sections
- **THEN** it SHALL match one of: `geral`, `intercessao`, `protecao`, `santificacao`, `esperanca`, `arrependimento`, `estudos`, `amor`, `fe`, `saude`, `cura`, `forca`

#### Scenario: Subcategory values are snake_case
- **WHEN** inspecting any `subcategory` array entry across all tradition sections
- **THEN** it SHALL be a non-empty snake_case Portuguese string

### Requirement: New prayers from new-prays.php merged

The system SHALL include all prayers from `resources/data/new-prays.php` in `resources/data/prays.php`, placed under their appropriate tradition key.

#### Scenario: File has all entries after merge
- **WHEN** comparing the set of prayer titles in `prays.php` against those in `new-prays.php`
- **THEN** every title from `new-prays.php` SHALL appear in at least one tradition section of `prays.php`

#### Scenario: new-prays.php deleted after merge
- **WHEN** checking for file existence after the merge
- **THEN** `resources/data/new-prays.php` SHALL NOT exist
