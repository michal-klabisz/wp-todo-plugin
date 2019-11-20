<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/admin/partials
 */

 $todos = MK_ToDo_List::get_list();
?>

<div class="mk-todo-plugin-settings">
    <div class="mk-todo-list">
        <div class="row add-new-task">
            <div class="checkbox-wrapper">
                <input type="checkbox" class="new-task-checkbox" />
            </div>
            <div class="label-wrapper new-todo-input-wrapper">
                <input type="text" class="new-todo-input" placeholder="Enter new task here..." />
            </div>
        </div>
        <?php foreach ($todos as $todo => $done): ?>
            <div class="row task">
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="<?php echo esc_attr( $todo ) ?>-task-checkbox" value="<?php echo esc_attr( $todo ) ?>" <?php checked( $done, 1 ); ?> class="regular-checkbox" />
                </div>
                <div class="label-wrapper editable-label-wrapper">
                    <label for="<?php echo esc_attr($todo) ?>-task-checkbox">
                        <?php echo $todo ?>
                    </label>
                    <input type="text" class="edit-todo-input" value="<?php echo esc_attr( $todo ) ?>" />
                    <span class="js-edit dashicons dashicons-edit"></span>
                    <span class="js-remove dashicons dashicons-trash"></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
