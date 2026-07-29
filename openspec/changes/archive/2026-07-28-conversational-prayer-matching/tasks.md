## 1. Write Tests for Matching Engine

- [x] 1.1 Write test `test_basic_text_matching` — user text with signal words returns matching prayers
- [x] 1.2 Write test `test_stopwords_are_filtered` — common pt-BR stopwords excluded from scoring
- [x] 1.3 Write test `test_minimum_signal_word_threshold` — <3 signal words returns empty
- [x] 1.4 Write test `test_score_calculation` — exact ratio verified for known inputs
- [x] 1.5 Write test `test_zero_score_prayers_excluded` — no-match prayers omitted from results
- [x] 1.6 Write test `test_top_n_matches` — at most 3 results returned

## 2. Write Tests for Tag Format

- [x] 2.1 Update test `test_tags_use_snake_case` → `test_tags_use_natural_language` — tags are non-empty Portuguese words or phrases, not validated against snake_case regex
- [x] 2.2 Update test `test_known_prayer_has_expected_tags` — "Pai Nosso" expects a mix of keywords and phrases

## 3. Rewrite Prayer Tags as Mix of Keywords and Phrases

- [x] 3.1 Rewrite all catholic prayer tags to mix of keywords and phrases in `resources/data/Prays.php`
- [x] 3.2 Rewrite all protestant prayer tags to mix of keywords and phrases in `resources/data/Prays.php`
- [x] 3.3 Rewrite all orthodox prayer tags to mix of keywords and phrases in `resources/data/Prays.php`
- [x] 3.4 Rewrite all other prayer tags to mix of keywords and phrases in `resources/data/Prays.php`

## 4. Build PrayerMatcher Service

- [x] 4.1 Create `app/Services/PrayerMatcher.php` with pt-BR stopword list
- [x] 4.2 Implement tokenize(): split text, lowercase, filter stopwords
- [x] 4.3 Implement score(): match signal words against prayer tags, compute ratio
- [x] 4.4 Implement match(string $text, int $limit = 3): return top N prayers with scores
- [x] 4.5 Run `php artisan test --filter=PrayerMatcherTest` — all pass

## 5. Integrate Matcher in UI

- [x] 5.1 Create Livewire component for daily text input
- [x] 5.2 Display ranked prayer results with scores
- [x] 5.3 Run `php artisan test` — all tests pass
