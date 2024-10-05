<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://robertdevore.com
 * @since             1.0.0
 * @package           WordPlay
 *
 * @wordpress-plugin
 * Plugin Name:       WordPlay
 * Plugin URI:        https://robertdevore.com/say-hello-to-wordplay/
 * Description:       Putting the FUN back in dysFUNctional. Display memes about WordPress and it's post-economic owner in your dashboard, in a widget or via a shortcode.
 * Version:           1.0.0
 * Author:            Robert DeVore
 * Author URI:        https://robertdevore.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       WordPlay
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'WORDPLAY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordplay-activator.php
 */
function activate_wordplay() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordplay-activator.php';
	wordplay_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordplay-deactivator.php
 */
function deactivate_wordplay() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordplay-deactivator.php';
	wordplay_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordplay' );
register_deactivation_hook( __FILE__, 'deactivate_wordplay' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordplay.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordplay() {

	$plugin = new WordPlay();
	$plugin->run();

}
run_wordplay();
