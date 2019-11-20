<?php

/**
 * Plugin Name: MK ToDo
 * Description: Plugin for displaying and managing todo list
 * Version: 1.0
 * Author: Michał Klabisz
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
define( 'MK_TODO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mk-todo-activator.php
 */
function activate_mk_todo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mk-todo-activator.php';
	MK_ToDo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mk-todo-deactivator.php
 */
function deactivate_mk_todo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mk-todo-deactivator.php';
	MK_ToDo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mk_todo' );
register_deactivation_hook( __FILE__, 'deactivate_mk_todo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mk-todo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mk_todo() {

	$plugin = new MK_ToDo();
	$plugin->run();

}
run_mk_todo();
