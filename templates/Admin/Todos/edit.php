<?php
echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
//echo $this->Html->css('prism.css');
//echo $this->Html->script('prism.js');
//echo $this->Html->script('tinymce/tinymce.min.js');
echo $this->Html->script('ckeditor/ckeditor.js');
//echo $this->Html->script('ckfinder/ckfinder.js');
//echo $this->Html->css('jquery.datetimepicker.min.css');
//echo $this->Html->script('jquery.datetimepicker.full.js');
//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
				<li><?= $this->Html->link(__('<i class="fa-solid fa-list"></i> Task List'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</div>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card shadow border-0 mb-3 bg-body-tertiary">
	<div class="card-body">
		<?php echo $this->Form->create($todo); ?>
		<fieldset>
			<?php //echo $this->Form->control('user_id', ['options' => $users]); 
			?>
			<?php echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-select']); ?>
			<?php echo $this->Form->control('task', ['required' => false]); ?>

			<div class="row">
				<div class="col-4">
					<label>Priority</label><br>
					<?php
					echo $this->Form->radio(
						'urgency',
						[
							['value' => 'Low', 'text' => 'Low', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
							['value' => 'Medium', 'text' => 'Medium', 'label' => ['class' => 'btn btn-outline-warning ms-1 mb-3']],
							['value' => 'High', 'text' => 'High', 'label' => ['class' => 'btn btn-outline-danger ms-1 mb-3']],
						]
					); ?>
				</div>
				<div class="col-8">
					<label>Status</label><br>
					<?php
					echo $this->Form->radio(
						'status',
						[
							['value' => 'Pending', 'text' => 'Pending', 'label' => ['class' => 'btn btn-outline-warning ms-1 mb-3']],
							['value' => 'In Progress', 'text' => 'In Progress', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
							['value' => 'Completed', 'text' => 'Completed', 'label' => ['class' => 'btn btn-outline-success ms-1 mb-3']],
							['value' => 'Canceled', 'text' => 'Canceled', 'label' => ['class' => 'btn btn-outline-danger ms-1 mb-3']],
						]
					); ?>
				</div>
			</div>


			<style>
				.ck-editor__editable_inline {
					min-height: 300px;
				}
			</style>
			<?php echo $this->Form->control('description', ['required' => false, 'id' => 'ckeditor', 'label' => 'Description']); ?>
			<script>
				ClassicEditor
					.create(document.querySelector('#ckeditor'))
					.catch(error => {
						console.error(error);
					});
			</script>
			<?php echo $this->Form->control('note', ['required' => false, 'id' => 'ckeditor2', 'label' => 'Note']); ?>
			<script>
				ClassicEditor
					.create(document.querySelector('#ckeditor2'))
					.catch(error => {
						console.error(error);
					});
			</script>


		</fieldset>
		<div class="text-end">
			<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
			<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
			<?= $this->Form->end() ?>
		</div>

		<script>
			var checkboxes = $("input[type='checkbox']"),
				submitButton = $("button[type='submit']");

			checkboxes.click(function() {
				submitButton.attr("disabled", !checkboxes.is(":checked"));
			});
		</script>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".input select").select2();
	});
</script>