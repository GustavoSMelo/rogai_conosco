## Context

The `prayer_requests` table has a `delivery` column (string, NOT NULL) defined in the migration. The form submits `prayer_type` (ai, instant, person-prayer, person-bible, person-bible-prayer) but the controller never derives or passes `delivery` to `PrayerRequest::create()` — it's missing from both the validation rules and the data passed to the model.

## Goals / Non-Goals

**Goals:**
- Allow `delivery` to be mass-assigned so prayer request form submissions persist the delivery method
- Derive `delivery` from `prayer_type` in the controller before creating the record

**Non-Goals:**
- No schema or migration changes
- No UI changes

## Decisions

- **Controller derivation:** Add `delivery` to the validation rules (required, string, in mapping) and derive it from `prayer_type`:
  - `ai` → `"ai"`
  - `instant` → `"instant"`
  - `person-prayer`, `person-bible`, `person-bible-prayer` → `"person"`
- **Model fillable:** Add `'delivery'` to `$fillable` so mass-assignment accepts the derived value
- **No cast needed:** `delivery` is a plain string; no casting required.

## Risks / Trade-offs

- None — this is a straightforward bug fix with no side effects.
