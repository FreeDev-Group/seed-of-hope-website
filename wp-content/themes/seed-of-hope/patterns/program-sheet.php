<?php
/**
 * Title: Programme sheet
 * Slug: seed-of-hope/program-sheet
 * Categories: seed-of-hope
 * Keywords: programme, sheet, details, objectives, prerequisites, duration
 * Description: Structured programme details: name, objectives, audience, prerequisites, duration, location, conditions and contact.
 *
 * @package SeedOfHope
 */

$seed_of_hope_fields = array(
	__( 'Objectives', 'seed-of-hope' ),
	__( 'Who is it for?', 'seed-of-hope' ),
	__( 'Prerequisites', 'seed-of-hope' ),
	__( 'Duration and schedule', 'seed-of-hope' ),
	__( 'Location', 'seed-of-hope' ),
	__( 'Conditions to take part', 'seed-of-hope' ),
	__( 'Contact person', 'seed-of-hope' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( '[Programme name — to be confirmed by Seed of Hope]', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"seed-of-hope-tbc"} -->
<p class="seed-of-hope-tbc"><?php esc_html_e( '[Short description of the programme — to be confirmed by Seed of Hope]', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group alignwide">
<?php foreach ( $seed_of_hope_fields as $seed_of_hope_field ) : ?>
<!-- wp:group {"style":{"border":{"radius":"0.75rem"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
<div class="wp-block-group has-surface-background-color has-background" style="border-radius:0.75rem;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo esc_html( $seed_of_hope_field ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"seed-of-hope-tbc"} -->
<p class="seed-of-hope-tbc"><?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"textColor":"contrast-muted","fontSize":"small"} -->
<p class="has-contrast-muted-color has-text-color has-small-font-size"><?php esc_html_e( 'Information on this page is published only after confirmation by Seed of Hope. No diploma, job or result is guaranteed without an official basis.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( seed_of_hope_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Ask for information', 'seed-of-hope' ); ?></a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
