<?php

/**
 * Class for managing ajax requests
 *
 * @since      1.0.0
 * @package    MK_ToDo
 * @subpackage MK_ToDo/includes
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */

class MK_ToDo_Ajax {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $mk_todo    The ID of this plugin.
	 */
	private $mk_todo;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $mk_todo       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $mk_todo, $version ) {

		$this->mk_todo = $mk_todo;
		$this->version = $version;

	}

    public function add_new_todo() {
		$new_name = isset($_POST["mk_todo_name"]) ? $_POST["mk_todo_name"] : false;
		$new_value = isset($_POST["mk_todo_value"]) ? $_POST["mk_todo_value"] : 0;

		if ($new_name) {
			echo intval( MK_ToDo_List::add( $new_name, $new_value ) );
		} else {
			echo "0";
		}

        wp_die();
    }

	public function update_todo_value() {
		$name = isset($_POST["mk_todo_name"]) ? $_POST["mk_todo_name"] : false;
		$new_value = isset($_POST["mk_todo_value"]) ? $_POST["mk_todo_value"] : 0;

		if ($name) {
			echo intval( MK_ToDo_List::update( $name, $new_value ) );
		} else {
			echo "0";
		}

        wp_die();
    }

	public function update_todo_name() {
		$existing_name = isset($_POST["mk_todo_existing_name"]) ? $_POST["mk_todo_existing_name"] : false;
		$new_name = isset($_POST["mk_todo_new_name"]) ? $_POST["mk_todo_new_name"] : false;

		if ($existing_name && $new_name) {
			echo intval( MK_ToDo_List::rename( $existing_name, $new_name ) );
		} else {
			echo "0";
		}

        wp_die();
    }

	public function remove_todo() {
		$name = isset($_POST["mk_todo_name"]) ? $_POST["mk_todo_name"] : false;

		if ($name) {
			echo intval( MK_ToDo_List::remove( $name ) );
		} else {
			echo "0";
		}

        wp_die();
    }

}
