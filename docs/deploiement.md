# Deployment guide (Hostinger + GitHub Actions, FTPS)

Step-by-step guide for the team. No server administration experience needed: everything happens in
**hPanel** (Hostinger's control panel), in **GitHub**, and in **wp-admin**.

> Hosting choice: see [hosting.md](hosting.md) and ADR-010 in [decisions.md](decisions.md).

What gets deployed: only our code — `wp-content/themes/seed-of-hope`, `wp-content/plugins/seed-of-hope-core`
and `wp-content/mu-plugins/*.php`. WordPress itself, the database, `wp-config.php` and uploaded media live on
the server and are **never** overwritten by a deployment.

```
GitHub (main) ──merge──▶ GitHub Actions "Deploy" ──waits for Samuel's approval──▶ FTPS upload ──▶ seedofhopebukavu.org
```

**What our plan allows** (hPanel → *Plan details*): **1 website**, **no SSH**, FTP access, daily backups,
server in Frankfurt (Germany). Consequences:

- deployments use **FTPS** (FTP encrypted with TLS) with `lftp`, see [`scripts/deploy-ftp.sh`](../scripts/deploy-ftp.sh);
- there is **no WP-CLI on the server**: activating the theme or plugin and purging the cache are done in
  wp-admin / hPanel;
- there is **no separate staging site**: we test locally (`npm run setup` + `npm test`), CI tests every pull
  request, and every deployment to production needs Samuel's approval.

> Never write the real FTP host, username or password in this repository: it is public.
> They only go into GitHub **secrets**.

---

## 1. Hosting account (done by Samuel)

- Plan bought, domain `seedofhopebukavu.org` registered (see issues #7 and #20).
- Enable two-factor authentication: hPanel → profile icon → **Security** → 2FA.
- Give the team access without sharing the password: hPanel → **Account sharing / Access management** →
  invite Jonathan and Josué with their own Hostinger accounts. Remove the access at handover.

## 2. Install WordPress

1. hPanel → **Websites** → *seedofhopebukavu.org* → **WordPress** (or *Auto installer*) → install WordPress.
2. Admin email: the dedicated project email. Language: **Français**.
3. Do **not** keep the extra plugins offered by the installer unless they are listed in ADR-011
   (LiteSpeed Cache is acceptable if Hostinger imposes it — write it down in `docs/decisions.md`).
4. Write the admin username and password in the team password manager (never in chat, never in Git).
5. Until the site is validated by Seed of Hope: **Réglages → Lecture → Demander aux moteurs de recherche de
   ne pas indexer ce site** ✔.

## 3. A dedicated FTP account for deployments

The main FTP account can access the whole hosting space. Create one **only for GitHub Actions**:

1. hPanel → **Files** → **FTP Accounts** → *Create a new FTP account*.
2. Directory: `public_html` (the WordPress folder). Username: e.g. `deploy`. Generate a **strong password**.
3. Note the **FTP hostname** shown at the top of the page (e.g. `ftp.<domain>` or the domain itself — without
   `ftp://`) and the full username Hostinger gives (it usually looks like `u123456789.deploy`).
4. Test from your computer with **FileZilla**: protocol **FTP**, encryption
   **"Require explicit FTP over TLS"**, the host, the username and the password. You must see `wp-config.php`,
   `wp-content`, `wp-admin`… If the encryption is refused, ask Hostinger support to confirm FTPS on the plan —
   do **not** fall back to plain FTP (the password would travel in clear text).

> If your plan does not allow extra FTP accounts, use the main one (`FTP_PATH` = `public_html`), and change its
> password at handover.

## 4. GitHub secrets and variables (Samuel, repo admin)

GitHub → repository → **Settings** → **Environments** → **`production`** (it already exists and requires
`@Samuel11s` as reviewer). Add these **environment secrets**:

| Secret | Value | Example | Added? |
| --- | --- | --- | --- |
| `FTP_HOST` | FTP hostname, **without** `ftp://` | `seedofhopebukavu.org` | ☐ |
| `FTP_USER` | Username of the FTP account | `u123456789.deploy` | ☐ |
| `FTP_PASSWORD` | Its password | — | ☐ |
| `FTP_PATH` | Path from the FTP account's home to the folder that contains `wp-config.php` | `.` (dedicated account created on `public_html`) or `public_html` (main account) | ☐ |

And these **environment variables**:

| Variable | Value |
| --- | --- |
| `WP_URL` | `https://seedofhopebukavu.org` (no trailing slash) — used by the smoke test |
| `FTP_VERIFY_CERT` | *Only if the log says the certificate name does not match:* `no`. The connection stays encrypted, but the server's identity is no longer checked — ask Hostinger for the right hostname first. |

The person who types the password into GitHub should copy it directly from the password manager: never
send it by WhatsApp, email or chat.

> Until these secrets exist, merges on `main` show a yellow warning "Deployment skipped" instead of failing.

## 5. First deployment

1. Make a backup first: hPanel → **Backups** → *Generate new backup*.
2. GitHub → **Actions** → **Deploy** → **Run workflow** → environment `production`, **dry run ✔** (default) → Run.
   Samuel approves the deployment (GitHub sends him a notification).
   Read the log: lftp lists the files it *would* send. Nothing is changed.
3. Run it again with **dry run unticked**. Approve. The log ends with `Deployment finished.`
4. In **wp-admin** (first deployment only):
   - **Apparence → Thèmes** → activate **Seed of Hope**;
   - **Extensions** → activate **Seed of Hope Core**;
   - **Réglages → Général** → language **Français**, time zone **Lubumbashi** (Bukavu, UTC+2);
   - **Réglages → Permaliens** → **Titre de la publication**.
5. hPanel → **Cache Manager** → *Purge all*. Open the site on a phone and on a computer.

### From now on
Every merge on `main` that touches `wp-content/` starts a deployment to production that **waits for Samuel's
approval** (GitHub → Actions → the waiting run → *Review deployments* → *Approve and deploy*).

### Pages and content
Without SSH we cannot run `scripts/setup.sh` on the server. Create the pages in wp-admin with the
**Seed of Hope patterns** (the same ones as the local demo site), using **validated content only**, then build
the menu in the Site Editor. It is also the best way to learn how the client will edit the site.

## 6. Backups and restore

Hostinger makes **daily automatic backups** (hPanel → **Backups**).

### Before every deployment or big change
hPanel → **Backups** → *Generate new backup*. It takes a few minutes.

### Restore
1. hPanel → **Backups**.
2. Choose **Files backups** (code, media) or **Database backups** (pages, settings), and a date.
3. Click **Restore**. For files you can restore a single folder, e.g. `public_html/wp-content/uploads`.
4. Check the site, then tell the team in the issue tracker what was restored and why.

### Our own extra copy (monthly)
hPanel → **Backups** → download the latest **files** and **database** backups. Store them in the project's
shared drive, never in the Git repository (they contain personal data).

### Roll back a bad deployment
The code is in Git: **revert the faulty PR** on GitHub (*Revert* button on the merged PR), merge the revert PR,
and approve the deployment: the previous version of the theme and plugin is uploaded again.

## 7. Handover to Seed of Hope

1. Give Seed of Hope the **dedicated email account** (they change its password and recovery phone).
2. They log into Hostinger with it, change the password, enable their own 2FA, and replace the payment card
   in **Billing → Payment methods**. Turn auto-renewal on with their card.
3. Create WordPress accounts for their editors with the **Éditeur** role (not Administrateur).
4. If FreeDev no longer maintains the site: delete the deployment FTP account in hPanel, remove FreeDev's
   WordPress accounts and the team's hPanel access, and delete the GitHub secrets.
5. Hand over this document and the editor guide (#22).

## Troubleshooting

| Symptom in the Deploy log | Fix |
| --- | --- |
| `Login incorrect` / `530` | Wrong `FTP_USER` or `FTP_PASSWORD` (copy the full username from hPanel, e.g. `u123456789.deploy`). |
| `Access failed: 550 … wp-config.php` | `FTP_PATH` does not point to the WordPress folder: try `.` or `public_html`. |
| `Certificate verification: …` / name mismatch | Use the FTP hostname shown in hPanel for `FTP_HOST`; as a last resort set the variable `FTP_VERIFY_CERT` to `no`. |
| `Fatal error: max-retries exceeded` / timeout | Hostinger may be blocking the connection: retry later, then contact support. |
| `Deployment skipped, missing secrets` | Add the four `FTP_*` secrets to the **production** environment. |
| Site shows the old version | hPanel → **Cache Manager** → *Purge all*, then reload with Ctrl+F5. |

## Run a deployment from your computer (optional)

`scripts/deploy-ftp.sh` also works locally (Git Bash, Linux or macOS, with `lftp` installed):

```bash
FTP_HOST=… FTP_USER=… FTP_PASSWORD=… FTP_PATH=. DRY_RUN=1 bash scripts/deploy-ftp.sh
```

Prefer GitHub Actions: it deploys exactly what is on `main`, with an approval and a log everyone can read.
