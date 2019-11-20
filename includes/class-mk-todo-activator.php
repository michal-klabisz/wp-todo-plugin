<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    MK_ToDo
 * @subpackage MK_ToDo/includes
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */
class MK_ToDo_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		MK_ToDo_List::register();
	}

}
