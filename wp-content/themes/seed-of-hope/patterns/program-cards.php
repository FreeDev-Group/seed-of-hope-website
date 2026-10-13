<?php
/**
 * Title: Programme cards
 * Slug: seed-of-hope/program-cards
 * Categories: seed-of-hope
 * Keywords: programmes, literacy, vocational training, cards
 * Description: Two cards linking to the literacy and vocational training pages.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Our programmes', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'Seed of Hope offers literacy and vocational training for adults.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"0.75rem","top":{"color":"var:preset|color|primary","style":"solid","width":"6px"}},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group has-base-background-color has-background" style="border-radius:0.75rem;border-top-color:var(--wp--preset--color--primary);border-top-style:solid;border-top-width:6px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Literacy', 'seed-of-hope' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Learn to read and write, and strengthen basic skills that are useful in daily, social and working life.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"seed-of-hope-tbc"} -->
<p class="seed-of-hope-tbc"><?php esc_html_e( '[Levels, schedule and location to be confirmed by Seed of Hope]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'nos-programmes/alphabetisation' ) ); ?>"><?php esc_html_e( 'Discover the literacy programme', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"0.75rem","top":{"color":"var:preset|color|secondary","style":"solid","width":"6px"}},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group has-base-background-color has-background" style="border-radius:0.75rem;border-top-color:var(--wp--preset--color--secondary);border-top-style:solid;border-top-width:6px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Vocational training', 'seed-of-hope' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Build practical and professional skills through training and workshops.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"seed-of-hope-tbc"} -->
<p class="seed-of-hope-tbc"><?php esc_html_e( '[Training tracks and workshops to be confirmed by Seed of Hope]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'nos-programmes/formation-professionnelle' ) ); ?>"><?php esc_html_e( 'Discover vocational training', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
