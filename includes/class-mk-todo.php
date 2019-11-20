<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    MK_ToDo
 * @subpackage MK_ToDo/includes
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */
class MK_ToDo {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      MK_ToDo_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $mk_todo    The string used to uniquely identify this plugin.
	 */
	protected $mk_todo;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MK_TODO_VERSION' ) ) {
			$this->version = MK_TODO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->mk_todo = 'mk-todo';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - MK_ToDo_Loader. Orchestrates the hooks of the plugin.
	 * - MK_ToDo_i18n. Defines internationalization functionality.
	 * - MK_ToDo_Admin. Defines all hooks for the admin area.
	 * - MK_ToDo_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mk-todo-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mk-todo-i18n.php';

		/**
		 * The class responsible for managing todo list state
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mk-todo-list.php';

		/**
		 * The class responsible for defining ajax requests
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mk-todo-ajax.php';

		/**
		 * The widget class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mk-todo-widget.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mk-todo-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mk-todo-public.php';

		$this->loader = new MK_ToDo_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the MK_ToDo_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new MK_ToDo_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_ajax = new MK_ToDo_Ajax( $this->get_mk_todo(), $this->get_version() );
		$plugin_admin = new MK_ToDo_Admin( $this->get_mk_todo(), $this->get_version() );

		$this->loader->add_action( 'wp_ajax_mk_todo_add_new', $plugin_ajax, 'add_new_todo' );
		$this->loader->add_action( 'wp_ajax_mk_todo_update_value', $plugin_ajax, 'update_todo_value' );
		$this->loader->add_action( 'wp_ajax_mk_todo_update_name', $plugin_ajax, 'update_todo_name' );
		$this->loader->add_action( 'wp_ajax_mk_todo_remove', $plugin_ajax, 'remove_todo' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_to_menu' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new MK_ToDo_Public( $this->get_mk_todo(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_public, 'add_shortcode' );
		$this->loader->add_action( 'widgets_init', $plugin_public, 'add_widget' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_mk_todo() {
		return $this->mk_todo;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    MK_ToDo_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
