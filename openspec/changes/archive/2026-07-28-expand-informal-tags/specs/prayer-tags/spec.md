## MODIFIED Requirements

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

### Requirement: Tags reflect body content

Tags SHALL be derived from key themes, nouns, and concepts present in the prayer's `body` text.

#### Scenario: Tags match body themes

- **WHEN** examining a prayer's body text
- **THEN** each tag SHOULD correspond to a recognizable concept or theme present in the body

#### Scenario: Known prayer has expected tags

- **WHEN** checking the "Pai Nosso" catholic prayer
- **THEN** its `tags` MUST include at least 10 informal tags matching its themes (e.g., "pedindo perdao", "precisando de ajuda", "confiando em Deus", "lutando contra tentacao")

## REMOVED Requirements

### Requirement: Tags allow specific religious terms

**Reason**: Tags must be purely informal to match how users describe their day in casual conversation. Religious-specific terms reduce match quality for everyday language.

**Migration**: Remove all saint names, prayer titles, and religious-specific tags. Replace with informal conversational equivalents.
