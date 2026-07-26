## Context

`resources/data/prays.php` currently holds 88 prayers across 3 traditions (catholic, protestant, orthodox) with verbose Portuguese formal category names (e.g., `"Orações Tradicionais"`, `"Orações Marianas"`). `resources/data/new-prays.php` holds 37 Catholic prayers with a concise snake_case keyword taxonomy (e.g., `"geral"`, `"intercessao"`, `"protecao"`). The two files must be merged, and all entries normalized to the keyword taxonomy.

## Goals / Non-Goals

**Goals:**
- Merge all unique prayers from `new-prays.php` into `prays.php` under the appropriate tradition key
- Re-categorize every entry in `prays.php` using the snake_case keyword pattern from `new-prays.php`
- `subcategory` values also follow the snake_case keyword pattern
- Remove `namespace App\Data;` from `prays.php`
- Delete `new-prays.php` after merge
- Update `PrayersDataTest` if needed
- Adding traditions prays just adjusting some fixes (catholic/protestant/orthodox stay)

**Non-Goals:**
- Changing prayer body text
- Database or model changes
- UI changes

## Decisions

1. **Category taxonomy from new-prays.php as canon** — The 12 categories (`geral`, `intercessao`, `protecao`, `santificacao`, `esperanca`, `arrependimento`, `estudos`, `amor`, `fe`, `saude`, `cura`, `forca`) cover all existing prayers. Old verbose categories map onto these.
2. **Subcategory keywords normalized** — All subcategory values converted to snake_case Portuguese, using existing keywords from `new-prays.php` plus additions as needed (e.g., `apostolos`, `igreja`, `missao`).
3. **Manual categorization** — Each prayer reviewed individually for appropriate category/subcategory assignment based on content, not old category name.

## Risks / Trade-offs

- **Lost granularity** — Old verbose categories carried implicit grouping (e.g., "Orações Marianas" grouped all Mary prayers). Keywords lose that grouping. **Mitigation:** subcategory can preserve specificity (e.g., `virgem_maria` subcategory).
- **Category mismatch** — Some prayers span multiple categories (e.g., a protection prayer can also be intercessory). **Mitigation:** primary category captures the main intent; secondary themes go in subcategory.
- **Test breakage** — `PrayersDataTest` doesn't test specific category values, only structure. No test changes expected.
