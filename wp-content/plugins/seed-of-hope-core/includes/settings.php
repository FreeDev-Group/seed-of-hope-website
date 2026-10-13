<?php
/**
 * Site settings editable by non-developers (Settings > Reading).
 *
 * @package SeedOfHope\Core
 */

namespace SeedOfHope\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OPTION_SHOW_IMPACT = 'sohc_show_impact_pattern';

/**
 * Registers the settings. Runs on `init` so they also exist for the REST API.
 */
function register_settings() {
	register_setting(
		'reading',
		OPTION_SHOW_IMPACT,
		array(
			'type'              => 'boolean',
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\register_settings' );

/**
 * Adds the "show impact figures" checkbox to the Reading screen.
 */
function add_settings_fields() {
	add_settings_field(
		OPTION_SHOW_IMPACT,
		__( 'Impact figures', 'seed-of-hope-core' ),
		__NAMESPACE__ . '\render_impact_field',
		'reading'
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\add_settings_fields' );

/**
 * Prints the checkbox for the impact figures setting.
 */
function render_impact_field() {
	printf(
		'<label><input type="checkbox" name="%1$s" value="1" %2$s> %3$s</label><p class="description">%4$s</p>',
		esc_attr( OPTION_SHOW_IMPACT ),
		checked( (bool) get_option( OPTION_SHOW_IMPACT, false ), true, false ),
		esc_html__( 'Make the "Impact figures" pattern available in the editor', 'seed-of-hope-core' ),
		esc_html__( 'Enable this only when Seed of Hope has confirmed real figures. Never publish estimated or invented numbers.', 'seed-of-hope-core' )
	);
}

/*
 * The theme hides the impact pattern by default and asks this filter.
 */
add_filter(
	'seed_of_hope_show_impact_pattern',
	static function () {
		return (bool) get_option( OPTION_SHOW_IMPACT, false );
	}
);
