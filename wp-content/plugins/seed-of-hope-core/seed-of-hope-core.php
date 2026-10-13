<?php
/**
 * Plugin Name:       Seed of Hope Core
 * Plugin URI:        https://github.com/FreeDev-Group/seed-of-hope-website
 * Description:       Site features for Seed of Hope / Semence d'Espoir that must not depend on the theme: settings, media optimisation and front-end clean-up.
 * Version:           0.1.0
 * Requires at least: 6.6
 * Requires PHP:      8.1
 * Author:            FreeDev-Group
 * Author URI:        https://github.com/FreeDev-Group
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       seed-of-hope-core
 * Domain Path:       /languages
 *
 * @package SeedOfHope\Core
 */

namespace SeedOfHope\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const VERSION = '0.1.0';

require_once __DIR__ . '/includes/settings.php';
require_once __DIR__ . '/includes/media.php';
require_once __DIR__ . '/includes/performance.php';

/**
 * Loads the plugin translations.
 */
function load_textdomain() {
	load_plugin_textdomain( 'seed-of-hope-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', __NAMESPACE__ . '\load_textdomain', 1 );
