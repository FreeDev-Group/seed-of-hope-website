import { test, expect, type Page } from '@playwright/test';

// Local test credentials (see .env.example). Never real credentials.
const USER = process.env.WP_ADMIN_USER ?? 'admin';
const PASSWORD = process.env.WP_ADMIN_PASSWORD ?? 'local-dev-password';

type InvalidBlock = { where: string; block: string; issues: string[] };
type Report = { patterns: string[]; pages: number; templates: number; invalid: InvalidBlock[] };

test.describe.configure({ mode: 'serial' });

async function login(page: Page) {
  await page.goto('/wp-login.php');
  await page.locator('#user_login').fill(USER);
  await page.locator('#user_pass').fill(PASSWORD);
  await page.locator('#wp-submit').click();
  await expect(page).toHaveURL(/\/wp-admin\//);
}

/** Opens the block editor and parses every theme pattern, template, page and menu. */
async function collectBlockReport(page: Page): Promise<Report> {
  await page.goto('/wp-admin/post-new.php?post_type=page');
  await page.waitForFunction(() => (window as any).wp?.blocks?.getBlockTypes().length > 50);

  return page.evaluate(async () => {
    const wp = (window as any).wp;
    const invalid: InvalidBlock[] = [];
    const check = (blocks: any[], where: string) => {
      for (const block of blocks) {
        if (!block.isValid) {
          invalid.push({
            where,
            block: block.name,
            issues: (block.validationIssues ?? []).slice(0, 2).map((i: any) => (i.args ?? []).join(' ').slice(0, 300)),
          });
        }
        check(block.innerBlocks ?? [], where);
      }
    };

    await wp.data.dispatch('core').invalidateResolution('getBlockPatterns', []);
    const patterns = (await wp.data.resolveSelect('core').getBlockPatterns()).filter((p: any) =>
      p.name.startsWith('seed-of-hope/'),
    );
    patterns.forEach((p: any) => check(wp.blocks.parse(p.content), `pattern ${p.name}`));

    const pages = await wp.apiFetch({ path: '/wp/v2/pages?per_page=100&context=edit' });
    pages.forEach((p: any) => check(wp.blocks.parse(p.content.raw), `page ${p.slug}`));

    const templates = [
      ...(await wp.apiFetch({ path: '/wp/v2/templates?per_page=100&context=edit' })),
      ...(await wp.apiFetch({ path: '/wp/v2/template-parts?per_page=100&context=edit' })),
    ].filter((t: any) => t.theme === 'seed-of-hope');
    templates.forEach((t: any) => check(wp.blocks.parse(t.content.raw), `template ${t.slug}`));

    const menus = await wp.apiFetch({ path: '/wp/v2/navigation?per_page=100&context=edit' });
    menus.forEach((m: any) => check(wp.blocks.parse(m.content.raw), `menu ${m.slug}`));

    return { patterns: patterns.map((p: any) => p.name), pages: pages.length, templates: templates.length, invalid };
  });
}

async function setImpactPattern(page: Page, enabled: boolean) {
  await page.evaluate(
    (value) => (window as any).wp.apiFetch({ path: '/wp/v2/settings', method: 'POST', data: { sohc_show_impact_pattern: value } }),
    enabled,
  );
}

test.beforeEach(async ({ page }) => login(page));

test('every pattern, template, page and menu is valid, editable block markup', async ({ page }) => {
  const report = await collectBlockReport(page);

  expect(report.patterns.length).toBeGreaterThanOrEqual(16);
  expect(report.pages).toBeGreaterThanOrEqual(10);
  expect(report.templates).toBeGreaterThanOrEqual(10);
  expect(report.invalid).toEqual([]);
});

test('the impact figures pattern is off by default and can be enabled in Settings', async ({ page }) => {
  let report = await collectBlockReport(page);
  expect(report.patterns).not.toContain('seed-of-hope/impact-figures');

  await setImpactPattern(page, true);
  try {
    report = await collectBlockReport(page);
    expect(report.patterns).toContain('seed-of-hope/impact-figures');
    expect(report.invalid).toEqual([]);
  } finally {
    await setImpactPattern(page, false);
  }
});

test('the Site Editor opens on the theme templates', async ({ page }) => {
  const errors: string[] = [];
  page.on('pageerror', (err) => errors.push(err.message));

  await page.goto('/wp-admin/site-editor.php?canvas=edit');
  const canvas = page.frameLocator('iframe[name="editor-canvas"]');
  // The home page opens in edit mode with the hero rendered from the theme pattern.
  // (CSS locator: the welcome guide modal hides the canvas from the accessibility tree.)
  await expect(canvas.locator('h1', { hasText: 'Semence d’Espoir' })).toBeVisible({ timeout: 30_000 });
  await expect(canvas.locator('.block-editor-warning')).toHaveCount(0);
  expect(errors).toEqual([]);
});
