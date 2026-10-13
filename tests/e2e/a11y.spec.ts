import AxeBuilder from '@axe-core/playwright';
import { test, expect, isMobile, openMobileMenu } from './fixtures';
import { OTHER_TEMPLATES, SITE_MAP } from './site-map';

const WCAG_TAGS = ['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa', 'wcag22aa'];

const pages = [
  ...SITE_MAP.map((p) => ({ path: p.path, name: p.path })),
  ...OTHER_TEMPLATES.map((t) => ({ path: t.path, name: t.name })),
];

test.describe('Accessibility (axe-core, WCAG 2.2 A/AA)', () => {
  for (const { path, name } of pages) {
    test(`${name} has no detectable WCAG violations`, async ({ page }, testInfo) => {
      await page.goto(path);
      const results = await new AxeBuilder({ page }).withTags(WCAG_TAGS).analyze();

      await testInfo.attach('axe-results.json', {
        body: JSON.stringify(results.violations, null, 2),
        contentType: 'application/json',
      });

      // Readable failure message: rule id, impact and the offending elements.
      const summary = results.violations.map((v) => ({
        rule: v.id,
        impact: v.impact,
        help: v.help,
        targets: v.nodes.map((n) => n.target.join(' ')),
      }));
      expect(summary).toEqual([]);
    });
  }

  test('the open mobile menu has no detectable WCAG violations', async ({ page }) => {
    test.skip(!isMobile(page), 'Mobile only');
    await page.goto('/');
    await openMobileMenu(page);

    const results = await new AxeBuilder({ page }).include('header').withTags(WCAG_TAGS).analyze();
    expect(results.violations.map((v) => v.id)).toEqual([]);
  });
});
