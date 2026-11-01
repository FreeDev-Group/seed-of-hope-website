<?php
/**
 * Title: Footer
 * Slug: seed-of-hope/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 * Description: Site identity, contact placeholders and quick links.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40)">
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:site-title {"level":0} /-->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Adult literacy and vocational training. A ministry of LePhare.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Contact', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Address:', 'seed-of-hope' ); ?></strong> <?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Phone:', 'seed-of-hope' ); ?></strong> <?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Email:', 'seed-of-hope' ); ?></strong> <?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Quick links', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list">
<!-- wp:list-item -->
<li><a href="<?php echo esc_url( seed_of_hope_page_url( 'nos-programmes' ) ); ?>"><?php esc_html_e( 'Our programmes', 'seed-of-hope' ); ?></a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( seed_of_hope_page_url( 'actualites' ) ); ?>"><?php esc_html_e( 'News and activities', 'seed-of-hope' ); ?></a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( seed_of_hope_page_url( 'soutenir' ) ); ?>"><?php esc_html_e( 'Support the ministry', 'seed-of-hope' ); ?></a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( seed_of_hope_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'seed-of-hope' ); ?></a></li>
<!-- /wp:list-item -->
</ul>
<!-- /wp:list -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide","backgroundColor":"accent","className":"is-style-wide"} -->
<hr class="wp-block-separator alignwide has-text-color has-accent-color has-alpha-channel-opacity has-accent-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size">
<?php
/* translators: %s: current year. */
echo esc_html( sprintf( __( '© %s Seed of Hope — Semence d’Espoir', 'seed-of-hope' ), gmdate( 'Y' ) ) );
?>
</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
