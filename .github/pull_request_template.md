<!-- Template authors: Samuel BITINGINGWA (@Samuel11s), with Claude AI as contributor. -->

## What does this change?

<!-- One or two sentences. Link the issue so it closes on merge. -->

Closes #

## How to test

<!-- Steps the reviewer follows locally, e.g. `npm run setup`, then open http://localhost:8888/contact/ -->

1.
2.

## Screenshots

| Desktop | Mobile |
| ------- | ------ |
|         |        |

## Checklist

### Quality
- [ ] `npm run lint` passes (PHPCS + contrast)
- [ ] `npm test` passes (pages, navigation, axe-core, editor)
- [ ] Branch name and PR title follow [CONTRIBUTING.md](../CONTRIBUTING.md) (Conventional Commits)

### WordPress
- [ ] Editable in the Site Editor by a non-developer (no hard-coded content in templates)
- [ ] New text is translatable (`seed-of-hope` / `seed-of-hope-core` text domain) and `npm run i18n` was run
- [ ] Features live in the plugin, presentation in the theme
- [ ] No new third-party plugin, or it is listed and justified in `docs/decisions.md`

### Accessibility and content
- [ ] Checked with the keyboard only (Tab, Enter, Escape), focus always visible
- [ ] Images have meaningful alt text (or `alt=""` if decorative); no text inside images
- [ ] No invented information: unconfirmed content uses "[À confirmer par Seed of Hope]"
- [ ] Respectful wording: learners are never presented as incapable

---
<sub>PR template maintained by @Samuel11s · contributor: Claude AI</sub>
