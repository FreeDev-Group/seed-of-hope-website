<?php
/**
 * Seed of Hope theme setup.
 *
 * The theme only handles presentation. Features (settings, media handling, future
 * content types) live in the seed-of-hope-core plugin so they survive a theme change.
 *
 * @package SeedOfHope
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loads translations and registers editor styles.
 */
function seed_of_hope_setup() {
	load_theme_textdomain( 'seed-of-hope', get_template_directory() . '/languages' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'seed_of_hope_setup' );

/**
 * Enqueues the small stylesheet that complements theme.json.
 */
function seed_of_hope_enqueue_assets() {
	wp_enqueue_style(
		'seed-of-hope',
		get_stylesheet_uri(),
		array(),
		wp_get_theme( 'seed-of-hope' )->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'seed_of_hope_enqueue_assets' );

/**
 * Registers block styles editors can pick in the block sidebar (Styles panel).
 * Their CSS lives in style.css.
 */
function seed_of_hope_register_block_styles() {
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'eyebrow',
			'label' => __( 'Eyebrow label', 'seed-of-hope' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'card',
			'label' => __( 'Card', 'seed-of-hope' ),
		)
	);
}
add_action( 'init', 'seed_of_hope_register_block_styles' );

/**
 * Registers the "Seed of Hope" pattern category used by every theme pattern.
 */
function seed_of_hope_register_pattern_category() {
	register_block_pattern_category(
		'seed-of-hope',
		array(
			'label'       => __( 'Seed of Hope', 'seed-of-hope' ),
			'description' => __( 'Ready-made sections for the Seed of Hope website.', 'seed-of-hope' ),
		)
	);
}
add_action( 'init', 'seed_of_hope_register_pattern_category', 9 );

/**
 * Hides the impact figures pattern unless it is explicitly enabled.
 *
 * Figures must never be invented, so the pattern stays unavailable until Seed of Hope
 * confirms real numbers. The seed-of-hope-core plugin exposes a setting that filters
 * `seed_of_hope_show_impact_pattern`.
 */
function seed_of_hope_maybe_hide_impact_pattern() {
	/**
	 * Filters whether the impact figures pattern is available.
	 *
	 * @param bool $show Whether to register the pattern. Default false.
	 */
	if ( apply_filters( 'seed_of_hope_show_impact_pattern', false ) ) {
		return;
	}

	if ( WP_Block_Patterns_Registry::get_instance()->is_registered( 'seed-of-hope/impact-figures' ) ) {
		unregister_block_pattern( 'seed-of-hope/impact-figures' );
	}
}
add_action( 'init', 'seed_of_hope_maybe_hide_impact_pattern', 20 );

/**
 * Returns the URL of a page by its path, falling back to a pretty URL.
 *
 * Patterns use this so their links keep working if a page ID changes.
 *
 * @param string $path Page path, for example `contact` or `nos-programmes/alphabetisation`.
 * @return string
 */
function seed_of_hope_page_url( $path ) {
	$page = get_page_by_path( $path );

	return $page ? get_permalink( $page ) : home_url( '/' . trailingslashit( $path ) );
}

/**
 * Returns the placeholder shown wherever Seed of Hope still has to provide content.
 *
 * @return string Translated, unescaped placeholder.
 */
function seed_of_hope_tbc() {
	return __( '[To be confirmed by Seed of Hope]', 'seed-of-hope' );
}
