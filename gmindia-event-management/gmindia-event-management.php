<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://gmindia.tech
 * @since             1.0.0
 * @package           Gmindia_Event_Management
 *
 * @wordpress-plugin
 * Plugin Name:       GMIndia Event Management
 * Plugin URI:        https://gmindia.tech
 * Description:       This plugin is designed for managing custom post types related to events. It allows users to create, organize, and display events on their WordPress website through a customizable interface.Additionally, it provides features for managing event details, such as dates, times, locations, and descriptions, making it a comprehensive solution for event management within WordPress.
 * Version:           1.0.0
 * Author:            vishnu kumar, Mohamed Jasim
 * Author URI:        https://gmindia.tech/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gmindia-event-management
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GMINDIA_EVENT_MANAGEMENT_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gmindia-event-management-activator.php
 */
function activate_gmindia_event_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gmindia-event-management-activator.php';
	Gmindia_Event_Management_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gmindia-event-management-deactivator.php
 */
function deactivate_gmindia_event_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gmindia-event-management-deactivator.php';
	Gmindia_Event_Management_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gmindia_event_management' );
register_deactivation_hook( __FILE__, 'deactivate_gmindia_event_management' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gmindia-event-management.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gmindia_event_management() {

	$plugin = new Gmindia_Event_Management();
	$plugin->run();

}
run_gmindia_event_management();