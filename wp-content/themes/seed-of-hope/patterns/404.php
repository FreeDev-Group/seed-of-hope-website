<?php
/**
 * Title: Page not found
 * Slug: seed-of-hope/404
 * Inserter: no
 * Description: Friendly message, search form and way back for the 404 template.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Page not found', 'seed-of-hope' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'This page does not exist or has moved. You can search the site or go back to the home page.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_attr( _x( 'Search', 'search form label', 'seed-of-hope' ) ); ?>","buttonText":"<?php echo esc_attr( _x( 'Search', 'search button text', 'seed-of-hope' ) ); ?>"} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the home page', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
