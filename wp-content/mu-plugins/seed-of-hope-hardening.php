<?php
/**
 * Plugin Name: Seed of Hope Hardening
 * Description: Basic security hardening that must stay active whatever the theme or plugins: no XML-RPC, no version leak, no anonymous user enumeration.
 * Version:     0.1.0
 * Author:      FreeDev-Group
 * License:     GPL-2.0-or-later
 *
 * Must-use plugin: WordPress loads it automatically and it cannot be deactivated from the admin.
 *
 * @package SeedOfHope
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// XML-RPC is a common brute-force target and the site does not use it.
add_filter( 'xmlrpc_enabled', '__return_false' );

// Do not advertise the WordPress version.
remove_action( 'wp_head', 'wp_generator' );

/**
 * Hides the users endpoints of the REST API from anonymous visitors.
 *
 * @param array $endpoints Registered REST routes.
 * @return array
 */
function seed_of_hope_hide_user_endpoints( $endpoints ) {
	if ( is_user_logged_in() ) {
		return $endpoints;
	}

	unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );

	return $endpoints;
}
add_filter( 'rest_endpoints', 'seed_of_hope_hide_user_endpoints' );

/**
 * Stops `?author=1` scans from revealing usernames through redirects.
 */
function seed_of_hope_block_author_scans() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only check on a public query var.
	if ( ! is_admin() && isset( $_GET['author'] ) && ! is_user_logged_in() ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'seed_of_hope_block_author_scans', 1 );
