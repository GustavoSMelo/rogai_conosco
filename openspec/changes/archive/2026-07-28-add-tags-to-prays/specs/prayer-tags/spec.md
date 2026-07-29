## ADDED Requirements

### Requirement: Prayer entries contain tags array

Every prayer entry in the Prays data structure SHALL include a `tags` key containing an array of keyword strings extracted from the prayer's `body`.

#### Scenario: Tags array exists on every prayer
- **WHEN** iterating over all prayers in both `catholic` and `protestant` groups
- **THEN** each prayer entry MUST have a `tags` key that is an array

#### Scenario: Tags array is non-empty
- **WHEN** checking any prayer entry
- **THEN** its `tags` array MUST contain at least 3 string entries

#### Scenario: Tags are strings
- **WHEN** checking each tag in the `tags` array
- **THEN** every tag MUST be a non-empty string

### Requirement: Tags reflect body content

Tags SHALL be derived from key themes, nouns, and concepts present in the prayer's `body` text.

#### Scenario: Tags match body themes
- **WHEN** examining a prayer's body text
- **THEN** each tag SHOULD correspond to a recognizable concept or theme present in the body

#### Scenario: Known prayer has expected tags
- **WHEN** checking the "Pai Nosso" catholic prayer
- **THEN** its `tags` MUST include at least 3 of: `"pai_nosso"`, `"perdao"`, `"vontade_de_deus"`, `"tentacao"`, `"livramento"`, `"adoracao"`

### Requirement: Tags use snake_case convention

All tag strings SHALL use lowercase snake_case (e.g., `"virgem_maria"`, `"espirito_santo"`, `"batalha_espiritual"`).

#### Scenario: Tag naming convention
- **WHEN** checking any tag string
- **THEN** it MUST match the pattern: lowercase letters, digits, underscores only — no spaces, hyphens, or uppercase
