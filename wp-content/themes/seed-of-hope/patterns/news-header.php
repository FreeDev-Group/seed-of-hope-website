<?php
/**
 * Title: News page header
 * Slug: seed-of-hope/news-header
 * Inserter: no
 * Description: Title and introduction of the news page (the WordPress posts page).
 *
 * @package SeedOfHope
 */

$seed_of_hope_posts_page = (int) get_option( 'page_for_posts' );
$seed_of_hope_news_title = $seed_of_hope_posts_page ? get_the_title( $seed_of_hope_posts_page ) : __( 'News and activities', 'seed-of-hope' );
?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html( $seed_of_hope_news_title ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Announcements, events, workshops and news from the ministry.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
