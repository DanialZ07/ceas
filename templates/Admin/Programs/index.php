<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Program> $programs
 */
	use Cake\Routing\Router;
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
	$c_name = $this->request->getParam('controller');
	echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
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
							<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Program'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->
<div class="row">
	<div class="col-md-9">
		<!-- Nav tabs -->
		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs nav-fill border-bottom mb-4" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#list"><i class="fa-solid fa-bars-staggered"></i> List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#report"><i class="fa-solid fa-chart-line"></i> Report</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#export"><i class="fa-solid fa-download"></i> Export</a>
				</li>
			</ul>
		</div>
		
		
		<div class="tab-content px-0">
		<div class="tab-pane fade active show" id="list">
    <div class="card bg-body-tertiary border-0 shadow mb-4">
	<div class="card-body text-body-secondary">
	<!-- Tab panes -->
	<div class="table-responsive">
        <table class="table table-sm table-border mb-4 table_transparent table-hover">
            <thead>
		<?php
			$page = $this->Paginator->counter('{{page}}');
			$limit = 10; 
			$counter = ($page * $limit) - $limit + 1;
		?>
                <tr>
					<th>#</th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($programs as $program): ?>
                <tr>
				<td><?php echo $counter++ ?></td>
                    <td><?= $this->Number->format($program->id) ?></td>
                    <td><?= h($program->code) ?></td>
                    <td><?= h($program->name) ?></td>
                    <td><?= $this->Number->format($program->status) ?></td>
                    <td><?= h($program->created) ?></td>
                    <td><?= h($program->modified) ?></td>
					<td class="actions text-center">
						<div class="btn-group shadow" role="group" aria-label="Basic example">
							<?= $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $program->id], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false]) ?>
							<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i>'), ['action' => 'edit', $program->id], ['class' => 'btn btn-outline-warning btn-xs', 'escapeTitle' => false]) ?>
							<?php $this->Form->setTemplates([
								'confirmJs' => 'addToModal("{{formName}}"); return false;'
							]); ?>
							<?= $this->Form->postLink(
								__('<i class="fa-regular fa-trash-can"></i>'),
								['action' => 'delete', $program->id],
								[
									'confirm' => __('Are you sure you want to delete Programs: "{0}"?', $program->id),
									'title' => __('Delete'),
									'class' => 'btn btn-outline-danger btn-xs',
									'escapeTitle' => false,
									'data-bs-toggle' => "modal",
									'data-bs-target' => "#bootstrapModal"
								]
							) ?>
						</div>
					</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<div aria-label="Page navigation" class="mt-3 px-2">
    <ul class="pagination justify-content-end flex-wrap">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></div>
</div>
	</div>
</div>
		</div>
		<div class="tab-pane container fade px-0" id="report">
			<div class="row pb-3">
				<div class="col-md-4">
				  <div class="stat_card card-1 bg-body-tertiary">
					<h3><?php echo $total_programs; ?></h3>
					<p>Total Programs</p>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="stat_card card-2 bg-body-tertiary">
					<h3><?php echo $total_programs_active; ?></h3>
					<p>Active Programs</p>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="stat_card card-3 bg-body-tertiary">
					<h3><?php echo $total_programs_archived; ?></h3>
					<p>Archived Programs</p>
				  </div>
				</div>
			</div>
			
<div class="row">
	<div class="col-md-6">
	<div class="card bg-body-tertiary border-0 shadow mb-4">
		<div class="card-body">
			<div class="card-title mb-0">Programs (Monthly)</div>
			<div class="tricolor_line mb-3"></div>
				<div class="chart-container" style="position: relative;">
					<canvas id="monthly"></canvas>
				</div>
<script>
const ctx = document.getElementById('monthly');
const monthly = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($monthArray); ?>,
        datasets: [{
            label: '# of Programs(s)',
			data: <?php echo json_encode($countArray); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)','rgba(89, 233, 28, 0.2)','rgba(255, 5, 5, 0.2)','rgba(255, 128, 0, 0.2)','rgba(153, 153, 153, 0.2)','rgba(15, 207, 210, 0.2)','rgba(44, 13, 181, 0.2)','rgba(86, 172, 12, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(89, 233, 28, 1)','rgba(255, 5, 5, 1)','rgba(255, 128, 0, 1)','rgba(153, 153, 153, 1)','rgba(15, 207, 210, 1)','rgba(44, 13, 181, 1)','rgba(86, 172, 12, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
		plugins: {
            title: {
                display: false,
                text: 'Programs (Monthly)',
				font: {
				  size: 15
					}
				},
			subtitle: {
                display: false,
                text: '<?php echo $system_name; ?>'
				},
			legend: {
					display: false,
					labels: {
						color: 'rgb(255, 99, 132)'
					}
				},
        }
    }
});
</script>
		</div>
	</div>
	</div>
	<div class="col-md-6">
	<div class="card bg-body-tertiary border-0 shadow mb-4">
		<div class="card-body">
		<div class="card-title mb-0">Programs by Status</div>
			<div class="tricolor_line mb-3"></div>
		<div class="chart-container" style="position: relative;">
    <canvas id="status"></canvas>
</div>
<script>
const ctx_2 = document.getElementById('status');
const status = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels: ['Active', 'Disabled', 'Archived'],
        datasets: [{
            label: '# of Programs(s)',
			data: [<?= json_encode($total_programs_active); ?>, <?= json_encode($total_programs_disabled); ?>, <?= json_encode($total_programs_archived); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
		plugins: {
            title: {
                display: false,
                text: 'Programs by Status',
				font: {
				  size: 15
					}
				},
			subtitle: {
                display: false,
                text: '<?php echo $system_name; ?>'
				},
			legend: {
					display: false,
					labels: {
						color: 'rgb(255, 99, 132)'
					}
				},
        }
    }
});
</script>
		</div>
	</div>
	</div>
</div>
		</div>

			
		<div class="tab-pane container fade px-0" id="export">
			<?php
				$domain = Router::url("/", true);
				$sub = 'programs';
				$combine = $domain . $sub;
			?>
			<div class="row pb-3">
				<div class="col-md-3 mb-2">
				<a href='<?php echo $combine; ?>/csv' class="kosong">
					<div class="card bg-body-tertiary border-0 shadow">
							<div class="card-body">
						<div class="row mx-0">
							<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-file-csv fa-2x text-primary"></i></div>
							<div class="col-7 text-end m-auto">
								<div class="fs-4 fw-bold">CSV</div>
								<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
							</div>
						</div>
					</div>
						</div>
				</a>
				</div>
				<div class="col-md-3 mb-2">
					<a href='<?php echo $combine; ?>/json' class="kosong" target="_blank">
					<div class="card bg-body-tertiary border-0 shadow">
							<div class="card-body">
						<div class="row mx-0">
							<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-braille fa-2x text-warning"></i></div>
							<div class="col-7 text-end m-auto">
								<div class="fs-4 fw-bold">JSON</div>
								<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
							</div>
						</div>
						</div>
					</div>
					</a>
				</div>
				<div class="col-md-3 mb-2">
					<a href='<?php echo $combine; ?>/pdfList' class="kosong">
					<div class="card bg-body-tertiary border-0 shadow">
							<div class="card-body">
						<div class="row mx-0">
							<div class="col-5 text-center mt-3 mb-3"><i class="fa-regular fa-file-pdf fa-2x text-danger"></i></div>
							<div class="col-7 text-end m-auto">
								<div class="fs-4 fw-bold">PDF</div>
								<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
							</div>
						</div>
						</div>
					</div>
					</a>
				</div>
			</div>	
		</div>
	</div>
		
		

	</div>
	<div class="col-md-3">
<div class="card bg-body-tertiary border-0 shadow mb-4">
	<div class="card-body">
		<div class="card-title mb-0">Search</div>
			<div class="tricolor_line mb-3"></div>
			<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Programs','action' => 'index']]); ?>
				<fieldset>
					<div class="mb-1"><?php echo $this->Form->control('id',['required' => false]); ?></div>
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
	</div>
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