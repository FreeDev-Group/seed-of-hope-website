#!/bin/sh
# Installs and configures the local WordPress site. Runs inside the WP-CLI container:
#   npm run setup   (= docker compose up -d --wait && docker compose run --rm cli sh /scripts/setup.sh)
# Safe to run again: every step is idempotent and demo pages are updated in place.
set -eu

CONTENT_DIR=/content
WP_URL="${WP_URL:-http://localhost:8888}"

log() { printf '\n\033[1;32m==> %s\033[0m\n' "$*"; }

log "Installing WordPress"
if ! wp core is-installed 2>/dev/null; then
	wp core install \
		--url="$WP_URL" \
		--title="Seed of Hope — Semence d'Espoir" \
		--admin_user="$WP_ADMIN_USER" \
		--admin_password="$WP_ADMIN_PASSWORD" \
		--admin_email="$WP_ADMIN_EMAIL" \
		--skip-email
else
	echo "Already installed."
fi

# From here on, act as the admin so that content keeps its full block markup (unfiltered_html).
wp() { command wp --user="$WP_ADMIN_USER" "$@"; }

log "Language, time zone and permalinks"
wp language core is-installed fr_FR || wp language core install fr_FR
wp site switch-language fr_FR
wp option update blogdescription "Alphabétisation et formation professionnelle pour adultes"
wp option update timezone_string "Africa/Lubumbashi"   # Bukavu, DRC (UTC+2)
wp option update date_format "j F Y"
wp option update blog_public 0                         # Local site: never indexed.
wp rewrite structure '/%postname%/'

log "Theme and plugins"
wp theme activate seed-of-hope
wp plugin activate seed-of-hope-core
wp plugin delete akismet hello 2>/dev/null || true
for theme in $(wp theme list --status=inactive --field=name); do
	wp theme delete "$theme"
done

log "Removing WordPress sample content"
for slug in hello-world sample-page; do
	id=$(wp post list --post_type=post,page --name="$slug" --field=ID --post_status=any)
	[ -n "$id" ] && wp post delete "$id" --force
done

# upsert_page <slug> <title> <parent-id or 0> <menu-order>
# Prints the page ID. Creates the page or refreshes its content from content/pages/<slug>.html.
upsert_page() {
	slug="$1"; title="$2"; parent="$3"; order="$4"
	file="$CONTENT_DIR/pages/$slug.html"
	id=$(wp post list --post_type=page --name="$slug" --post_status=any --field=ID | head -n1)
	if [ -z "$id" ]; then
		id=$(wp post create "$file" --post_type=page --post_status=publish --post_title="$title" \
			--post_name="$slug" --post_parent="$parent" --menu_order="$order" --porcelain)
	else
		wp post update "$id" "$file" --post_title="$title" --post_parent="$parent" --menu_order="$order" --post_status=publish >/dev/null
	fi
	echo "$id"
}

log "Importing the demo pages (one per page of the validated site map)"
HOME_ID=$(upsert_page accueil "Accueil" 0 1)
ABOUT_ID=$(upsert_page a-propos "À propos" 0 2)
PROGRAMS_ID=$(upsert_page nos-programmes "Nos programmes" 0 3)
LITERACY_ID=$(upsert_page alphabetisation "Alphabétisation" "$PROGRAMS_ID" 1)
VOCATIONAL_ID=$(upsert_page formation-professionnelle "Formation professionnelle" "$PROGRAMS_ID" 2)
NEWS_ID=$(upsert_page actualites "Actualités et activités" 0 4)
TESTIMONIALS_ID=$(upsert_page temoignages "Témoignages et réalisations" 0 5)
PARTNERS_ID=$(upsert_page partenaires "Partenaires" 0 6)
SUPPORT_ID=$(upsert_page soutenir "Soutenir le ministère" 0 7)
CONTACT_ID=$(upsert_page contact "Contact" 0 8)
wp post list --post_type=page --fields=ID,post_title,post_name,post_parent --orderby=menu_order --order=asc

log "Front page and posts page"
wp option update show_on_front page
wp option update page_on_front "$HOME_ID"
wp option update page_for_posts "$NEWS_ID"

log "Example news posts (clearly marked as examples)"
wp term list category --slug=activites --field=term_id | grep -q . || wp term create category "Activités" --slug=activites
for n in 1 2; do
	slug="exemple-actualite-$n"
	if [ -z "$(wp post list --post_type=post --name="$slug" --field=ID)" ]; then
		wp post create "$CONTENT_DIR/posts-exemple-$n.html" --post_type=post --post_status=publish \
			--post_title="Exemple d’actualité $n [À remplacer]" --post_name="$slug" \
			--post_category=activites --post_excerpt="Article d’exemple à remplacer par une actualité validée par Seed of Hope." >/dev/null
	fi
done

page_url() { wp eval "echo get_permalink( $1 );"; }

# nav_link <label> <page-id>
nav_link() {
	printf '<!-- wp:navigation-link {"label":"%s","type":"page","id":%s,"url":"%s","kind":"post-type"} /-->' \
		"$1" "$2" "$(page_url "$2")"
}

log "Navigation menus"
PRIMARY_NAV="$(nav_link "Accueil" "$HOME_ID")$(nav_link "À propos" "$ABOUT_ID")<!-- wp:navigation-submenu {\"label\":\"Programmes\",\"type\":\"page\",\"id\":$PROGRAMS_ID,\"url\":\"$(page_url "$PROGRAMS_ID")\",\"kind\":\"post-type\"} -->$(nav_link "Nos programmes" "$PROGRAMS_ID")$(nav_link "Alphabétisation" "$LITERACY_ID")$(nav_link "Formation professionnelle" "$VOCATIONAL_ID")<!-- /wp:navigation-submenu -->$(nav_link "Actualités" "$NEWS_ID")$(nav_link "Témoignages" "$TESTIMONIALS_ID")$(nav_link "Partenaires" "$PARTNERS_ID")$(nav_link "Nous soutenir" "$SUPPORT_ID")$(nav_link "Contact" "$CONTACT_ID")"

NAV_ID=$(wp post list --post_type=wp_navigation --name=menu-principal --field=ID | head -n1)
if [ -z "$NAV_ID" ]; then
	wp post create --post_type=wp_navigation --post_status=publish --post_title="Menu principal" \
		--post_name=menu-principal --post_content="$PRIMARY_NAV" --porcelain
else
	wp post update "$NAV_ID" --post_content="$PRIMARY_NAV" >/dev/null
fi

wp rewrite flush
wp cache flush >/dev/null

log "Done. Site: $WP_URL — admin: $WP_URL/wp-admin/ (credentials: see .env.example)"
