<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://gmindia.tech
 * @since      1.0.0
 *
 * @package    Gmindia_Event_Management
 * @subpackage Gmindia_Event_Management/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Gmindia_Event_Management
 * @subpackage Gmindia_Event_Management/includes
 * @author     vishnu kumar <vk.asokan@gmindia.tech>
 */
class Gmindia_Event_Management_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'gmindia-event-management',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
