<?php
/**
 * Removes the plugin's options when it is deleted from the Plugins screen.
 *
 * @package SeedOfHope\Core
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'sohc_show_impact_pattern' );
