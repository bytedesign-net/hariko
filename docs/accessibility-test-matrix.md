# Hariko Accessibility Test Matrix

Target: **WCAG 2.2 Level AA** / WordPress.org **Theme Accessibility** requirements.
Status legend: `PASS` verified automated · `FAIL` defect found · `MANUAL` needs human · `N/A` not applicable · *(blank)* not yet run.

> This document records testing evidence. **No conformance/"準拠" claim may be published
> (readme.txt, theme description) until every row below is PASS or N/A** — see Spec §3 notation rule.

## 1. Environment

| Item | Value |
| --- | --- |
| Site | wp-env local, `http://localhost:8888`, WP trunk (7.1.3), ja_JP |
| Theme | hariko 1.0.12 (current working tree) |
| Fixtures | News category (ID 199, 12 posts): `test-post-1`…`test-post-12` (IDs 1844–1855, all `post_date` 2026-11-08 → canonical URLs `/2026/11/08/test-post-N/`). P1 `test-post-1` — `_wp_page_template=single-with-sidebar`, 1 approved test comment, post content contains a Search block; P2 `test-post-2` — `_wp_page_template=single-fullwidth` (no sidebar); P3 `test-post-3` — sticky (`sticky_posts` option = [1846]), default template. Pages: `about-2` (default), `page-with-sidebar` (`page-with-sidebar` template), `page-fullwidth` (`page-fullwidth` template), `products` (`page-with-sidebar` template; content = heading+paragraphs+columns+media-text+buttons, attachment `hariko-hero`), `widget` as child of products → `/products/widget/` (default template, no sidebar). Category archive `/category/news/`, 404 via `/nonexistent-page-xyz/` |
| Permalinks | date-based (`/%year%/%monthnum%/%day%/%postname%/`, rewrite rules flushed); WP canonical redirects (301) active on post URLs — scripts must follow redirects (`curl -L`) |
| Browser | OpenCode embedded browser (Chromium engine) |

Regenerate fixtures: `scripts/wp-cli-fixtures.sh` (WP-CLI via wp-env, run from the host repo
root as `npx wp-env run cli bash -c 'bash wp-content/themes/hariko/scripts/wp-cli-fixtures.sh'`).
Idempotent upsert by slug — post IDs, dates, template assignments and comments are preserved.
Re-run and verified 2026-11-10 after the DB restore: IDs 1844–1860 unchanged, all URLs 200/404 as expected.

## 2. Tooling

| Tool | Scope | Mode |
| --- | --- | --- |
| `scripts/check-contrast.js` | static palette pairs incl. hero-on-`primary` (hero Cover is a solid palette token, §8.2) — all 10 palettes (theme.json + 9 colour variations) × 18 rules, 180/180 PASS | `npm run contrast` |
| axe-core 4.10.2 (CDN copy, injected) | DOM rules incl. `color-contrast` on computed styles | script pipeline: serve lib on :8890 → inject → run → collect JSON |
| OpenCode browser | keyboard traversal (real key presses), focus visibility, zoom emulation, motion | `evaluate` + `press` + `screenshot` |
| Lighthouse 12.x CLI (`--only-categories=accessibility`) | bundled axe + DOM audit superset | headless Chrome |
| WAVE (wave-web-search) | second-opinion rule engine | browser (manual) |
| axe DevTools browser extension | full rule incl. best-practice review | browser (manual) |
| Theme Check (plugin) | static theme scan | wp-admin (manual) |
| NVDA / VoiceOver | SR semantics | manual (out of sandbox) |

axe pipeline (repeatable): `python3 -m http.server 8890 --bind 127.0.0.1 --directory /tmp/opencode`
(serve `axe.min.js`) → `browser.evaluate` inject → `axe.run({resultTypes:['violating','incomplete']})` → POST results back. Stop server when done.

## 3. Automated checklist (WP.org Theme Accessibility + WCAG technical)

Status column reflects the actual run against live wp-env (2026-11-10; rows affected by the §8.2 design change are annotated).

### 3.1 Contrast

| Item | Method | Result |
| --- | --- | --- |
| **Color contrast — all pages** | axe `color-contrast` | PASS (1 item INCOMPLETE → F-04; F-04 moot after §8.2 hero change — re-run on `/` = 0 incomplete) |
| **Color contrast — hero title/subtitle** | hero Cover is a solid `primary` background (§8.2), so it is checked as a token pair: base-2 on `primary` — PASS on all 10 palettes (5.72–8.32:1) | PASS (script + axe) |
| Full text colour sweep | Lighthouse contrast audit | PASS (score 1.00 on `/`) |
| Colour variations (9 palettes) | script | PASS |
| Focus indicator visibility | `:focus-visible` style check + zoom screenshot | PASS |
| Text not inside images (headings/buttons/nav) | HTML source audit | PASS — 0 headings/buttons with text as background image (hero pixel-sampling case eliminated by §8.2; footer buttons `hariko_button_*.png` are pure icons, `<img>` inside `<a>` with empty `alt` + surrounding `wp:block` text) |

### 3.2 Keyboard & focus

| Item | Method | Result |
| --- | --- | --- |
| Keyboard accessible | axe `keyboard-access` rules (`avoid-inline-click`, `tabindex`, `focus-order-semantics`, `frame-focusable-content`, `landmark-one-main`) on 6 templates | PASS — 0 violations, 0 incomplete |
| No positive `tabindex` | code audit | PASS — 0 hits |
| No `outline: none` | code audit | PASS — 0 hits |
| Focus ring present | CSS check | PASS — 2px solid `var(--wp--preset--color--contrast)` + 2px offset |

### 3.3 Landmarks, headings, semantics

| Item | Method | Result |
| --- | --- | --- |
| Landmarks (header/nav/main/footer/search) | axe `landmark-*` + HTML audit | PASS (header `banner`, `nav[aria-label]`, `main`, `footer[aria-label]` ×3, `search` in sidebar/404; header `form (search)` removed §8.2; `form` ×1–2). Note: hero Cover sits **inside `<main>`** after F-03 |
| Heading hierarchy | axe `heading-order` | PASS |
| Skip link | HTML audit | PASS — `href="#main"`, target exists |
| Search labels | HTML audit | all instances PASS — `type="search"`, id/name, label/aria-label, button has text; header instance removed §8.2, sidebar/404 verified |
| `<html>` no `lang` (WP adds) | audit | PASS |
| Tables have `<caption>`/scope | audit | N/A — theme has none |
| Text-spacing override | CSS override probe | PASS (0px diff — no height-limiting rules) |
| Reduced motion | CSS + live transition check | PASS — `@media (prefers-reduced-motion: reduce)` present; computed transitions = 0.1s |
| Responsive 320px | CSS `@media (max-width:782px)` + scrollWidth probe | PASS — no h-scroll |

## 4. WCAG 2.2 AA test matrix

| Test | Where | Status |
| --- | --- | --- |
| 1.4.3 / 1.4.6 contrast | script + axe + Lighthouse | PASS (F-04 moot §8.2; final re-run pending §9) |
| 1.4.4 resize 200% | browser zoom emulation | PASS |
| 1.4.10 reflow 320px | viewport emulation | PASS |
| 1.4.11 UI component contrast (focus, borders, buttons) | script (3:1) | PASS |
| 1.4.12 text spacing | probe | PASS |
| 1.4.13 hover/focus content | menu/submenu/tooltip areas | MANUAL |
| 2.1.2 no trap | full-page tab traversal, both viewports | PASS |
| 2.4.1 bypass | skip link first stop | PASS |
| 2.4.3 focus order | traversal order audit | PASS — 48 stops (46 after §8.2 header-search removal): skip→title→nav(7 items)→main→post links→pagination→sidebar→footer; logical |
| 2.4.4 link purpose | source audit of query/pagination links | PASS (title text; date links have text) |
| 2.4.7 visible focus | screenshot at zoom | PASS |
| 2.4.11 focus appearance | ring ≥2px, offset | PASS (scripted proxy); MANUAL visual per-viewport |
| 2.5.8 target size ≥24px | computed size audit all interactive els | **FAIL → F-02 fixed**; re-run clean — 0 violations/0 incomplete (incl. axe `target-size` on `/`, 73 nodes) |
| 3.1.1 lang | audit | PASS |
| 3.2.3 consistent navigation | home/post/page/archive diff | MANUAL |
| 3.2.4 consistent identification | same-labeled components | MANUAL |
| 3.3.1 / 3.3.2 forms | search + comment form | MANUAL (search labels automated PASS; comment form has no rendered instance — templates lack comments block, see O-03) |
| 4.1.2 name/role/value | axe + SR spot checks | axe PASS; SR MANUAL |

Page types exercised: home (`/` = hero + post loop), singular, sticky singular, page, archive, 404, search results (`/?s=hariko`, 10 results), widget-test pages (`/products/` + child `/products/widget/`), with-sidebar (P1 via `single-with-sidebar` template), no-sidebar (P2 via `single-fullwidth` template assignment — no `hariko_sidebar_meta` in DB) — all verified live.

## 5. Screen reader matrix (manual)

| Item | Home | Post | Archive | 404 | Search |
| --- | --- | --- | --- | --- | --- |
| Landmark list order (banner→nav→main→search→contentinfo) | | | | | |
| Post title read as heading level (H2 for posts, H1 on singular) | | | | | |
| Nav list announced "navigation, list, N items" | | | | | |
| Search region + label announced | | | | | |
| Footer nav headings (3 lists) + labels | | | | | |
| Skip link announced before content | | | | | |
| Post date read as date (no machine-stutter, en-dash `–`) | | | | | |
| Comment link text reads with post context | | | | | |
| Sticky post announced same as normal post | | | | | |
| 404 message + search announced | | | | | |
| Search results count announced | | | | | |
| No unlabelled generic noise ("link, ," etc.) | | | | | |

## 6. WP.org Theme Accessibility requirement rows

| # | Requirement | Verification | Status |
| --- | --- | --- | --- |
| A-01 | Contrast script (18 rules × 10 palettes) | `npm run contrast` | PASS 180/180 |
| A-02 | axe on 13 URLs ×4 template sets | pipeline | PASS 0 violations, 0 incomplete (§8.1) |
| A-03 | WAVE all templates | browser | MANUAL (extension) |
| A-04 | axe DevTools full incl. best-practice | browser | MANUAL (extension) |
| A-05 | F-01 footer link contrast | axe (footer 0 incl.) + computed style: footer links `text-decoration: underline solid rgb(26,26,26)` (F-01 applied), all text 17.4:1; F-04 moot §8.2 | PASS |
| A-06 | Landmark audit per template | HTML source audit | PASS |
| A-07 | Heading hierarchy | axe `heading-order` | PASS |
| A-08 | Search block labels | HTML audit | PASS (header instance removed §8.2; sidebar/404 verified) |
| A-09 | Skip link + `#main` target | HTML audit | PASS |
| A-10 | Text-in-image audit | HTML audit + axe | PASS (hero is solid palette background — §8.2) |
| A-11 | Keyboard traversal + focus visible | browser Tab walk (real presses) | PASS (46 stops after §8.2; 0 keyboard violations; focus ring verified) |
| A-12 | Zoom/text-size | browser emulation | PASS |
| A-13 | Lighthouse a11y | CLI | PASS 1.00 on `/` (pre-§8.2; re-run at final pass) |
| A-14 | Contrast script re-run after hero token change | `npm run contrast` | PASS 180/180 |
| A-15 | Positive tabindex / outline:none grep | script | PASS (0 hits) |
| A-16 | Responsive 320 / drawer at 782 | browser | PASS |
| A-17 | Text spacing override | browser | PASS |
| A-18 | Reduced motion | CSS + computed | PASS |
| A-19 | Sticky post display | fixture `/2026-11-08/test-post-3/` | PASS — sticky (1846) prepended on home with `.sticky` post class; theme applies no sticky badge/styling, so it is announced identically to a normal post (WP default, acceptable) |

Note: all automated items green (A-05 pending manual visual confirmation of F-01 rendering).

## 7. Manual matrix (human required)

| # | Item | Where | Status |
| --- | --- | --- | --- |
| M-01 | NVDA (Firefox/Chrome): landmarks, H-levels, tab order, 2.5.13 target feel | all templates | |
| M-02 | VoiceOver (Safari/macOS) same | all templates | |
| M-03 | VoiceOver (iOS) + TalkBack (Android): touch target comfort, double-tap | home/post/menu | |
| M-04 | Real 200% zoom (Ctrl+Plus) & mobile width: no clipping/h-overflow | all templates | |
| M-05 | Forced-colors (Windows High Contrast): borders/focus visible | primary pages | |
| M-06 | WAVE extension run + triage | all templates | |
| M-07 | axe DevTools full scan incl. best-practices | all templates | |
| M-08 | Theme Check plugin scan | wp-admin | |
| M-09 | Editor a11y: heading picker, palette contrast names, skip-to-toolbar | post editor | |

## 8. Defect log

| ID | Found | Severity | Description | Status |
| --- | --- | --- | --- | --- |
| F-01 | 2026-11-10 | High | Footer link colour `primary` on `base` #e8f1fe = **3.57:1** (needs 4.5), 16 nodes on every page (footer appears site-wide; axe reported only on `/` due to viewport sampling — real coverage is 100% of pages) | **Fixed** — `footer__social` / `footer__info` links inherit `contrast` + underline |
| F-02 | 2026-11-10 | Medium | Submenu dropdown toggles 20×20px < 24px minimum target (×6 pages) | **Fixed** — toggle 24×24 (`:where()` chained selector matching core class) |
| F-03 | 2026-11-10 | Medium | Hero Cover (site title H2 / tagline P / hero H2) sits **outside `<main>`** — home content not in a landmark | **Fixed (option 1)** — hero moved **inside `<main>`** in `patterns/front-page.php` (no new landmark; full-bleed via `"align":"full"` on Cover + constrained inner group). axe after fix: 0 violations / 0 incomplete / 52 passes on `/` |
| F-04 | 2026-11-10 | Review | axe `color-contrast` INCOMPLETE ×3 on hero title over `hariko_hero.jpg` background image — undecidable by axe, needs human/script judgement | **Moot** — hero is now a solid `primary` background (§8.2); post-change axe on `/` = 0 incomplete |
| D-5 | 2026-11-10 | Decision | Hero `hariko_hero.jpg` has baked-in blue pixels — palette-blind. Options: (1) remove image, solid `primary` Cover; (2) regenerate transparent/dark image + `primary` overlay; (3) keep image + dim overlay. Until decision, hero contrast must not be claimed | **Closed by option 1 via §8.2** — hero Cover is a solid `primary` background with no image; palette-driven and checked by the contrast script |
| D-6 | 2026-11-10b | Decision | Header Search block removed from `parts/header.html` per user request (sidebar + 404 Search intentionally kept). The `button-inside` Search wrapper-border rule in `assets/css/style.css` became dead code — no `button-inside` Search instances remain anywhere in the theme | **Closed** — dead CSS rule deleted (no twin rule in `editor-style.css` existed) |

### 8.1 Post-fix re-verification (2026-11-10)

| Check | Result |
| --- | --- |
| axe on `/` (hero fixed, footer fixed, toggle fixed) | **0 violations, 0 incomplete, 52 passes** |
| axe on `/2026-11-08/test-post-1/` | **0 violations, 0 incomplete, 59 passes** |
| Lighthouse 12.8.3 a11y on `/` | **score 1.00** — 0 failing audits; contrast/landmark/heading/link-name/focus audits all green |
| axe `target-size` (2.5.8) on `/` | 0 violations — 73 interactive nodes audited (menu toggles now 24px; footer links 36–114px) |
| Drawer keyboard walk @ ≤782px (toggle → real Tab presses) | **PASS** — focus order: skip → menu toggle → close → drawer site-title → nav items ×7 → submenu toggles ×2 → submenu items ×6 → search → submit → back to browser UI. 0 keyboard violations; focus ring (2px + 2px offset) verified via screenshots of focused toggle and focused search input |
| Drawer contrast | 0 incomplete (solid `contrast` bg → computable) |
| Hero full-bleed regression | Cover remains `alignfull` inside `<main>`; axe 52 passes; hero visible |

### 8.2 Second design change (2026-11-10 b): hero palette-following + header search removal

Two styling changes requested by the user, both accessibility-positive:

1. **Hero Cover follows the active palette.** Hero is now a solid `primary` background (`dimRatio: 100`, no background image), so changing the colour variation (`styles/colors/*.json`) automatically recolours the hero. Verified live: injecting `--wp--preset--color--primary: #a04d00` (Amber) computed the Cover background to `rgb(160,77,0)`; purge + reload returned the default state clean. `scripts/check-contrast.js` hero rule switched from hardcoded image-blue to the `primary` token → **180/180 PASS across all 10 palettes**. This also moots F-04 and closes D-5.
2. **Header search box removed** from `parts/header.html` (user request). Sidebar and 404 Search blocks intentionally kept and re-verified: `/products/widget/` 1 input, 404 1 input, `/` 0 inputs. The now-orphaned `button-inside` Search wrapper-border CSS rule was deleted (D-6).

Post-change re-verification:

| Check | Result |
| --- | --- |
| axe-core on `/` | **0 violations, 0 incomplete** |
| axe-core full regression (2026-11-10, after §1 fixture regeneration) | **12/12 URLs** — `/`, P1/P2/P3, `/category/news/`, `/products/`, `/products/widget/`, `/about-2/`, `/page-with-sidebar/`, `/page-fullwidth/`, `/?s=hariko`, 404 — **0 violations, 0 incomplete on every URL** |
| Keyboard walk (real Tab presses) on `/` | **46 stops** (was 48 — the 2 search stops are gone); order still skip-link → site title → nav; 0 focus traps |
| Lighthouse | not re-run (pure element removal, no new risk) — re-run at the final §9 pass |

## 9. Final record sheet (fill as executed; all green required before any claim)

| Row | Tool/Method | Date | Result | Note |
| --- | --- | --- | --- | --- |
| A-01 Contrast script 18×10 | `npm run contrast` | 2026-11-10b | PASS 180/180 | incl. hero-on-`primary` token pair (§8.2) |
| A-02 axe 13 URLs | axe-core pipeline | 2026-11-10 | PASS 0/0 | final re-run after all fixes: pending |
| A-03 WAVE | extension | | | |
| A-04 axe DevTools | extension | | | |
| A-05 Footer/hero contrast | axe + computed | 2026-11-10 | PASS | footer underline rendered; F-04 moot (§8.2) |
| A-06 Landmarks | HTML audit | 2026-11-10 | PASS | 6 templates |
| A-07 Headings | axe | 2026-11-10 | PASS | |
| A-08 Search labels | HTML audit | 2026-11-10 | PASS | sidebar/404 — header instance removed (§8.2) |
| A-09 Skip link | HTML audit | 2026-11-10 | PASS | |
| A-10 Text-in-image | HTML+axe | 2026-11-10b | PASS | hero now solid palette bg — no image text at all |
| A-11 Keyboard + focus | browser walk | 2026-11-10b | PASS | 46 stops (§8.2), 0 violations |
| A-12 Zoom 200% | browser | 2026-11-10 | PASS | |
| A-13 Lighthouse | CLI 12.8.3 | 2026-11-10 | PASS 1.00 | re-run on final tree at §9 close |
| A-14 2.5.8 targets | axe + sizes | 2026-11-10 | PASS | 73 nodes ≥24px |
| A-15 tabindex/outline | grep | 2026-11-10 | PASS 0 | |
| A-16 Responsive 320 | browser | 2026-11-10 | PASS | |
| A-17 Text spacing | probe | 2026-11-10 | PASS | |
| A-18 Reduced motion | CSS+live | 2026-11-10 | PASS | |
| M-01…M-09 | human/SR | | | see §7 |

**2026-11-10: F-01/F-02/F-03 fixed and re-verified (§8.1). 2026-11-10b: hero palette-following + header-search removal per §8.2 — automated rows green again.** No conformance claim until every A- row and M- row passes.

## Open items

- O-01: front page = `show_on_front=posts` (no static front page) — `front-page.html` template exists in theme but home uses `home.html`; re-check template matrix if user sets a static front page.
- O-02: footer nav labels all "Footer menu 1–3" — unique but generic; consider `Site info` / `Privacy` / `Social` for SR friendliness (design choice, not a violation).
- O-03: comment form never renders — `single.html`/front loop lack `<!-- wp:comments -->`; if the user adds comments UI, run §5 rows on it.
- O-04: `archive.html` uses `core/query` not `core/query-title`/`core/post-archive-summary`; title is `core/post-archive-title` (H2). On archives H2 follows H1 — acceptable but verify SR phrasing.
- O-05: F-03 hero-in-main and §8.2 hero/search changes are design-level — the user may prefer the previous look; the fixes are isolated in `patterns/front-page.php` and `parts/header.html` for easy revert.
