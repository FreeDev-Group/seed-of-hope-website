<?php
/**
 * Title: Partner logos
 * Slug: seed-of-hope/partner-logos
 * Categories: seed-of-hope
 * Keywords: partners, logos, sponsors
 * Description: Grid of partner logos. Replace each box with an Image block and use the partner's name as alternative text.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Our partners', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"seed-of-hope-tbc"} -->
<p class="has-text-align-center seed-of-hope-tbc"><?php esc_html_e( '[Confirmed partners to be listed by Seed of Hope, with their permission to show their logo]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"12rem"}} -->
<div class="wp-block-group alignwide">
<?php for ( $seed_of_hope_i = 0; $seed_of_hope_i < 4; $seed_of_hope_i++ ) : ?>
<!-- wp:group {"style":{"border":{"radius":"0.75rem","color":"var:preset|color|contrast-muted","style":"dashed","width":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color" style="border-color:var(--wp--preset--color--contrast-muted);border-style:dashed;border-width:2px;border-radius:0.75rem;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"align":"center","textColor":"contrast-muted"} -->
<p class="has-text-align-center has-contrast-muted-color has-text-color"><?php esc_html_e( '[Partner logo]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endfor; ?>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
