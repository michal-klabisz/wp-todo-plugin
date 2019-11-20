<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/public
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */
class MK_ToDo_Public {

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
	 * @param      string    $mk_todo       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $mk_todo, $version ) {

		$this->mk_todo = $mk_todo;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->mk_todo, plugin_dir_url( __FILE__ ) . 'css/mk-todo-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->mk_todo, plugin_dir_url( __FILE__ ) . 'js/mk-todo-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers todo widget
	 *
	 * @since    1.0.0
	 */
	public function add_widget() {

		register_widget( 'MK_ToDo_Widget' );

	}

	/**
	 * Registers [mk-todo] shortcode
	 *
	 * @since    1.0.0
	 */
	public function add_shortcode() {

		add_shortcode( 'mk-todo', array( $this, 'display_shortcode') );

	}

	/**
	 * Displays [mk-todo] shortcode
	 *
	 * @since    1.0.0
	 */
	public function display_shortcode() {
		ob_start();
			require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/mk-todo-public-display.php';
		$content = ob_get_clean();

		return $content;
	}



}
