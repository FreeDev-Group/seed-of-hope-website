#!/usr/bin/env node
/**
 * Checks WCAG 2.x contrast for every text/background pair the theme uses.
 * Reads the palette from theme.json, so changing a colour there is checked in CI.
 * Usage: npm run lint:contrast
 */
import { readFileSync } from 'node:fs';

const theme = JSON.parse(readFileSync(new URL('../wp-content/themes/seed-of-hope/theme.json', import.meta.url), 'utf8'));
const palette = Object.fromEntries(theme.settings.color.palette.map((c) => [c.slug, c.color]));

// [text, background]: pairs used by templates, patterns and buttons. Body text needs 4.5:1 (AA).
const PAIRS = [
  ['contrast', 'base'], ['contrast', 'surface'], ['contrast', 'primary-soft'], ['contrast', 'accent-soft'], ['contrast', 'accent'],
  ['contrast-muted', 'base'], ['contrast-muted', 'surface'], ['contrast-muted', 'primary-soft'], ['contrast-muted', 'accent-soft'],
  ['primary', 'base'], ['primary', 'surface'], ['primary', 'primary-soft'],
  ['primary-dark', 'base'], ['primary-dark', 'surface'], ['primary-dark', 'primary-soft'], ['primary-dark', 'accent-soft'],
  ['secondary', 'base'], ['secondary', 'surface'], ['secondary', 'primary-soft'], ['secondary', 'accent-soft'],
  ['base', 'primary'], ['base', 'primary-dark'], ['base', 'secondary'], ['base', 'contrast'],
];
const AA = 4.5;

const luminance = (hex) => {
  const [r, g, b] = [1, 3, 5].map((i) => parseInt(hex.slice(i, i + 2), 16) / 255)
    .map((v) => (v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4));
  return 0.2126 * r + 0.7152 * g + 0.0722 * b;
};
const ratio = (a, b) => {
  const [hi, lo] = [luminance(a), luminance(b)].sort((x, y) => y - x);
  return (hi + 0.05) / (lo + 0.05);
};

let failures = 0;
for (const [fg, bg] of PAIRS) {
  if (!palette[fg] || !palette[bg]) {
    console.error(`✗ unknown colour slug in pair ${fg} / ${bg}`);
    failures++;
    continue;
  }
  const r = ratio(palette[fg], palette[bg]);
  const ok = r >= AA;
  if (!ok) failures++;
  console.log(`${ok ? '✓' : '✗'} ${fg.padEnd(15)} on ${bg.padEnd(13)} ${r.toFixed(2)}:1`);
}

if (failures) {
  console.error(`\n${failures} pair(s) below WCAG AA (${AA}:1).`);
  process.exit(1);
}
console.log(`\nAll ${PAIRS.length} pairs meet WCAG AA (≥ ${AA}:1).`);
