## Context

The `App\Data\Prays` class returns 3 arrays (`catholic`, `protestant`, `orthodox`). The `prayer-result.blade.php` Volt component reads this data via `require` and tries `$prayers[$religion] ?? $prayers['other'] ?? []`. Since `other` key doesn't exist, users with `religion=other` get an empty list.

## Goals / Non-Goals

**Goals:**
- Add `"other"` key with ~20 universal prayers to `App\Data\Prays::getPrays()`
- Fix `prayer-result.blade.php` to use `Prays::getPrays()` (religion dropdown value `other` directly matches the key)
- Keep all existing tests passing; add coverage for the new key

**Non-Goals:**
- Not creating new prayers from scratch (curated from existing traditions)
- Not modifying existing `catholic`/`protestant`/`orthodox` data
- Not changing the prayer selection algorithm (`array_rand`)
- Not modifying the welcome form's religion dropdown labels

## Decisions

1. **Use Prays class instead of raw require** — The Volt component and test both currently use `require resource_path('data/prays.php')`. Since `prays.php` now is a PSR-4 autoloaded class (`app/Data/Prays.php`), `require` returns the class definition, not the data array. We must switch to `Prays::getPrays()` in both the Volt component and the test.

2. **Select prayers from protestant tradition** — Protestant versions of common prayers use informal "tu/te" pronouns (vs. Catholic "vós/vos") and avoid saintly intercession, making them more ecumenical and suitable for users who don't identify with a specific tradition.

3. **Cover all major categories** — Ensure at least one prayer per: adoração, ação de graças, intercessão (saúde, paz, família, trabalho), arrependimento, santificação, proteção/confiança.

4. **Oração de São Francisco included** — Though attributed to a Catholic saint, the prayer is universally recognized across Christian traditions and contains no denomination-specific theology. It also appears in the protestant section already.

## Risks / Trade-offs

- [Selection bias] Curated set may not cover every user's spiritual need → Mitigation: 20 prayers across 8+ categories provide broad coverage
- [Protestant skew] Using protestant versions may feel foreign to Catholic/Orthodox "other" users → Mitigation: these prayers use simple, biblical language without any tradition-specific markers
- [require vs class] Existing Volt code uses raw `require` which doesn't work with a namespaced class → Mitigation: switch to `Prays::getPrays()` (fixing pre-existing bug)
