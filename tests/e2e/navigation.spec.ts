import { test, expect, isMobile, openMobileMenu } from './fixtures';

test.describe('Keyboard and navigation', () => {
  test('the first Tab reveals "Aller au contenu", which moves to the main content', async ({ page }) => {
    await page.goto('/a-propos/');
    await page.keyboard.press('Tab');

    const skipLink = page.getByRole('link', { name: 'Aller au contenu' });
    await expect(skipLink).toBeFocused();
    await expect(skipLink).toBeInViewport();

    await page.keyboard.press('Enter');
    await expect(page).toHaveURL(/#main$/);
  });

  test('a visitor can reach the Contact page from the menu', async ({ page }) => {
    await page.goto('/');
    const nav = page.getByRole('navigation').first();

    if (isMobile(page)) {
      await (await openMobileMenu(page)).getByRole('link', { name: 'Contact', exact: true }).click();
    } else {
      await nav.getByRole('link', { name: 'Contact', exact: true }).click();
    }

    await expect(page).toHaveURL(/\/contact\/$/);
    await expect(page.getByRole('heading', { level: 1 })).toHaveText('Contact');
  });

  test('the programmes submenu leads to the literacy page', async ({ page }) => {
    await page.goto('/');
    const nav = page.getByRole('navigation').first();

    if (isMobile(page)) {
      await (await openMobileMenu(page)).getByRole('link', { name: 'Alphabétisation' }).click();
    } else {
      // Keyboard users open the submenu with its toggle button.
      await nav.getByRole('button', { name: /Programmes/ }).click();
      await nav.getByRole('link', { name: 'Alphabétisation' }).click();
    }

    await expect(page).toHaveURL(/\/nos-programmes\/alphabetisation\/$/);
  });

  test('FAQ answers open with the keyboard', async ({ page }) => {
    await page.goto('/nos-programmes/');
    const question = page.locator('summary').first();
    await question.focus();
    await expect(question).toBeFocused();
    await page.keyboard.press('Enter');
    await expect(page.locator('details').first()).toHaveAttribute('open', '');
  });

  test('focused links show a visible focus ring', async ({ page }) => {
    await page.goto('/contact/');
    const link = page.locator('footer a').first();
    await link.focus();
    const outline = await link.evaluate((el) => getComputedStyle(el).outlineStyle);
    expect(outline).not.toBe('none');
  });
});
