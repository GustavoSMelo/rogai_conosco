# Prayer Tags

## Purpose

Ensure every prayer entry carries a `tags` array derived from its body content, enabling content-based filtering and discovery. Tags use natural language — a mix of single keywords and short conversational phrases — to match how users describe their daily experiences.

## Requirements

### Requirement: Prayer entries contain tags array

Every prayer entry in the Prays data structure SHALL include a `tags` key containing an array of keyword strings extracted from the prayer's `body`.

#### Scenario: Tags array exists on every prayer

- **WHEN** iterating over all prayers in both `catholic` and `protestant` groups
- **THEN** each prayer entry MUST have a `tags` key that is an array

#### Scenario: Tags array is non-empty

- **WHEN** checking any prayer entry
- **THEN** its `tags` array MUST contain at least 10 string entries

#### Scenario: Tags are strings

- **WHEN** checking each tag in the `tags` array
- **THEN** every tag MUST be a non-empty string

### Requirement: Tags use natural language

Each tag SHALL be a purely informal/conversational Portuguese word or phrase. No religious-specific terms (saint names, prayer titles, latin titles).

#### Scenario: Single keyword tag

- **WHEN** a tag is a single word
- **THEN** it MUST be a non-empty Portuguese word representing an everyday emotional state, situation, or theme (e.g., `"perdao"`, `"gratidao"`, `"ansiedade"`, `"solidao"`)

#### Scenario: Phrase tag

- **WHEN** a tag is a multi-word phrase
- **THEN** it MUST sound like something a person would say in casual conversation (e.g., `"preciso de ajuda"`, `"me sentindo sozinho"`, `"estou agradecido"`, `"pedindo forca"`)

#### Scenario: No religious-specific terms

- **WHEN** examining any tag in any prayer
- **THEN** it MUST NOT contain saint names, prayer titles, latin terms, or specific religious nomenclature (e.g., not "salve rainha", not "sao jorge", not "theotokos", not "virgem maria")

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
- **THEN** its `tags` MUST include at least 10 informal tags matching its themes (e.g., "pedindo perdao", "precisando de ajuda", "confiando em Deus", "lutando contra tentacao")
