## MODIFIED Requirements

### Requirement: Tags use natural language

Each tag SHALL be either a single keyword or a short conversational phrase in Portuguese.

#### Scenario: Single keyword tag

- **WHEN** a tag is a single word
- **THEN** it MUST be a non-empty Portuguese word representing an emotional state, situation, or theme (e.g., `"perdao"`, `"luto"`, `"gratidao"`, `"ansiedade"`)

#### Scenario: Phrase tag

- **WHEN** a tag is a multi-word phrase
- **THEN** it MUST be a short conversational phrase (2-5 words) that a person might naturally say (e.g., `"beijei hoje"`, `"recebi um elogio"`, `"conversando com Deus"`)

#### Scenario: Mix of formats

- **WHEN** examining any prayer's tags array
- **THEN** it MAY contain a mix of single keywords and multi-word phrases — both formats are valid within the same entry

### Requirement: Tags reflect body content

Tags SHALL be derived from key themes, nouns, and concepts present in the prayer's `body` text.

#### Scenario: Tags match body themes

- **WHEN** examining a prayer's body text
- **THEN** each tag SHOULD correspond to a recognizable concept or theme present in the body

#### Scenario: Known prayer has expected tags

- **WHEN** checking the "Pai Nosso" catholic prayer
- **THEN** its `tags` MUST include at least 3 tags matching its themes (e.g., "perdao", "vontade de Deus", "livramento do mal")

## REMOVED Requirements

### Requirement: Tags use snake_case convention

**Reason**: Tags are now a mix of single keywords and natural language phrases. Snake_case is incompatible with conversational phrasing.

**Migration**: Replace all snake_case tag strings with a mix of single keywords and natural Portuguese phrases. Update `tags` array in `resources/data/Prays.php`.
