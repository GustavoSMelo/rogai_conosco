## Context

The `resources/data/prays.php` file currently returns a flat array with a single `catholic` key containing ~30 Catholic prayers. The app needs to serve Protestant and Orthodox users as well. The file structure needs to accommodate:

- Prayers specific to each tradition
- Prayers common across traditions, **duplicated** in each with tradition-appropriate wording
- A simple, backwards-compatible format

## Goals / Non-Goals

**Goals:**
- Restructure `prays.php` with 3 top-level keys: `catholic`, `protestant`, `orthodox`
- Add ~30 Protestant and ~30 Orthodox prayers with accurate devotional texts
- Duplicate prayers common across traditions in each section with tradition-appropriate wording
- Maintain the existing `title`, `category`, `subcategory`, `body` format across all sections

**Non-Goals:**
- Database storage or Eloquent model
- API endpoints or controllers
- Search or indexing improvements
- UI redesign for prayer browsing
- Theological review or approval from ecclesiastical authorities

## Decisions

### Data Structure: Top-level tradition keys

Use 3 tradition keys — no shared section:
```php
return [
    "catholic" => [...],  // catholic prayers
    "protestant" => [...],// protestant/evangelical prayers
    "orthodox" => [...],  // orthodox prayers
];
```

**Rationale:** Simple lookup for the frontend — load the selected tradition's key. Prayers common to multiple traditions are duplicated in each section with the wording appropriate to that tradition (e.g., Pai Nosso appears 3 times: once per tradition, each with its own textual variant).

### Prayer sources

- **Catholic**: existing content
- **Protestant**: biblical prayers (Pai Nosso, Salmos, orações de Paulo), classic devotional prayers widely used in evangelical/liturgical protestant contexts
- **Orthodox**: sourced from fatheralexander.org ("Pequeno Livro de Orações Ortodoxo"), lecionarioortodoxo.blogspot.com, and ecclesia.org.br — covering daily prayers (manhã/noite), Triságio, Theotokos, and saint intercessions

## Risks / Trade-offs

- **File size increase** — The file will roughly double. Mitigation: loaded only when prayer features are active.
- **Text accuracy** — Prayer texts sourced from web may have minor wording variations. Mitigation: use established public-domain sources (liturgical texts); test for structural integrity.
- **Breaking change for consumers** — Code that reads `prays.php` assumes a single key `catholic`. Mitigation: document the new structure and update any references.
