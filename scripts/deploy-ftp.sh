#!/usr/bin/env bash
# Uploads our code (theme, core plugin, mu-plugins) to the hosting over FTPS with lftp.
# Used by .github/workflows/deploy.yml; can also be run by hand from Git Bash / Linux / macOS.
#
# Required environment variables:
#   FTP_HOST      FTP hostname, e.g. seedofhopebukavu.org (no "ftp://")
#   FTP_USER      FTP username shown in hPanel
#   FTP_PASSWORD  FTP password (never commit it; GitHub secret in CI)
#   FTP_PATH      WordPress root seen from the FTP account, e.g. public_html
# Optional:
#   DRY_RUN=1            show what would change, upload nothing
#   FTP_TLS=0            plain FTP (local tests only — never for the real server)
#   FTP_VERIFY_CERT=no   accept a certificate whose name does not match FTP_HOST
#
# Only our folders are touched. WordPress core, wp-config.php, the database and uploads are never sent
# or deleted: --delete only applies inside our theme and plugin folders.
set -euo pipefail

: "${FTP_HOST:?Set FTP_HOST}"
: "${FTP_USER:?Set FTP_USER}"
: "${FTP_PASSWORD:?Set FTP_PASSWORD}"
: "${FTP_PATH:?Set FTP_PATH}"

command -v lftp >/dev/null || { echo "lftp is not installed (apt-get install lftp / brew install lftp)" >&2; exit 1; }

host="${FTP_HOST#ftp://}"
host="${host%/}"
root="${FTP_PATH%/}"
dry=""
[ "${DRY_RUN:-0}" = "1" ] && dry="--dry-run" && echo "DRY RUN: nothing will be uploaded or deleted."

if [ "${FTP_TLS:-1}" = "1" ]; then tls=true; else tls=false; fi

# lftp reads the password from LFTP_PASSWORD (--env-password), so it never appears in the command line.
export LFTP_PASSWORD="$FTP_PASSWORD"

lftp <<EOF
set cmd:fail-exit yes
set net:max-retries 3
set net:timeout 30
set net:reconnect-interval-base 5
set ftp:ssl-allow $tls
set ftp:ssl-force $tls
set ftp:ssl-protect-data $tls
set ftp:passive-mode true
set ssl:verify-certificate ${FTP_VERIFY_CERT:-yes}
open --env-password -u "$FTP_USER" "$host"

# Safety check: refuse to deploy anywhere that is not a WordPress root.
cls -1 "$root/wp-config.php"

mirror --reverse --delete --verbose --parallel=4 $dry wp-content/themes/seed-of-hope "$root/wp-content/themes/seed-of-hope"
mirror --reverse --delete --verbose --parallel=4 $dry wp-content/plugins/seed-of-hope-core "$root/wp-content/plugins/seed-of-hope-core"

# mu-plugins: only our files, never --delete (the host may keep its own must-use plugins here).
mirror --reverse --verbose $dry --include-glob '*.php' wp-content/mu-plugins "$root/wp-content/mu-plugins"
bye
EOF

echo "Deployment finished${dry:+ (dry run)}."
