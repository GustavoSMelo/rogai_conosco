## ADDED Requirements

### Requirement: Painel has an archived filter tab

The painel SHALL show a third filter tab "Arquivados" beside "Pendentes" and "Respondidos", with a count badge of archived requests. Selecting it SHALL list only requests whose `deleted_at` is not null, ordered by `deleted_at` descending. Archived cards SHALL NOT show the "Responder" or trash buttons.

#### Scenario: Archived tab shown with count

- **WHEN** the painel renders the filter row
- **THEN** an "Arquivados" tab is shown next to "Pendentes" and "Respondidos" with the archived count

#### Scenario: Archived filter lists only soft-deleted requests

- **WHEN** an operator selects the archived filter
- **THEN** only requests with a non-null `deleted_at` are listed, ordered by deletion date descending

#### Scenario: Archived cards hide action buttons

- **WHEN** an archived request card is rendered
- **THEN** it does not render the "Responder" button or the trash button

#### Scenario: Archived card shows deletion details

- **WHEN** an archived request card is rendered
- **THEN** it shows the deletion date and the stored `delete_reason`

### Requirement: Operator can unarchive a request

Each archived request card SHALL have a "Desarquivar" button. Clicking it SHALL restore the request: `deleted_at` becomes null and `delete_reason` becomes null. The request SHALL then appear in the pending or answered list according to its `has_answered` state and SHALL be removed from the archived list.

#### Scenario: Unarchive restores the request

- **WHEN** an operator clicks "Desarquivar" on an archived request
- **THEN** the request's `deleted_at` and `delete_reason` become null and the archived list reloads without it

#### Scenario: Unarchived request returns to the correct list

- **WHEN** an operator unarchives a request with `has_answered = false`
- **THEN** the request reappears in the pending list

#### Scenario: Unarchived answered request returns to answered list

- **WHEN** an operator unarchives a request with `has_answered = true`
- **THEN** the request reappears in the answered list