# Encrypt Contact Fields

Enforce encryption at the model level for `whatsapp` and `email` fields on `PrayerRequest` using an Eloquent cast, replacing the previous controller-level approach.

## Motivation

Encryption was previously applied manually in the controller, making it easy to miss code paths. Moving encryption to a model cast ensures every create/update path is covered.

## Approach

1. Create `app/Casts/EncryptedString.php` — `CastsAttributes` implementation, `encryptString` on set, `decryptString` on get
2. Register cast on `PrayerRequest` for `whatsapp` and `email`
3. Remove manual `Crypt::encryptString()` calls on those fields from `welcome.blade.php`
4. Migration to encrypt existing plain-text rows
