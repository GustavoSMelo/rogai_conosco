## 1. Model Cast

- [x] 1.1 Create `app/Casts/EncryptedString.php` (implements `CastsAttributes`, encrypt on set, decrypt on get)
- [x] 1.2 Register cast on `PrayerRequest` model for `whatsapp` and `email` fields

## 2. Remove Controller-Level Encryption

- [x] 2.1 Remove `Crypt::encryptString()` calls on `whatsapp` and `email` in `welcome.blade.php` submit() method
- [x] 2.2 Keep `Crypt::encryptString()` on `message` field (no cast for message — out of scope)
- [x] 2.3 Keep `use Illuminate\Support\Facades\Crypt;` import (still used for `message` and `description`)

## 3. Migration

- [x] 3.1 Update migration to re-save existing plain-text rows through the model (so cast triggers encryption)
- [x] 3.2 No migration needed for already-encrypted rows — cast's `get` decrypts them transparently

## 4. Tests

- [x] 4.1 Add unit test for EncryptedString cast (plain text in → encrypted in DB → decrypted on read)
- [x] 4.2 Update feature test to verify encryption works through model directly (not just via controller)
- [x] 4.3 Update feature test: submission no longer double-encrypts (controller passes plain text, cast encrypts)
