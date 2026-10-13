import { defineConfig, devices } from '@playwright/test';

const baseURL = process.env.WP_URL ?? 'http://localhost:8888';

export default defineConfig({
  testDir: './tests/e2e',
  fullyParallel: true,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 1 : 0,
  // The Docker bind mount is slow on Windows/macOS: a few workers keep page loads fast.
  workers: 2,
  timeout: 60_000,
  reporter: [
    ['list'],
    ['html', { open: 'never', outputFolder: 'playwright-report' }],
    ['junit', { outputFile: 'test-results/junit.xml' }],
  ],
  use: {
    baseURL,
    locale: 'fr-FR',
    trace: 'retain-on-failure',
    screenshot: 'only-on-failure',
  },
  projects: [
    {
      name: 'desktop',
      testMatch: /(pages|navigation|a11y)\.spec\.ts/,
      use: { ...devices['Desktop Chrome'], viewport: { width: 1280, height: 800 } },
    },
    {
      name: 'mobile',
      testMatch: /(pages|navigation|a11y)\.spec\.ts/,
      use: { ...devices['Pixel 7'] },
    },
    {
      // Logs into wp-admin and checks that every pattern, template and demo page
      // is valid block markup, i.e. editable in the Site Editor without errors.
      name: 'editor',
      testMatch: /editor\.spec\.ts/,
      use: { ...devices['Desktop Chrome'], viewport: { width: 1440, height: 900 } },
    },
    {
      // Not part of `npm test`: refreshes docs/screenshots and the theme screenshot.
      name: 'screenshots',
      testMatch: /screenshots\.spec\.ts/,
      use: { ...devices['Desktop Chrome'] },
    },
  ],
});
