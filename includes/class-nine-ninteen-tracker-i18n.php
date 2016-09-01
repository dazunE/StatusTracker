<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://919press.com
 * @since      1.0.0
 *
 * @package    Nine_Ninteen_Tracker
 * @subpackage Nine_Ninteen_Tracker/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nine_Ninteen_Tracker
 * @subpackage Nine_Ninteen_Tracker/includes
 * @author     Dasun Edirisinghe <dazunj4me@gmail.com>
 */
class Nine_Ninteen_Tracker_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nine-ninteen-tracker',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
