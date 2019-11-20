<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/admin
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */
class MK_ToDo_Admin {

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

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->mk_todo, plugin_dir_url( __FILE__ ) . 'css/mk-todo-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->mk_todo, plugin_dir_url( __FILE__ ) . 'js/mk-todo-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register menu entry for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function add_to_menu() {
		add_menu_page ( __( 'MK ToDo Settings Page', 'mk-todo' ),  __( 'MK ToDo Settings', 'mk-todo' ),  'administrator', 'mk-todo-settings', array($this,'display_settings_page'), 'dashicons-editor-ul' );
    }

	/**
	 * Displays
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page() {
		/**
		 * Display admin settings view for the plugin
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/mk-todo-admin-display.php';
	}

}
