<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://919press.com
 * @since             1.0.0
 * @package           Nine_Ninteen_Tracker
 *
 * @wordpress-plugin
 * Plugin Name:       Tracker
 * Plugin URI:        http://919press.com/tracker
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Dasun Edirisinghe
 * Author URI:        http://919press.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nine-ninteen-tracker
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nine-ninteen-tracker-activator.php
 */
function activate_nine_ninteen_tracker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nine-ninteen-tracker-activator.php';
	Nine_Ninteen_Tracker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nine-ninteen-tracker-deactivator.php
 */
function deactivate_nine_ninteen_tracker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nine-ninteen-tracker-deactivator.php';
	Nine_Ninteen_Tracker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nine_ninteen_tracker' );
register_deactivation_hook( __FILE__, 'deactivate_nine_ninteen_tracker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nine-ninteen-tracker.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nine_ninteen_tracker() {

	$plugin = new Nine_Ninteen_Tracker();
	$plugin->run();

}
run_nine_ninteen_tracker();


add_action('admin_footer-post.php', 'jc_append_post_status_list');


