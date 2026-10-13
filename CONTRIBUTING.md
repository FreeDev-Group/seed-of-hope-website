# Contributing

Welcome! This guide is short on purpose. Ask Samuel (@Samuel11s) when something is unclear —
questions are part of the job.

## Workflow: issue → branch → PR → CI → review → squash merge

1. **Issue** — every change starts from an issue on the [project board](https://github.com/orgs/FreeDev-Group/projects).
   Assign it to yourself and move it to **In progress**.
   If the issue waits for client content, it has the `blocked:client` label: build the structure with
   placeholders, but do not invent the content.
2. **Branch** — from an up-to-date `main`:
   ```bash
   git switch main && git pull
   git switch -c feat/12-contact-page
   ```
3. **Commit** — small commits with [Conventional Commits](#commit-messages). Run the checks before pushing:
   ```bash
   npm run lint
   npm test
   ```
4. **Pull request** — push and open a PR. Fill the template, link the issue with `Closes #12`,
   add desktop and mobile screenshots. Open it as **Draft** if you want early feedback.
5. **CI** — the `lint` and `e2e` checks must be green. If `e2e` fails, download the
   `playwright-report` artifact from the run: it shows the screenshot and trace of each failure.
6. **Review** — at least **1 approval** (Samuel is requested automatically via CODEOWNERS).
   Reply to every comment; push fixes as new commits (no force-push during review).
7. **Squash merge** — the PR title becomes the commit on `main`, so it must follow Conventional Commits.
   The branch is deleted automatically. Merging to `main` deploys to **staging**.

`main` is protected: no direct push, PR + 1 review + green CI required.

## Branch names

`<type>/<issue-number>-<short-description>` in lowercase with hyphens:

| Type | Use for | Example |
| --- | --- | --- |
| `feat/` | new page, pattern, feature | `feat/7-programme-sheet` |
| `fix/` | bug fix | `fix/21-menu-focus` |
| `content/` | demo or real content, translations | `content/15-about-page-text` |
| `docs/` | documentation only | `docs/30-editor-guide` |
| `test/` | tests only | `test/18-axe-contact` |
| `ci/` | workflows | `ci/25-cache-composer` |
| `chore/` | tooling, dependencies | `chore/28-update-playwright` |

## Commit messages

[Conventional Commits](https://www.conventionalcommits.org/): `type(scope): summary`

- **types**: `feat`, `fix`, `docs`, `style` (formatting only), `refactor`, `test`, `ci`, `chore`, `perf`, `content`
- **scopes**: `theme`, `plugin`, `mu-plugin`, `patterns`, `content`, `i18n`, `tests`, `ci`, `deploy`, `docs`, `env`
- summary in English, imperative mood, lowercase, no final period, ≤ 72 characters

```
feat(patterns): add programme sheet pattern
fix(theme): keep focus ring visible on dark sections
content(i18n): translate contact pattern into French
```

Breaking change: add `!` (`feat(theme)!: rename palette slugs`) and explain in the body.

## Rules of the project

- **No invented information.** Use `[À confirmer par Seed of Hope]` (translated placeholder:
  `seed_of_hope_tbc()` in patterns).
- **Respectful wording.** Never present learners as incapable.
- **Accessibility is a requirement**: keyboard, visible focus, alt text, contrast, one `h1` per page.
- **Theme = appearance, plugin = features.** Content types, settings and integrations go in `seed-of-hope-core`.
- **Templates contain no text.** Put text in a pattern under `patterns/` with `esc_html_e( '…', 'seed-of-hope' )`,
  then run `npm run i18n` and translate the new strings in `languages/fr_FR.po`.
- **No paid plugin, and no third-party plugin** unless it is listed and justified in `docs/decisions.md` and
  approved by Samuel.
- **Never commit secrets**, database dumps, uploads or `.env`.

## Useful links

- [Block theme handbook](https://developer.wordpress.org/themes/block-themes/)
- [theme.json reference](https://developer.wordpress.org/block-editor/reference-guides/theme-json-reference/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Playwright docs](https://playwright.dev/docs/intro)
- [WCAG 2.2 quick reference](https://www.w3.org/WAI/WCAG22/quickref/)
