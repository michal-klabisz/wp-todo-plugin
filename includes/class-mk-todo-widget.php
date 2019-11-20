<?php

/**
 * Widget ToDo class
 *
 * @since      1.0.0
 * @package    MK_ToDo
 * @subpackage MK_ToDo/includes
 * @author     Michał Klabisz <michal.klabisz@gmail.com>
 */

class MK_ToDo_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        'mk_todo_widget',
        __('MK ToDo Widget', ' mk-todo'),
        array( 'description' => __( 'Shows todo list', 'mk-todo' ), )
        );
    }

    public function widget( $args, $instance ) {
        ob_start();
			require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/mk-todo-public-display.php';
		$content = ob_get_clean();

		echo $args['before_widget'] . $content . $args['after_widget'];
    }

    public function form( $instance ) {
        parent::form( $instance );
    }

    public function update( $new_instance, $old_instance ) {
        return parent::update( $new_instance, $old_instance );
    }
}
