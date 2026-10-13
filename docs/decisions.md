# Technical decisions

Short architecture decision records (ADR). Add a new entry instead of rewriting an old one; mark the old one
"Superseded by ADR-xxx".

---

## ADR-001 — WordPress with a standalone block theme (FSE)

- **Decision**: a standalone block theme `seed-of-hope` (not a child theme), WordPress ≥ 7.0.
- **Why**: the client must edit pages, header, footer and menus without code. The Site Editor does exactly that
  with a block theme. A standalone theme has no parent to update and no inherited CSS to fight.
  Block themes load no jQuery and very little CSS by default.
- **Consequences**: all hard-coded text lives in PHP **patterns** (translatable) referenced from templates,
  because `.html` templates cannot hold translatable strings. The Playwright `editor` project checks that every
  pattern, template, page and menu is valid block markup.

## ADR-002 — Presentation in the theme, features in the `seed-of-hope-core` plugin

- **Decision**: the theme only handles appearance. Settings, media processing and future content types live in
  the plugin `seed-of-hope-core`. Security rules that must never be disabled live in a **must-use plugin**.
- **Why**: changing the theme in 3 years must not lose features or content.
- **Current plugin content**: the "impact figures" setting (Settings → Reading), WebP generation for uploads,
  removal of the emoji script.
- **Current mu-plugin**: XML-RPC off, WordPress version hidden, user enumeration blocked for anonymous visitors.

## ADR-003 — Design tokens in `theme.json`, contrast checked in CI

- **Palette** (warm and sober — hope, growth, learning): warm white `#FFFDF8`, sand `#F6F0E4`, deep green ink
  `#1E2A23`, leaf green `#2B6A4B`, forest green `#1D4A35`, terracotta `#9C4318`, sunrise gold `#E8B04A`,
  soft sage `#E4EFE6`, soft sunrise `#FBEFD6`.
- **Custom colours are disabled** in the editor so editors can only pick palette colours, and every
  text/background pair used is ≥ 4.5:1 (WCAG AA). `scripts/check-contrast.mjs` reads `theme.json` in CI;
  the lowest pair is 5.16:1.
- **Placeholder** — the logo, official colours and photos are still to be provided by the client
  (`blocked:client`). The palette will be adjusted then, and the contrast check will catch any regression.

## ADR-004 — Readable typography, self-hosted fonts

- **Body**: Atkinson Hyperlegible (Braille Institute), designed to tell similar letters apart — useful for
  people who read with difficulty. **Headings**: Lexend, designed to improve reading fluency.
- Body 18 px minimum (fluid 18 → 20 px), line height 1.7, content width 46 rem (~70 characters).
- Fonts are **self-hosted** WOFF2 files (Latin subset, includes French accents and œ) declared in `theme.json`:
  no request to Google, nothing to declare in a privacy notice, faster on slow connections.
  Licences: SIL OFL 1.1, copied next to the files.

## ADR-005 — Accessibility rules

- Semantic landmarks (`header`, `nav`, `main#main`, `footer`), one `h1` per page.
- "Aller au contenu" skip link: printed by **WordPress core (7.0+) on the server**, translated, pointing at
  `main#main`; styled by the theme. (We first shipped our own and removed it: core's version is better and
  duplicates were confusing.)
- Visible focus ring everywhere (3 px terracotta, gold on dark sections).
- Mobile menu: a text button "Menu" (clearer than an icon alone) up to 1 200 px wide, because eight menu items
  in a large font wrap on tablets.
- FAQ uses the native `<details>` element: works with keyboard and without JavaScript.
- No text in images. The hero illustration is a decorative SVG with `alt=""`.
- Tested on every page with **axe-core** (WCAG 2.0/2.1/2.2 A and AA) on desktop and mobile, plus keyboard tests.

## ADR-006 — "Programme" content type: not now, pages for the launch

- **Decision**: programmes are **pages** (children of *Nos programmes*) built with the *Programme sheet*
  pattern. No custom post type (CPT) for the launch.
- **Why**:
  - the validated site map has two programme pages (Alphabétisation, Formation professionnelle) and the actual
    list of tracks is unknown;
  - pages are what editors already know; a CPT adds an admin menu, archive URLs and fields to learn;
  - the *Programme sheet* pattern already gives every programme the same structure (objectives, audience,
    prerequisites, duration, location, conditions, contact).
- **When to switch to a CPT** (in `seed-of-hope-core`, never in the theme): if Seed of Hope confirms **5 or more
  tracks**, or needs filtering (by place, date, level), a calendar, or registrations per programme. The migration
  is small: register the `sohc_program` type with the sheet as its block template, then move the pages.
- Tracked by the issue *"Decide: Programme content type"* (`blocked:client`).

## ADR-007 — Languages: French content, English source strings

- Site installed in `fr_FR`. Theme and plugin strings are written in English (WordPress convention) with the text
  domains `seed-of-hope` and `seed-of-hope-core`; French translations ship in `languages/` (`.po`, `.mo`,
  `.l10n.php`). `npm run i18n` regenerates the `.pot` templates and merges new strings.
- Bilingual FR/EN is **to be confirmed**. If confirmed, we will compare free options (Polylang free vs.
  separate sub-site) and record the choice here before installing anything.

## ADR-008 — Local environment: Docker Compose + WP-CLI

- `npm run setup` starts WordPress 7.1 (PHP 8.3, Apache), MariaDB 11.4 and runs `scripts/setup.sh` with WP-CLI:
  French language, theme and plugin activated, the 10 demo pages, two example posts, the menu, front page and
  posts page. Idempotent: run it again any time.
- Only the theme, plugin and mu-plugins are mounted from the repo; WordPress core and uploads stay in Docker
  volumes and are never committed.
- Default port **8888** (8080 is often already used).

## ADR-009 — Quality gate: PHPCS + Playwright in GitHub Actions, official actions only

- `lint` job: contrast check, `php -l`, WordPress Coding Standards 3 + PHPCompatibilityWP (`phpcs.xml.dist`).
- `e2e` job: runs `npm run setup` then Playwright on Chromium — one test per page (HTTP 200, title, single h1,
  no PHP error, no console error, no jQuery, navigation on desktop and mobile), keyboard tests, axe-core on
  every page and template, and editor validity checks. The HTML report is uploaded as an artifact.
- Only `actions/*` actions are used (checkout, setup-node, cache, upload-artifact): no third-party action has
  access to the code or secrets.
- `main` is protected: PR + 1 approval + both checks green.

## ADR-010 — Hosting: Hostinger "Unlimited", deployment by SSH + rsync

- See [hosting.md](hosting.md) for the comparison with o2switch and Namecheap (prices checked 13 Oct 2026).
- **Deciding factor**: o2switch only allows SSH from at most 5 allow-listed IPs, which does not work with
  GitHub-hosted runners. Hostinger offers SSH without allow-list, staging, daily backups and French support.
- Deployment (`deploy.yml`): every merge on `main` → staging; production by manual run with required approval.
  rsync with `--delete` only inside our theme and plugin folders; mu-plugins copied file by file.

## ADR-011 — Third-party plugins

- **None installed.** WordPress core covers the needs of the launch (pages, posts, menus, patterns, lazy loading,
  WebP via our plugin, SEO basics: titles, sitemap `wp-sitemap.xml`).
- Candidates if a need is confirmed, all free, to be justified here before installation:
  contact form (*Contact Form 7* or *WPForms Lite*), multilingual (*Polylang*), anti-spam (*Antispam Bee*).
- Akismet and Hello Dolly are removed by `npm run setup`.
