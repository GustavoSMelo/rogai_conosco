## ADDED Requirements

### Requirement: Contact fields encrypted before storage

The PrayerRequest model SHALL encrypt `whatsapp` and `email` fields using `Crypt::encryptString()` before persisting to the database. Encryption SHALL be enforced at the model level via an Eloquent cast, covering any code path that creates or updates records.

#### Scenario: New submission encrypts whatsapp and email
- **WHEN** a user submits a prayer request with `whatsapp` and `email` values
- **THEN** both fields are stored encrypted in the database (verified by checking raw DB value differs from input and `Crypt::decryptString()` recovers the original)

#### Scenario: Existing encrypted values remain readable with cast
- **WHEN** a record had `whatsapp` or `email` encrypted by the previous controller-level approach
- **THEN** reading the attribute through the model returns the original plain value

#### Scenario: Encryption works through any code path (not only controller)
- **WHEN** a `PrayerRequest` is created or updated through any path (controller, tinker, factory, seeder, API)
- **THEN** `whatsapp` and `email` are encrypted on write and decrypted on read automatically

## MODIFIED Requirements

### Requirement: Existing plain-text rows are migrated to encrypted

- **WHEN** the migration runs
- **THEN** all existing `PrayerRequest` rows with non-null `whatsapp` or `email` have those values replaced with their encrypted equivalents

#### Scenario: Null values remain null after migration
- **WHEN** the migration encounters a row where `whatsapp` is null or `email` is null
- **THEN** those null values remain unchanged
