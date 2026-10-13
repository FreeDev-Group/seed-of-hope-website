import { test, devices } from '@playwright/test';

// Run with `npm run screenshots`. Not part of `npm test`.
const SHOTS = [
  { name: 'home', path: '/' },
  { name: 'programme-literacy', path: '/nos-programmes/alphabetisation/' },
];

const VIEWPORTS = [
  { suffix: 'desktop', options: { viewport: { width: 1440, height: 900 } } },
  { suffix: 'mobile', options: { ...devices['Pixel 7'] } },
];

test('documentation screenshots', async ({ browser }) => {
  for (const viewport of VIEWPORTS) {
    const context = await browser.newContext(viewport.options);
    const page = await context.newPage();
    for (const shot of SHOTS) {
      await page.goto(shot.path, { waitUntil: 'networkidle' });
      await page.screenshot({ path: `docs/screenshots/${shot.name}-${viewport.suffix}.png`, fullPage: true });
    }
    await context.close();
  }
});

test('theme screenshot (1200×900, shown in Appearance → Themes)', async ({ browser }) => {
  const context = await browser.newContext({ viewport: { width: 1200, height: 900 } });
  const page = await context.newPage();
  await page.goto('/', { waitUntil: 'networkidle' });
  await page.screenshot({ path: 'wp-content/themes/seed-of-hope/screenshot.png' });
  await context.close();
});
