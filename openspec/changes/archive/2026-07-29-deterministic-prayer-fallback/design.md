## Context

Current fallback in prayer result component: `$list[array_rand($list)]`. Same short description → different prayer each time → users perceive broken matching.

## Goals / Non-Goals

**Goals:**
- Same description always yields same fallback prayer
- Preserve existing behavior for well-matched descriptions (≥3 tokens)
- Keep changes minimal — single line swap

**Non-Goals:**
- Not changing `PrayerMatcher` — empty result is correct for <3 tokens
- Not adding state, DB, or cache

## Decisions

- **`crc32` mod count** — fast, deterministic, uniform distribution across prayer list. Single inline change: `$list[crc32($this->description) % count($list)]`.
- **Alternative considered: `md5` / `sha1` truncation** — same result, more overhead. No benefit over `crc32`.

## Risks / Trade-offs

- [Collision] `crc32` wraps at 2^32 with mod → biased only if `count($list)` > ~10M, which it never will be. Acceptable.
- [Same prayer every time] Identical descriptions always pick same prayer — that's the goal.