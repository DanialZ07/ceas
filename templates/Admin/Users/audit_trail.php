<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="btn-group bg-transparent">
			<?php echo $this->Form->button('<i class="fa-solid fa-arrow-left text-primary"></i>', ['type' => 'button', 'onclick' => 'history.back()', 'escapeTitle' => false, 'class' => 'btn border-0']); ?>
			<button type="button" class="btn border-0" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<ul class="dropdown-menu">
				<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Register New User'), ['action' => 'registration'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row mt-3">
	<div class="col-md-9">
		<ul class="nav nav-pills flex-column flex-md-row mb-3">
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-cubes-stacked"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Audit Trail'), ['action' => 'audit_trail', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
		</ul>
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="p-3">
				<div class="table-responsive">
					<table class="table table-sm table-border mb-0 table_transparent table-hover">
						<tr>
							<th>Log</th>
							<th>Activity</th>
							<th>PK</th>
							<th>Source</th>
							<th>Logged On</th>
							<th class="text-center"><?= __('Actions') ?></th>
						</tr>
						<?php foreach ($auditLogs as $auditLog) : ?>
							<tr>
								<td><?= $this->Number->format($auditLog->id) ?></td>
								<td>
									<?php
									if ($auditLog->type == 'create') {
										echo '<span class="badge bg-success">Create</span>';
									} elseif ($auditLog->type == 'update') {
										echo '<span class="badge bg-warning">Update</span>';
									} elseif ($auditLog->type == 'delete') {
										echo '<span class="badge bg-danger">Delete</span>';
									} elseif ($auditLog->type == 'archived') {
										echo '<span class="badge bg-danger">Archived</span>';
									} else
										echo ($auditLog->type);
									?>
								</td>
								<td><?= $auditLog->primary_key === null ? '' : $this->Number->format($auditLog->primary_key) ?></td>
								<td><?= h($auditLog->source) ?></td>
								<td><?php echo date('M d, Y (h:i A)', strtotime($auditLog->created)); ?></td>
								<td class="actions text-center">
									<div class="btn-group shadow" role="group" aria-label="Basic example">
										<?= $this->Html->link(__('<i class="far fa-folder-open"></i> View'), ['controller' => 'auditLogs', 'action' => 'view', $auditLog->id], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false, 'target' => 'blank']) ?>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Audit Trail</div>
				<div class="tricolor_line mb-3"></div>
				<h6 class="alert-heading fw-bold mb-1">Check full audit trail</h6>
				<p class="mb-0">View all changes for <?php echo $user->fullname; ?> account data in audit trail management.</p>
				<div class="text-end mb-2">
					<?php
					echo $this->Html->link('Audit Trail', ['controller' => 'auditLogs', '?' => ['primary_key' => $user->id]], ['class' => 'btn btn-outline-primary', 'target' => 'blank']);
					?>
				</div>
			</div>
		</div>
	</div>
</div>