# Conversational Matching

## Purpose

Accept a user's informal daily text and return the best-matching prayers ranked by tag score. Tokenizes user input, filters stopwords, and scores each prayer by signal-word overlap with its tags.

## Requirements

### Requirement: Match daily text to prayer

The system SHALL accept a user's informal daily text and return the best-matching prayers ranked by tag score.

#### Scenario: Basic text matching

- **WHEN** user submits "hoje foi um dia dificil no trabalho precisei de muita paciencia"
- **THEN** the matcher SHALL return prayers whose tags contain signal words like "dificil", "trabalho", "paciencia"

#### Scenario: Stopword filtering

- **WHEN** user submits text containing common pt-BR stopwords (e, de, o, a, os, as, do, da, em, para, com, que, etc.)
- **THEN** those words SHALL be excluded from scoring

#### Scenario: Minimum signal word threshold

- **WHEN** user submits text with fewer than 3 non-stopword signal words
- **THEN** the matcher SHALL return an empty result set

#### Scenario: Return top N matches

- **WHEN** user submits qualifying text
- **THEN** the matcher SHALL return at most the top 3 prayers by score

### Requirement: Score is based on tag overlap

Each prayer's score SHALL be the ratio of signal words present across its tags to total signal words.

#### Scenario: Exact score calculation

- **WHEN** user text has signal words ["paciencia", "fe", "trabalho"] and a prayer's tags contain 2 of those ("paciencia", "fe")
- **THEN** that prayer's score SHALL be 2/3

#### Scenario: Zero-score prayers excluded

- **WHEN** a prayer's tags contain none of the signal words
- **THEN** that prayer SHALL receive score 0 and be excluded from results

### Requirement: Match results are deterministic

The system SHALL produce identical match results for identical input text across multiple invocations. When multiple prayers share the same score, ties SHALL be broken by a stable secondary sort on prayer title in alphabetical order.

#### Scenario: Tied scores yield consistent top result

- **WHEN** user submits text that produces multiple prayers with the same score
- **THEN** the top-1 prayer SHALL always be the same across repeated calls with the same input

#### Scenario: Alphabetical tie-breaking

- **WHEN** two prayers have identical scores
- **THEN** the prayer whose title comes first alphabetically SHALL rank higher
