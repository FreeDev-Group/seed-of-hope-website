<?php
/**
 * Title: Testimonial
 * Slug: seed-of-hope/testimonial
 * Categories: seed-of-hope, testimonials
 * Keywords: testimonial, quote, story, consent
 * Description: A testimonial with a visible consent statement. Publish only with the written consent of the person quoted.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"gradient":"dawn","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-dawn-gradient-background has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Testimonial', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:quote -->
<blockquote class="wp-block-quote">
<!-- wp:paragraph -->
<p><?php esc_html_e( '[Testimonial to be provided by Seed of Hope, with the written consent of the person quoted]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
<cite><?php esc_html_e( '[First name and programme — to be confirmed]', 'seed-of-hope' ); ?></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph {"textColor":"contrast-muted","fontSize":"small"} -->
<p class="has-contrast-muted-color has-text-color has-small-font-size"><?php esc_html_e( 'Consent: this testimonial is published only with the written consent of the person quoted.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
