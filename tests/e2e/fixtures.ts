import { test as base, expect, type Page } from '@playwright/test';

/**
 * `consoleErrors` collects console errors and uncaught exceptions for the whole test.
 */
export const test = base.extend<{ consoleErrors: string[] }>({
  consoleErrors: async ({ page }, use) => {
    const errors: string[] = [];
    page.on('console', (msg) => {
      if (msg.type() === 'error') errors.push(msg.text());
    });
    page.on('pageerror', (err) => errors.push(err.message));
    await use(errors);
  },
});

export { expect };

/**
 * Opens the mobile menu and returns its dialog. Retries the click because the button
 * only works once the Interactivity API has hydrated the navigation block.
 */
export async function openMobileMenu(page: Page) {
  const dialog = page.getByRole('dialog');
  await expect(async () => {
    if (!(await dialog.isVisible())) {
      await page.getByRole('navigation').first().getByRole('button', { name: 'Menu' }).click();
    }
    await expect(dialog).toBeVisible({ timeout: 1_000 });
  }).toPass({ timeout: 15_000 });
  return dialog;
}

/** True when the current project emulates a phone. */
export const isMobile = (page: Page) => (page.viewportSize()?.width ?? 1280) < 600;
