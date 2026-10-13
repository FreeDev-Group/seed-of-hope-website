<?php
/**
 * Title: Contact details
 * Slug: seed-of-hope/contact
 * Categories: seed-of-hope, contact
 * Keywords: contact, address, phone, email, hours
 * Description: Official contact details. Publish only details confirmed by Seed of Hope.
 *
 * @package SeedOfHope
 */

$seed_of_hope_contact_items = array(
	__( 'Address', 'seed-of-hope' ),
	__( 'Phone', 'seed-of-hope' ),
	__( 'Email', 'seed-of-hope' ),
	__( 'Opening hours', 'seed-of-hope' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'How to reach us', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The official contact details will be published once they are confirmed by Seed of Hope.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"14rem"}} -->
<div class="wp-block-group alignwide">
<?php foreach ( $seed_of_hope_contact_items as $seed_of_hope_contact_item ) : ?>
<!-- wp:group {"style":{"border":{"radius":"0.75rem"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
<div class="wp-block-group has-surface-background-color has-background" style="border-radius:0.75rem;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo esc_html( $seed_of_hope_contact_item ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"seed-of-hope-tbc"} -->
<p class="seed-of-hope-tbc"><?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Social media:', 'seed-of-hope' ); ?></strong> <?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
