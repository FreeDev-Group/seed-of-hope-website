<?php
/**
 * Title: Call to action
 * Slug: seed-of-hope/call-to-action
 * Categories: seed-of-hope, call-to-action
 * Keywords: contact, get involved, volunteer, support, cta
 * Description: Invitation to contact the team or to support the ministry.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Would you like to learn, volunteer or work with us?', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"><?php esc_html_e( 'Contact the Seed of Hope team with your questions. Everyone is welcome.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"base","textColor":"primary-dark"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-dark-color has-base-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact us', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"base","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-color has-text-color wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'soutenir' ) ); ?>"><?php esc_html_e( 'Support the ministry', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
