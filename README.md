# Seed of Hope — Semence d'Espoir · website

[![CI](https://github.com/FreeDev-Group/seed-of-hope-website/actions/workflows/ci.yml/badge.svg)](https://github.com/FreeDev-Group/seed-of-hope-website/actions/workflows/ci.yml)
[![Deploy](https://github.com/FreeDev-Group/seed-of-hope-website/actions/workflows/deploy.yml/badge.svg)](https://github.com/FreeDev-Group/seed-of-hope-website/actions/workflows/deploy.yml)

WordPress website of **Seed of Hope (Semence d'Espoir)**, a ministry of LePhare offering adult literacy and
vocational training. Built by [FreeDev-Group](https://github.com/FreeDev-Group).

This repository only contains **our code**: the block theme, the core plugin, a must-use plugin, demo content,
tests, scripts and documentation. WordPress core, uploads and secrets are never committed.

## Quick start

Requirements: [Docker Desktop](https://www.docker.com/products/docker-desktop/), [Node.js 20+](https://nodejs.org/), Git.

```bash
git clone https://github.com/FreeDev-Group/seed-of-hope-website.git
cd seed-of-hope-website
npm install
npx playwright install chromium
npm run setup
```

Open <http://localhost:8888> — admin at <http://localhost:8888/wp-admin/>
(local test credentials in [`.env.example`](.env.example); copy it to `.env` to change the port or passwords).

`npm run setup` starts WordPress + MariaDB + WP-CLI, installs WordPress in French, activates the theme and
plugin, and imports one demo page per page of the site map, with the menu. It is safe to run again.

## Commands

| Command | What it does |
| --- | --- |
| `npm run setup` | Start the stack and (re)import the demo site |
| `npm run start` / `npm run stop` | Start / stop the containers |
| `npm run reset` | Delete containers **and data** (then run `setup` again) |
| `npm run wp -- <command>` | Run WP-CLI, e.g. `npm run wp -- plugin list` |
| `npm test` | Playwright: pages, navigation, accessibility (axe-core), editor validity |
| `npm run test:report` | Open the last HTML test report |
| `npm run lint` | Colour contrast + PHP coding standards (WPCS) |
| `npm run lint:php:fix` | Auto-fix coding standards where possible |
| `npm run i18n` | Regenerate `.pot` files and compile translations |
| `npm run screenshots` | Refresh `docs/screenshots/` and the theme screenshot |

## Repository layout

```
wp-content/
  themes/seed-of-hope/        Block theme (theme.json, templates, parts, patterns, fonts, translations)
  plugins/seed-of-hope-core/  Site features that must survive a theme change
  mu-plugins/                 Always-on security hardening
content/                      Demo pages and posts (block markup) imported by WP-CLI
scripts/                      setup.sh, i18n.sh, check-contrast.mjs
tests/e2e/                    Playwright tests
docs/                         Brief, decisions, hosting, deployment, screenshots
.github/                      CI, deploy, issue/PR templates, CODEOWNERS
```

## Documentation

- [Project brief](docs/project-brief.md) — site map, audiences, scope, information still needed from the client
- [Technical decisions](docs/decisions.md) — why things are built this way
- [Hosting comparison](docs/hosting.md) — Hostinger vs o2switch vs Namecheap, with sources
- [Deployment guide](docs/deploiement.md) — hosting account, staging, SSH key, secrets, backups
- [Contributing](CONTRIBUTING.md) — workflow, branches, commits, reviews

## Content rule

**Nothing is invented.** Addresses, phone numbers, programmes, figures, testimonials and partners only appear
once Seed of Hope has confirmed them. Until then the site shows `[À confirmer par Seed of Hope]`.

## Team

- Samuel BITINGINGWA ([@Samuel11s](https://github.com/Samuel11s)) — project lead, reviewer
- Jonathan ([@Bitingingwa](https://github.com/Bitingingwa)) — developer
- Josué ([@kamojosue09-blip](https://github.com/kamojosue09-blip)) — developer

## License

GPL-2.0-or-later, like WordPress. Fonts: SIL Open Font License 1.1 (see the licence files next to the fonts).
