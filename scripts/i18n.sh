#!/bin/sh
# Regenerates the translation templates (.pot), merges new strings into the existing
# .po files and compiles .mo / .l10n.php files. Runs inside the WP-CLI container:
#   npm run i18n
# Translate new strings in the .po files (Poedit, or any text editor), then run it again.
set -eu

cd /var/www/html/wp-content

THEME=themes/seed-of-hope
PLUGIN=plugins/seed-of-hope-core

wp i18n make-pot "$THEME" "$THEME/languages/seed-of-hope.pot" \
	--domain=seed-of-hope --exclude=assets --headers='{"Report-Msgid-Bugs-To":"https://github.com/FreeDev-Group/seed-of-hope-website/issues"}'
wp i18n make-pot "$PLUGIN" "$PLUGIN/languages/seed-of-hope-core.pot" \
	--domain=seed-of-hope-core --headers='{"Report-Msgid-Bugs-To":"https://github.com/FreeDev-Group/seed-of-hope-website/issues"}'

for dir in "$THEME/languages" "$PLUGIN/languages"; do
	if ls "$dir"/*.po >/dev/null 2>&1; then
		wp i18n update-po "$dir"/*.pot "$dir"
		wp i18n make-mo "$dir"
		wp i18n make-php "$dir"
	fi
done
