<?php echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']); ?>
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
				<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Task'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</div>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-3 border-end">
		<div class="card shadow border-0 gradient-border bg-body-tertiary mb-4">
			<div class="card-body">
				<!--Content-->
				Got anything in your mind? Create the to do task here.
				<div class="d-grid gap-2">
					<?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Task'), ['action' => 'add'], ['class' => 'btn btn-block btn-xs btn-primary mt-2', 'escapeTitle' => false]) ?>
				</div>
			</div>
		</div>

		<div class="col-12 fs-5 fw-medium text-body-secondary mb-2">
			<i class="fa-solid fa-list-check"></i> Todo's Task Search
		</div>
		<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'todos', 'action' => 'index']]); ?>
		<fieldset>
			<div class="mb-1"><?php echo $this->Form->control('task', ['required' => false, 'label' => false, 'placeholder' => 'Task...', 'class' => 'form-control border-0 bg-body-tertiary shadow']); ?></div>
		</fieldset>
		<div class="text-end">
			<?php
			if (!empty($_isSearch)) {
				echo ' ';
				echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-warning btn-sm']);
			}
			echo '&nbsp;&nbsp;';
			echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-primary btn-sm']);
			?>
			<?= $this->Form->end() ?>
		</div>
	</div>
	<div class="col-md-3 border-end">
		<span class="badge bg-warning" style="font-size: 1em;">Pending</span>
		<div class="tricolor_line mb-4 mt-2"></div>
		<?php foreach ($todos_pending as $todo) : ?>
			<div class="card shadow border-0 mb-3 bg-body-tertiary">
				<div class="card-body">
					<!--Content-->
					<div class="row">
						<div class="col-4 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-8 pe-0 text-end">
							<div class="dropdown">
								<a class="btn btn-sm shadow-none border-0 pt-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-ellipsis"></i>
								</a>
								<ul class="dropdown-menu">
									<li><?= $this->Form->postLink('In Progress', ['action' => 'to_progress', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false], ['confirm' => 'Are you sure?']) ?> </li>
									<li><?= $this->Form->postLink('Completed', ['action' => 'to_completed', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false], ['confirm' => 'Are you sure?']) ?></li>
									<li><?= $this->Form->postLink('Canceled', ['action' => 'to_canceled', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false], ['confirm' => 'Are you sure?']) ?></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
									<li>
										<?php $this->Form->setTemplates([
											'confirmJs' => 'addToModal("{{formName}}"); return false;'
											//'confirmJs' => 'console.log("{{confirmMessage}} - {{formName}}"); return false;'
										]); ?>
										<?= $this->Form->postLink(
											__('Delete'),
											['action' => 'delete', $todo->id],
											[
												'confirm' => __('Are you sure you want to delete task: "{0}"?', $todo->task),
												'title' => __('Delete'),
												'class' => 'dropdown-item',
												'escapeTitle' => false,
												'data-bs-toggle' => "modal",
												'data-bs-target' => "#bootstrapModal"
											]
										) ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card_title"><?= h($todo->task) ?></div>
					<div class="justify"><?= ($todo->description) ?></div>
					<div class="mt-3">
						<!--Badge-->
						<?php if ($todo->urgency == 'High') {
							echo '<span class="badge text-bg-danger">High</span>';
						} elseif ($todo->urgency == 'Medium') {
							echo '<span class="badge text-bg-warning">Medium</span>';
						} else
							echo '<span class="badge text-bg-primary">Low</span>';
						?>

						<span class="badge text-bg-secondary"><?= date('F, d Y', strtotime($todo->created)); ?></span>

					</div>

				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="col-md-3 border-end">
		<span class="badge bg-primary" style="font-size: 1em;">In Progress</span>
		<div class="tricolor_line mb-4 mt-2"></div>
		<?php foreach ($todos_progress as $todo) : ?>
			<div class="card shadow border-0 mb-3 bg-body-tertiary">
				<div class="card-body">
					<!--Content-->
					<div class="row">
						<div class="col-2 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-4 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-6 pe-0 text-end">
							<div class="dropdown">
								<a class="btn btn-sm shadow-none border-0 pt-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-ellipsis"></i>
								</a>
								<ul class="dropdown-menu">
									<li><?= $this->Form->postLink('<i class="fa-solid fa-hourglass-start"></i> Pending', ['action' => 'to_pending', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false], ['confirm' => 'Are you sure?']) ?> </li>
									<li><?= $this->Form->postLink('<i class="fa-solid fa-check"></i> Completed', ['action' => 'to_completed', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false], ['confirm' => 'Are you sure?']) ?></li>
									<li><?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i> Canceled', ['action' => 'to_canceled', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false], ['confirm' => 'Are you sure?']) ?></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><?php echo $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Edit'), ['action' => 'edit', $todo->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
								</ul>
							</div>
						</div>
					</div>


					<div class="card_title"><?= h($todo->task) ?></div>
					<div class="justify"><?= ($todo->description) ?></div>
					<div class="mt-3">
						<!--Badge-->
						<?php if ($todo->urgency == 'High') {
							echo '<span class="badge text-bg-danger">High</span>';
						} elseif ($todo->urgency == 'Medium') {
							echo '<span class="badge text-bg-warning">Medium</span>';
						} else
							echo '<span class="badge text-bg-primary">Low</span>';
						?>

						<span class="badge text-bg-secondary"><?= date('F, d Y', strtotime($todo->created)); ?></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="col-md-3">
		<span class="badge bg-success" style="font-size: 1em;">Completed</span>
		<div class="tricolor_line mb-4 mt-2"></div>
		<?php foreach ($todos_completed as $todo) : ?>
			<div class="card shadow border-0 mb-3 bg-body-tertiary">
				<div class="card-body">
					<!--Content-->
					<div class="row">
						<div class="col-1 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-2 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-4 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-5 pe-2 text-end">
							<?= $this->Form->postLink('<i class="fa-solid fa-check"></i>', ['action' => '#'], ['class' => 'btn rounded-pill btn-icon btn-success btn-sm', 'escapeTitle' => false]) ?>
						</div>
					</div>
					<div class="card_title"><?= h($todo->task) ?></div>
					<div class="justify"><?= ($todo->description) ?></div>

					<div class="mt-3">
						<!--Badge-->
						<?php if ($todo->urgency == 'High') {
							echo '<span class="badge text-bg-danger">High</span>';
						} elseif ($todo->urgency == 'Medium') {
							echo '<span class="badge text-bg-warning">Medium</span>';
						} else
							echo '<span class="badge text-bg-primary">Low</span>';
						?>

						<span class="badge text-bg-secondary"><?= date('F, d Y', strtotime($todo->created)); ?></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

		<span class="badge bg-danger mb-4 mt-4" style="font-size: 1em;">Canceled</span>
		<?php foreach ($todos_canceled as $todo) : ?>
			<div class="card shadow border-0 mb-3 bg-body-tertiary">
				<div class="card-body">
					<!--Content-->
					<div class="row">
						<div class="col-4 pe-0">
							<div class="progress mb-3">
								<div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-8 pe-2 text-end">
							<?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i>', ['action' => '#'], ['class' => 'btn rounded-pill btn-icon btn-danger btn-sm', 'escapeTitle' => false]) ?>
						</div>
					</div>
					<div class="card_title"><?= h($todo->task) ?></div>
					<div class="justify"><?= ($todo->description) ?></div>

					<div class="mt-3">
						<!--Badge-->
						<?php if ($todo->urgency == 'High') {
							echo '<span class="badge text-bg-danger">High</span>';
						} elseif ($todo->urgency == 'Medium') {
							echo '<span class="badge text-bg-warning">Medium</span>';
						} else
							echo '<span class="badge text-bg-primary">Low</span>';
						?>

						<span class="badge text-bg-secondary"><?= date('F, d Y', strtotime($todo->created)); ?></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>





<div class="modal" id="bootstrapModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirm</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<i class="fa-regular fa-circle-xmark fa-6x text-danger mb-3"></i>
				<p id="confirmMessage"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="ok">OK</button>
			</div>
		</div>
	</div>
</div>