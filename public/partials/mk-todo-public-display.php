<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MK_ToDo
 * @subpackage MK_ToDo/public/partials
 */

 $todos = MK_ToDo_List::get_list();
?>

<div class="mk-todo-plugin-settings">
    <div class="mk-todo-list">
        <?php foreach ($todos as $todo => $done): ?>
            <div class="row task">
                <span class="<?php echo $done ? 'done' : '' ?>">
                    <?php echo $todo ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</div>
