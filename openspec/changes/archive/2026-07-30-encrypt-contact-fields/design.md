# Design

## Cast

```php
class EncryptedString implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?string
    {
        if ($value === null) return null;
        try { return Crypt::decryptString($value); }
        catch (DecryptException) { return $value; }
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value === null) return null;
        return Crypt::encryptString($value);
    }
}
```

## Model

Register `EncryptedString` cast for `whatsapp` and `email` on `PrayerRequest`. Leave `message` as-is (out of scope).

## Migration

Batch-encrypt existing non-null `whatsapp`/`email` values via `DB::table()->chunk()`.

## Controller

Remove `Crypt::encryptString()` calls on `whatsapp`/`email` from welcome form — cast handles it transparently.
