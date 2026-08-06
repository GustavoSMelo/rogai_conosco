## ADDED Requirements

### Requirement: Operator can dismiss a prayer request with a reason

The painel SHALL show a trash icon button next to the "Responder" button on each pending prayer request card. Clicking it SHALL open a dialog (modal) where the operator writes the reason for not answering the request. Confirming the dialog SHALL soft-delete the request, setting `deleted_at` to the current timestamp and storing the written reason in `delete_reason`. The reason SHALL be required and non-empty.

#### Scenario: Trash icon shown on pending cards

- **WHEN** a pending prayer request is displayed in the painel list
- **THEN** a trash icon button is rendered next to the "Responder" button

#### Scenario: Trash icon not shown on answered cards

- **WHEN** an answered prayer request is displayed in the painel list
- **THEN** no trash icon button is rendered

#### Scenario: Opening the dialog

- **WHEN** the operator clicks the trash icon
- **THEN** a dialog opens with a textarea for the deletion reason

#### Scenario: Confirming deletion with reason

- **WHEN** the operator fills a reason and confirms the dialog
- **THEN** the request is soft-deleted: `deleted_at` receives the current timestamp and `delete_reason` receives the reason

#### Scenario: Confirming deletion without reason

- **WHEN** the operator confirms the dialog with an empty reason
- **THEN** the request is NOT deleted and a validation error is shown

#### Scenario: Cancelling the dialog

- **WHEN** the operator cancels the dialog
- **THEN** the dialog closes and the request is NOT modified

### Requirement: Soft-deleted requests are excluded from the painel lists

The painel list queries SHALL exclude requests whose `deleted_at` is not null. Soft-deleted requests SHALL NOT appear in the pending list, answered list, pending/answered counts, or total count used by the painel page.

#### Scenario: Pending list excludes soft-deleted requests

- **WHEN** the painel loads the pending requests
- **THEN** requests with a non-null `deleted_at` are not included

#### Scenario: Answered list excludes soft-deleted requests

- **WHEN** the painel loads the answered requests
- **THEN** requests with a non-null `deleted_at` are not included

#### Scenario: Counts exclude soft-deleted requests

- **WHEN** the painel computes pending/answered/total counts
- **THEN** requests with a non-null `deleted_at` are not counted

### Requirement: Prayer requests table supports soft deletion

The `prayer_requests` table SHALL have a nullable `deleted_at` timestamp column (default null for all existing rows) and a nullable `delete_reason` text column. Existing rows SHALL keep `deleted_at = null` and `delete_reason = null` after the migration. The `PrayerRequest` model SHALL use the `SoftDeletes` trait so default model queries exclude soft-deleted rows.

#### Scenario: Migration adds columns

- **WHEN** the migration is run
- **THEN** `prayer_requests` has nullable columns `deleted_at` (timestamp, default null) and `delete_reason` (text, nullable)

#### Scenario: Existing rows keep null values

- **WHEN** the migration is run on a table with existing rows
- **THEN** all existing rows have `deleted_at = null` and `delete_reason = null`

#### Scenario: Model excludes soft-deleted by default

- **WHEN** a query is executed through the `PrayerRequest` model
- **THEN** soft-deleted rows are not returned unless explicitly restored/withTrashed
