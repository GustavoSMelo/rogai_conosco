# Contact Field Encryption

## Purpose

Ensure `whatsapp` and `email` fields on `PrayerRequest` are encrypted at rest, enforced at the model level so all code paths are covered.

## Requirements

### Requirement: Contact fields encrypted before storage

The `PrayerRequest` model SHALL encrypt `whatsapp` and `email` fields using `Crypt::encryptString()` before persisting to the database. Encryption SHALL be enforced at the model level via an Eloquent cast, covering any code path that creates or updates records.

#### Scenario: New submission encrypts whatsapp and email
- **WHEN** a user submits a prayer request with `whatsapp` and `email` values
- **THEN** both fields are stored encrypted in the database (verified by checking raw DB value differs from input and `Crypt::decryptString()` recovers the original)

#### Scenario: Existing encrypted values remain readable with cast
- **WHEN** a record had `whatsapp` or `email` encrypted by the previous controller-level approach
- **THEN** reading the attribute through the model returns the original plain value

#### Scenario: Encryption works through any code path (not only controller)
- **WHEN** a `PrayerRequest` is created or updated through any path (controller, tinker, factory, seeder, API)
- **THEN** `whatsapp` and `email` are encrypted on write and decrypted on read automatically

### Requirement: Existing plain-text rows are migrated to encrypted

A migration SHALL encrypt existing plain-text `whatsapp` and `email` values on all `PrayerRequest` rows that are non-null.

#### Scenario: Existing plain-text values are encrypted
- **WHEN** the migration runs against rows with plain-text `whatsapp` or `email`
- **THEN** those values are replaced with their encrypted equivalents

#### Scenario: Null values remain null after migration
- **WHEN** the migration encounters a row where `whatsapp` is null or `email` is null
- **THEN** those null values remain unchanged
