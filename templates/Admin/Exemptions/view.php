<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Exemption $exemption
 */
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
							<li><?= $this->Html->link(__('Edit Exemption'), ['action' => 'edit', $exemption->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Exemption'), ['action' => 'delete', $exemption->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exemption->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Exemptions'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Exemption'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">
            <h3><?= h($exemption->matrix) ?></h3>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th><?= __('Student') ?></th>
                    <td><?= $exemption->hasValue('student') ? $this->Html->link($exemption->student->name, ['controller' => 'Students', 'action' => 'view', $exemption->student->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Faculty') ?></th>
                    <td><?= $exemption->hasValue('faculty') ? $this->Html->link($exemption->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $exemption->faculty->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Program') ?></th>
                    <td><?= $exemption->hasValue('program') ? $this->Html->link($exemption->program->name, ['controller' => 'Programs', 'action' => 'view', $exemption->program->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Campus') ?></th>
                    <td><?= $exemption->hasValue('campus') ? $this->Html->link($exemption->campus->name, ['controller' => 'Campuses', 'action' => 'view', $exemption->campus->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Matrix') ?></th>
                    <td><?= h($exemption->matrix) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ic Number') ?></th>
                    <td><?= h($exemption->ic_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kod Kursus Dipohon') ?></th>
                    <td><?= h($exemption->kod_kursus_dipohon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nama Kursus Dipohon') ?></th>
                    <td><?= h($exemption->nama_kursus_dipohon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kod Terdahulu') ?></th>
                    <td><?= h($exemption->kod_terdahulu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nama Kursus Terdahulu') ?></th>
                    <td><?= h($exemption->nama_kursus_terdahulu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($exemption->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Semester Id') ?></th>
                    <td><?= $this->Number->format($exemption->semester_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($exemption->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($exemption->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($exemption->modified) ?></td>
                </tr>
            </table>
            </div>

			</div>
		</div>
		

            
            


		
	</div>
	<div class="col-md-3">
	  Column
	</div>
</div>




