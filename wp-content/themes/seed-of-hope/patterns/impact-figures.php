<?php
/**
 * Title: Impact figures
 * Slug: seed-of-hope/impact-figures
 * Categories: seed-of-hope
 * Keywords: impact, figures, numbers, statistics
 * Description: Three key figures. Disabled by default: enable it in Settings > Reading only once Seed of Hope has confirmed real figures.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"primary-dark","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-color has-primary-dark-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Our impact', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"seed-of-hope-tbc"} -->
<p class="has-text-align-center seed-of-hope-tbc"><?php esc_html_e( '[Figures to be confirmed by Seed of Hope before publication]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
<?php for ( $seed_of_hope_i = 0; $seed_of_hope_i < 3; $seed_of_hope_i++ ) : ?>
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700"}},"fontSize":"xxx-large"} -->
<p class="has-text-align-center has-xxx-large-font-size" style="font-weight:700"><?php esc_html_e( '[Figure]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( '[What this figure measures, and for which period]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<?php endfor; ?>
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
