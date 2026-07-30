## ADDED Requirements

### Requirement: Instant prayer uses LLM to find best prayer match
The system SHALL call an external LLM API to select the best prayer when the user requests an instant prayer.

#### Scenario: Instant prayer calls findBestPrayMatch
- **WHEN** user submits with type "instant"
- **THEN** the system SHALL call `AiService::findBestPrayMatch()` with the user's description and religion

#### Scenario: Instant prayer falls back to keyword matcher on API failure
- **WHEN** the LLM API returns null or throws an exception
- **THEN** the system SHALL fall back to `PrayerMatcherService::match()` to select a prayer

### Requirement: Loading state during instant prayer LLM call
The system SHALL display a loading indicator while the LLM request is in flight.

#### Scenario: Loading spinner shown during LLM request
- **WHEN** user navigates to the prayer result page with type "instant"
- **THEN** a loading spinner SHALL be displayed initially while the LLM API call is in progress

#### Scenario: Loading spinner hidden when prayer is ready
- **WHEN** the instant prayer result is available
- **THEN** the loading spinner SHALL be replaced by the prayer content

### Requirement: Instant prayer uses async initialization
The system SHALL render the page immediately with a loading state and fetch the instant prayer asynchronously.

#### Scenario: Page renders before LLM API completes
- **WHEN** user navigates to `/prayer/result?type=instant`
- **THEN** the page SHALL render immediately with a loading state

#### Scenario: Async method loads prayer after render
- **WHEN** the page has rendered
- **THEN** the component SHALL call `loadInstantPrayer()` asynchronously via `wire:init`
