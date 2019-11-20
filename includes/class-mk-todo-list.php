<?php

/**
 * Class for managing todo list state
 *
 * @since      1.0.0
 * @package    MK_ToDo
 * @subpackage MK_ToDo/includes
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */

class MK_ToDo_List {

    private static $todo_options_name = 'mk-todo-list';

	/**
	 * ToDo list
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $todos    todos list array
	 */
	protected static $todos = array();

	/**
	 * Removes data from wp database
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public static function unregister() {
		delete_option( self::$todo_options_name );
	}

	/**
	 * Add todo list option to wp database
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public static function register() {
		add_option( self::$todo_options_name, array() );
	}

	/**
	 * Get array with all todo elements
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public static function get_list() {
        self::$todos = get_option( self::$todo_options_name );

		return self::$todos;
	}

    /**
	 * Add new todo if doesn't exist already
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public static function add( $new_todo, $default_value = 0 ) {
        self::get_list();

        if ( !array_key_exists( $new_todo , self::$todos ) ) {
            self::$todos[$new_todo] = $default_value;

            return update_option( self::$todo_options_name, self::$todos );
        }

        return false;
	}

    /**
	 * Update existing todo
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public static function update( $todo, $new_value ) {
        self::get_list();

        if ( array_key_exists( $todo , self::$todos ) ) {
            self::$todos[$todo] = $new_value;

            return update_option( self::$todo_options_name, self::$todos );
        }

        return false;
    }

    /**
	 * Rename existing todo
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public static function rename( $todo, $new_name ) {
        self::get_list();

        if ( $todo !== $new_name && !array_key_exists( $new_name , self::$todos ) ) {
            self::$todos[$new_name] = self::$todos[$todo];
            unset(self::$todos[$todo]);

            return update_option( self::$todo_options_name, self::$todos );
        }

        return false;
    }

    /**
     * Remove existing todo
     *
     * @since    1.0.0
     * @access   public
     */
    public static function remove( $todo ) {
        self::get_list();

        if ( array_key_exists( $todo , self::$todos ) ) {
            unset( self::$todos[$todo] );

            return update_option( self::$todo_options_name, self::$todos );
        }

        return false;
    }

}
