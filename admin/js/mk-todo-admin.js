(function( $ ) {
	'use strict';

	$(function() {
		const errorMessage = "Something went wrong or value already exists.";

		function updateToDoName(that) {
			var $parent = $(that).parent();
			var $label = $parent.find("label");
			var $input = $parent.find("input");

			$label.toggle();
			$input.toggle();

			if ($input.is(":visible")) {
				$input.focus();
			} else {
				var data = {
					'action': 'mk_todo_update_name',
					'mk_todo_existing_name': $label.text().trim(),
					'mk_todo_new_name': $input.val().trim()
				};

				jQuery.post(ajaxurl, data, function(response) {
					if (!parseInt(response)) {
						alert(errorMessage);
					} else {
						$('.mk-todo-plugin-settings').load(document.URL +  ' .mk-todo-list', function() {
							resizeInputs();
						});

					}
				});
			}
		}

		function addToDo(that) {
			var data = {
				'action': 'mk_todo_add_new',
				'mk_todo_name': $(that).val().trim(),
				'mk_todo_value': $(".new-task-checkbox:checked").length > 0 ? 1 : 0
			};

			jQuery.post(ajaxurl, data, function(response) {
				if (!parseInt(response)) {
					alert(errorMessage);
				} else {
					$('.mk-todo-plugin-settings').load(document.URL +  ' .mk-todo-list', function() {
						resizeInputs();
					});
				}
			});
		}

		function updateToDoValue(that) {
			var data = {
				'action': 'mk_todo_update_value',
				'mk_todo_name': $(that).closest(".task").find("label").text().trim(),
				'mk_todo_value': $(that).is(":checked") ? 1 : 0
			};

			jQuery.post(ajaxurl, data, function(response) {
				if (!parseInt(response)) {
					alert(errorMessage);
				}
			});
		}

		function removeToDo(that) {
			var $task = $(that).closest('.task');

			var data = {
				'action': 'mk_todo_remove',
				'mk_todo_name': $(that).parent().text().trim(),
			};

			jQuery.post(ajaxurl, data, function(response) {
				if (!parseInt(response)) {
					alert(errorMessage);
				} else {
					$task.remove();
				}
			});
		}

		function resizeInputs() {
			$('.mk-todo-list .row').each(function () {
				var $checkboxWrapper = $(this).find('.checkbox-wrapper');
				var $labelWrapper = $(this).find('.label-wrapper');
				var maxHeight = Math.max($labelWrapper.height(), $checkboxWrapper.height());

				$checkboxWrapper.height(maxHeight);
				$labelWrapper.height(maxHeight);
			});
		}

		$(".mk-todo-plugin-settings").on("click",".js-edit", function () {
			updateToDoName(this);
		});

		$(".mk-todo-plugin-settings").on("keypress",".edit-todo-input", function (e) {
			// enter pressed
			if(e.which == 13) {
				updateToDoName(this);
			}
		});

		$(".mk-todo-plugin-settings").on("keypress",".new-todo-input", function (e) {
			// enter pressed
			if(e.which == 13) {
				addToDo(this);
		    }
		});

		$(".mk-todo-plugin-settings").on("change",".regular-checkbox", function () {
			updateToDoValue(this);
		});

		$(".mk-todo-plugin-settings").on("click",".js-remove", function () {
			removeToDo(this);
		});

		$(window).on('resize', function() {
			resizeInputs();
		});

		resizeInputs();
	});

})( jQuery );
