# Deployment guide (Hostinger + GitHub Actions)

Step-by-step guide for the team. No server administration experience needed: everything happens in
**hPanel** (Hostinger's control panel), in **GitHub**, and in a terminal on your own computer.

> Hosting choice and prices: see [hosting.md](hosting.md). **Samuel buys the plan**; nobody else pays for anything.

What gets deployed: only our code — `wp-content/themes/seed-of-hope`, `wp-content/plugins/seed-of-hope-core`
and `wp-content/mu-plugins/*.php`. WordPress itself, the database, `wp-config.php` and uploaded media live on
the server and are **never** overwritten by a deployment.

```
GitHub (main) ──merge──▶ GitHub Actions "Deploy" ──SSH + rsync──▶ staging.<domain>   (automatic)
                          Run workflow → production ──approval──▶ <domain>           (manual)
```

---

## 1. Create the hosting account (Samuel)

1. Create a **dedicated email address** for the project, for example `seedofhope.website@gmail.com`
   (any provider). Store its password in the team password manager. Never use a personal address:
   at handover we give this mailbox to Seed of Hope and the whole account goes with it.
2. On <https://www.hostinger.com/web-hosting> (or hostinger.fr for French), choose **Unlimited → 12 months**.
3. Sign up with the dedicated email. Pay with the team Visa card.
4. When asked for the data center, choose **France** or **Netherlands** (closest to Bukavu and Kampala in practice).
5. Domain:
   - if Seed of Hope already owns a domain, choose "I already have a domain" and note the DNS changes to make;
   - otherwise, wait for the client's decision (see `docs/project-brief.md`). You can start with the temporary
     domain that Hostinger provides.
6. Enable two-factor authentication: hPanel → profile icon → **Security** → 2FA.

## 2. Create the production and staging sites

### Production
1. hPanel → **Websites** → **Add website** → **WordPress**. Use the main domain.
2. Admin email: the dedicated project email. Language: **Français**.
3. Write the admin username and password in the password manager.

### Staging (a copy for testing, on a sub-domain)
1. hPanel → **Domains** → **Subdomains** → create `staging` (→ `staging.<domain>`).
2. Install WordPress on this subdomain (**Websites** → **Add website** → WordPress → select the subdomain).
   Alternative: hPanel → WordPress → **Staging** → *Create staging* copies the production site; use it when
   production has real content.
3. In the staging WordPress: **Réglages → Lecture → Demander aux moteurs de recherche de ne pas indexer ce site** ✔.
   Staging must never appear in Google.

## 3. SSH key for GitHub Actions

We create one key **only for deployments**, never a personal key.

1. On your computer (Git Bash on Windows, Terminal on macOS/Linux):
   ```bash
   ssh-keygen -t ed25519 -C "github-actions-deploy@seed-of-hope" -f seed-of-hope-deploy -N ""
   ```
   This creates `seed-of-hope-deploy` (private key) and `seed-of-hope-deploy.pub` (public key).
2. hPanel → **Advanced** → **SSH Access**:
   - check that SSH is **enabled**;
   - note the **IP / host**, the **port** (usually `65002`) and the **username** (like `u123456789`);
   - **SSH keys** → *Add SSH key* → paste the content of `seed-of-hope-deploy.pub`.
3. Test from your computer:
   ```bash
   ssh -i seed-of-hope-deploy -p 65002 u123456789@HOST "cd domains && ls"
   ```
4. Find the WordPress folders (one per site):
   ```bash
   ssh -i seed-of-hope-deploy -p 65002 u123456789@HOST "ls -d ~/domains/*/public_html"
   ```
   Production is usually `/home/u123456789/domains/<domain>/public_html`; staging is the folder of the
   subdomain (look for the one that contains `wp-config.php`).
5. Check WP-CLI works in each folder:
   ```bash
   ssh -i seed-of-hope-deploy -p 65002 u123456789@HOST "cd /home/u123456789/domains/<domain>/public_html && wp core version"
   ```
6. Get the server's host key (it lets GitHub verify it talks to the right server):
   ```bash
   ssh-keyscan -p 65002 HOST
   ```

## 4. GitHub environments, secrets and variables (Samuel, repo admin)

GitHub → repository → **Settings** → **Environments** → create **`staging`** and **`production`**.

For **production** only: tick **Required reviewers** → add `@Samuel11s`, and in *Deployment branches*
choose **Selected branches** → `main`.

In **each** environment, add these **secrets** (*Environment secrets* → *Add secret*):

| Secret | Value | Example |
| --- | --- | --- |
| `SSH_HOST` | Host or IP shown in hPanel → SSH Access | `145.223.xx.xx` |
| `SSH_PORT` | SSH port | `65002` |
| `SSH_USER` | SSH username | `u123456789` |
| `SSH_PRIVATE_KEY` | The **whole** content of the private key file `seed-of-hope-deploy`, including the `-----BEGIN…` and `-----END…` lines | |
| `SSH_KNOWN_HOSTS` | The output of `ssh-keyscan -p 65002 HOST` (all lines) | |
| `WP_PATH` | Absolute path of the WordPress folder **of this environment** | `/home/u123456789/domains/staging.example.org/public_html` |

And one **variable** (*Environment variables* → *Add variable*):

| Variable | Value |
| --- | --- |
| `WP_URL` | Public URL of the environment, without a trailing slash, e.g. `https://staging.example.org` |

Then **delete the private key from your computer** (it now only lives in GitHub):
`rm seed-of-hope-deploy` — keep the `.pub` file.

> Until these secrets exist, merges on `main` show a yellow warning "Deployment skipped" instead of failing.

## 5. First deployment

1. GitHub → **Actions** → **Deploy** → **Run workflow** → environment `staging`, **dry run ✔** → Run.
   Read the log: rsync lists the files it would send. Nothing is changed.
2. Run it again with dry run unticked.
3. In the staging WordPress admin:
   - **Apparence → Thèmes** → activate **Seed of Hope** (only the first time);
   - **Extensions** → check that **Seed of Hope Core** is active (the workflow activates it);
   - **Réglages → Général** → language **Français**, time zone **Lubumbashi** (Bukavu, UTC+2);
   - **Réglages → Permaliens** → **Titre de la publication**.
4. Create the pages of the site map (or import them, see "Copy the demo pages" below), then
   **Réglages → Lecture** → static front page = *Accueil*, posts page = *Actualités et activités*.
5. Open `WP_URL` on a phone and on a computer.

From now on, **every merge on `main` deploys to staging automatically**.

### Deploy to production
GitHub → Actions → Deploy → Run workflow → `production`. Samuel receives an approval request; once approved,
the same steps run against production. Do it after the client validated the staging site.

### Copy the demo pages (optional, first time only)
The demo content lives in `content/pages/*.html`. To create the same pages on a server:
```bash
scp -P 65002 -i seed-of-hope-deploy -r content scripts u123456789@HOST:~/seed-of-hope-setup/
ssh -p 65002 -i seed-of-hope-deploy u123456789@HOST
cd /home/u123456789/domains/staging.example.org/public_html
# Read scripts/setup.sh first: it also deletes the default themes and sample content.
```
On production, prefer creating pages by hand with the patterns, and only with **validated content**.

## 6. Backups and restore

Hostinger makes **daily automatic backups** (hPanel → Websites → *your site* → **Files → Backups**).

### Before every production deployment or big change
hPanel → **Backups** → *Generate new backup* (or download a database backup). It takes a few minutes.

### Restore
1. hPanel → **Backups**.
2. Choose **Files backups** (code, media) or **Database backups** (pages, settings), and a date.
3. Click **Restore**. For files you can restore a single folder, e.g. `public_html/wp-content/uploads`.
4. Check the site, then tell the team in the issue tracker what was restored and why.

### Our own extra copy (monthly, takes 2 minutes)
```bash
ssh -p 65002 -i <your key> u123456789@HOST "cd /home/u123456789/domains/<domain>/public_html && wp db export ~/backup-$(date +%F).sql && tar czf ~/uploads-$(date +%F).tgz wp-content/uploads"
scp -P 65002 -i <your key> "u123456789@HOST:~/backup-*.sql" "u123456789@HOST:~/uploads-*.tgz" .
```
Store the files in the project's shared drive, never in the Git repository (they contain personal data).

### Roll back a bad deployment
The code is in Git: **revert the faulty PR** on GitHub (*Revert* button on the merged PR), merge the revert PR,
and the Deploy workflow puts the previous version back on staging. For production, run the workflow again.

## 7. Handover to Seed of Hope

1. Give Seed of Hope the **dedicated email account** (they change its password and recovery phone).
2. They log into Hostinger with it, change the password, enable their own 2FA, and replace the payment card
   in **Billing → Payment methods**. Turn auto-renewal on with their card.
3. Create WordPress accounts for their editors with the **Éditeur** role (not Administrateur).
4. Remove FreeDev's WordPress accounts and the deployment SSH key (hPanel → SSH Access → delete key) if
   FreeDev no longer maintains the site; otherwise keep them and document it.
5. Hand over this document and the editor guide (tracked as an M3 issue: how to edit pages, patterns and menus).

## Troubleshooting

| Symptom in the Deploy log | Fix |
| --- | --- |
| `Permission denied (publickey)` | The public key is not added in hPanel → SSH Access, or `SSH_USER` is wrong. |
| `Host key verification failed` | `SSH_KNOWN_HOSTS` is empty or outdated: run `ssh-keyscan -p 65002 HOST` again. |
| `No WordPress found at WP_PATH` | `WP_PATH` must be the folder that contains `wp-config.php`. |
| `wp: command not found` | Contact Hostinger support (WP-CLI is normally preinstalled); the files are deployed anyway. |
| Site shows the old version | hPanel → **Cache Manager** → *Purge all*, then reload with Ctrl+F5. |
