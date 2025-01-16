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
	<div class="col-md-12">
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
				<?= $this->Html->link(__('<i class="fa-solid fa-cubes-stacked"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Audit Trail'), ['action' => 'audit_trail', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
		</ul>
	</div>
</div>

<div class="card bg-body-tertiary border-0 mb-4">
	<div class="card-body">
		<div class="card-title mb-0">Account Activity</div>
		<div class="tricolor_line mb-3"></div>
		<div class="table-responsive">
			<table class="table table-sm table-border mb-0 table_transparent table-hover">
				<tr>
					<th>Action</th>
					<th>Agent</th>
					<th>OS</th>
					<th>IP</th>
					<th>Host</th>
					<th>Date/Time</th>
				</tr>
				<?php foreach ($userLogs as $userLog) : ?>
					<tr>
						<td>
							<?php if ($userLog->action == 'Login') {
								echo '<span class="badge bg-success">Login</span>';
							} elseif ($userLog->action == 'Logout') {
								echo '<span class="badge bg-danger">Logout</span>';
							} else
								echo '<span class="badge bg-secondary">Error</span>';
							?>
						</td>
						<td><?= h($userLog->useragent) ?></td>
						<td><?= h($userLog->os) ?></td>
						<td><?= h($userLog->ip) ?></td>
						<td><?= h($userLog->host) ?></td>
						<td><?php echo date('M d, Y (h:i A)', strtotime($userLog->created)); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>


<div class="card bg-body-tertiary border-0 mb-4">
	<div class="card-body">
		<div class="card-title mb-0">Audit Log</div>
		<div class="tricolor_line mb-3"></div>
		<div class="table-responsive">
			<table class="table table-sm table-border mb-0 table_transparent table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Type</th>
						<th>Source</th>
						<th>Timestamp</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($user->audit_logs as $log) : ?>
						<tr>
							<td><?= h($log->id) ?></td>
							<td><?= h($log->type) ?></td>
							<td><?= h($log->source) ?></td>
							<td><?php echo date('M d, Y (h:i A)', strtotime($log->created)); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>