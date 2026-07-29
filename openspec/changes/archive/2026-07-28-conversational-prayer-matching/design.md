## Context

Prayers currently carry snake_case keyword tags. Users share daily experiences in informal, natural language. The matching system must bridge this gap: accept unstructured daily text, extract salient words, and find prayers whose natural-language tags best resonate.

## Goals / Non-Goals

**Goals:**
- Rewrite all prayer tags as a mix of single keywords and natural/conversational phrases (e.g., `"perdao"`, `"luto"`, `"recebi um elogio"`, `"gratidao pela familia"`)
- Build `PrayerMatcher` service: accepts user daily text, returns ranked prayer matches
- Tokenization: split user text into words, remove common stopwords (pt-BR), lowercase
- Scoring: each remaining word scores against each prayer's tags — match ratio per prayer determines rank
- Expose matching via a simple API call or Livewire component

**Non-Goals:**
- No NLP models, embeddings, or AI-based matching
- No real-time tag extraction from prayer body — tags remain hand-curated
- No user personalization or history tracking
- No external search engine (Elasticsearch, Meilisearch)

## Decisions

1. **Tag format: mix of keywords and phrases** — Tags include both single keywords (`"perdao"`, `"luto"`, `"morte"`) for precise emotional/situational signals and short phrases (`"beijei hoje"`, `"recebi um elogio"`) for richer context. Both forms are tokenized for scoring, so single words match directly while phrases expand matching surface.

2. **Stopword-based word ranking** — Use a curated pt-BR stopword list. Non-stopwords from user input are the "signal words." Each prayer's score = number of signal words found across its tags / total signal words. Simple, interpretable, zero dependencies.

3. **PrayerMatcher as Laravel Service class** — `app/Services/PrayerMatcher.php` with a single `match(string $text, int $limit = 3): array` method. Keeps logic testable and framework-agnostic within the app.

4. **Inline stopword list** — A small array in the service class (~150 pt-BR stopwords). Avoids file I/O and external packages. Easy to extend.

5. **Tags remain in `Prays.php` as static data** — No new database table. The matcher receives `Prays::getPrays()` directly.

## Risks / Trade-offs

- [Simple scoring] Word overlap scoring may return weak matches for very short or very generic text. Mitigation: require minimum signal word count (≥3) before matching.
- [Manual tag curation] Rewriting 100+ tags to a mix of keywords and phrases is labor. Mitigation: batch by theme, keep phrases short (2-5 words), reuse keywords across similar prayers.
- [Stopword list quality] pt-BR stopwords vary by register. Mitigation: start conservative, add words as gaps appear.
