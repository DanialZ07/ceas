<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="btn-group bg-transparent">
			<button type="button" class="btn border-0" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<ul class="dropdown-menu">
				<li><?= $this->Html->link(__('List Faqs'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(
						__('Delete'),
						['action' => 'delete', $faq->id],
						['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
					) ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<?= $this->Form->create($faq) ?>
				<fieldset>
					<div class="row">
						<div class="col-md-6">
							<label>Category</label><br>
							<?php echo $this->Form->radio(
								'category',
								[
									['value' => 'General', 'text' => 'General', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
									['value' => 'Account', 'text' => 'Account', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
									['value' => 'Other', 'text' => 'Other', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
								],
								['class' => 'form-control', 'required' => false]
							);
							if ($this->Form->isFieldError('category')) {
								echo $this->Form->error('category', 'Please select category');
							} ?>

						</div>
						<div class="col-md-6">
							<label>Status</label><br>
							<?php echo $this->Form->radio(
								'status',
								[
									['value' => '0', 'text' => 'Disabled', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
									['value' => '1', 'text' => 'Active', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
									['value' => '2', 'text' => 'Archived', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
								],
								['class' => 'form-control', 'required' => false]
							);
							if ($this->Form->isFieldError('status')) {
								echo $this->Form->error('status', 'Please select status');
							} ?>

						</div>
					</div>
					<?php echo $this->Form->control('question', ['required' => false]); ?>
					<?php echo $this->Form->control('answer', ['required' => false]); ?>
				</fieldset>
				<div class="text-end">
					<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
					<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
					<?= $this->Form->end() ?>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Categories</div>
				<div class="tricolor_line mb-3"></div>
				There are three (3) default categories for frequently asked questions:
				<ol>
					<li>General</li>
					<li>Account</li>
					<li>Other</li>
				</ol>

				Only status active question will be render in FAQ list.
			</div>
		</div>
	</div>
</div>