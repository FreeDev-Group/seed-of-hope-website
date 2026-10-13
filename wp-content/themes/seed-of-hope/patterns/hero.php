<?php
/**
 * Title: Hero
 * Slug: seed-of-hope/hero
 * Categories: seed-of-hope, banner
 * Keywords: hero, banner, welcome, intro
 * Description: Opening section of the home page with the main heading (h1) and two calls to action. Use it once, at the top of the home page.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"primary-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-soft-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
<!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
<!-- wp:paragraph {"textColor":"secondary","fontSize":"large"} -->
<p class="has-secondary-color has-text-color has-large-font-size"><strong><?php esc_html_e( 'A ministry of LePhare', 'seed-of-hope' ); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Seed of Hope — Semence d’Espoir', 'seed-of-hope' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><?php esc_html_e( 'Adult literacy and vocational training: learning to read, to write and to build practical skills, at every stage of life.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"seed-of-hope-tbc"} -->
<p class="seed-of-hope-tbc"><?php esc_html_e( '[Welcome message to be confirmed by Seed of Hope]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'nos-programmes' ) ); ?>"><?php esc_html_e( 'Discover our programmes', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"primary-dark","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-dark-color has-text-color wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact us', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/seedling.svg' ); ?>" alt=""/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
