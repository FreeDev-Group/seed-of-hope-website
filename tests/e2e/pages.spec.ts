import { test, expect, isMobile, openMobileMenu } from './fixtures';
import { MENU_LABELS, OTHER_TEMPLATES, PHP_ERROR, SITE_MAP } from './site-map';

test.describe('Site map pages', () => {
  for (const sitePage of SITE_MAP) {
    test(`${sitePage.path} loads cleanly`, async ({ page, consoleErrors }) => {
      const response = await page.goto(sitePage.path);

      // Status and title.
      expect(response?.status()).toBe(200);
      await expect(page).toHaveTitle(sitePage.title);
      await expect(page.getByRole('heading', { level: 1 })).toHaveCount(1);
      await expect(page.getByRole('heading', { level: 1 })).toHaveText(sitePage.h1);

      // Landmarks.
      await expect(page.locator('header').first()).toBeVisible();
      await expect(page.locator('main#main')).toBeVisible();
      await expect(page.locator('footer').first()).toBeVisible();

      // No PHP notice, warning or fatal error in the HTML.
      expect(await page.content()).not.toMatch(PHP_ERROR);

      // Performance rule: no jQuery on the front end.
      expect(await page.evaluate(() => typeof (window as unknown as { jQuery?: unknown }).jQuery)).toBe('undefined');

      // The main navigation is usable at this viewport.
      const nav = page.getByRole('navigation').first();
      if (isMobile(page)) {
        await expect(nav.getByRole('link', { name: 'Contact', exact: true })).toBeHidden();
        const dialog = await openMobileMenu(page);
        for (const label of MENU_LABELS) {
          await expect(dialog.getByText(label, { exact: true }).first()).toBeVisible();
        }
        await page.keyboard.press('Escape');
        await expect(dialog).toBeHidden();
      } else {
        for (const label of MENU_LABELS) {
          await expect(nav.getByText(label, { exact: true }).first()).toBeVisible();
        }
      }

      // No JavaScript error during the whole visit.
      expect(consoleErrors).toEqual([]);
    });
  }
});

test.describe('Other templates', () => {
  for (const template of OTHER_TEMPLATES) {
    test(`${template.name} (${template.path})`, async ({ page, consoleErrors }) => {
      const response = await page.goto(template.path);
      expect(response?.status()).toBe(template.status);
      await expect(page.getByRole('heading', { level: 1 })).toHaveCount(1);
      await expect(page.locator('main#main')).toBeVisible();
      expect(await page.content()).not.toMatch(PHP_ERROR);
      // A 404 response is logged by the browser as a console error: that one is expected.
      expect(consoleErrors.filter((e) => !(template.status === 404 && e.includes('404')))).toEqual([]);
    });
  }
});
