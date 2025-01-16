<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faculty $faculty
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
							<li><?= $this->Html->link(__('Edit Faculty'), ['action' => 'edit', $faculty->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Faculty'), ['action' => 'delete', $faculty->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faculty->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Faculties'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Faculty'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
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
            <h3><?= h($faculty->name) ?></h3>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($faculty->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($faculty->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($faculty->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($faculty->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($faculty->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($faculty->modified) ?></td>
                </tr>
            </table>
            </div>

			</div>
		</div>
		

            
            

            <div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
            <div class="card-body text-body-secondary">
                <h4><?= __('Related Exemptions') ?></h4>
                <?php if (!empty($faculty->exemptions)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Student Id') ?></th>
                            <th><?= __('Faculty Id') ?></th>
                            <th><?= __('Program Id') ?></th>
                            <th><?= __('Semester Id') ?></th>
                            <th><?= __('Campus Id') ?></th>
                            <th><?= __('Matrix') ?></th>
                            <th><?= __('Ic Number') ?></th>
                            <th><?= __('Kod Kursus Dipohon') ?></th>
                            <th><?= __('Nama Kursus Dipohon') ?></th>
                            <th><?= __('Kod Terdahulu') ?></th>
                            <th><?= __('Nama Kursus Terdahulu') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($faculty->exemptions as $exemptions) : ?>
                        <tr>
                            <td><?= h($exemptions->id) ?></td>
                            <td><?= h($exemptions->student_id) ?></td>
                            <td><?= h($exemptions->faculty_id) ?></td>
                            <td><?= h($exemptions->program_id) ?></td>
                            <td><?= h($exemptions->semester_id) ?></td>
                            <td><?= h($exemptions->campus_id) ?></td>
                            <td><?= h($exemptions->matrix) ?></td>
                            <td><?= h($exemptions->ic_number) ?></td>
                            <td><?= h($exemptions->kod_kursus_dipohon) ?></td>
                            <td><?= h($exemptions->nama_kursus_dipohon) ?></td>
                            <td><?= h($exemptions->kod_terdahulu) ?></td>
                            <td><?= h($exemptions->nama_kursus_terdahulu) ?></td>
                            <td><?= h($exemptions->status) ?></td>
                            <td><?= h($exemptions->created) ?></td>
                            <td><?= h($exemptions->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Exemptions', 'action' => 'view', $exemptions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Exemptions', 'action' => 'edit', $exemptions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exemptions', 'action' => 'delete', $exemptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exemptions->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
            <div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
            <div class="card-body text-body-secondary">
                <h4><?= __('Related Students') ?></h4>
                <?php if (!empty($faculty->students)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Matrix') ?></th>
                            <th><?= __('Faculty Id') ?></th>
                            <th><?= __('Program Id') ?></th>
                            <th><?= __('Campus Id') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($faculty->students as $students) : ?>
                        <tr>
                            <td><?= h($students->id) ?></td>
                            <td><?= h($students->name) ?></td>
                            <td><?= h($students->email) ?></td>
                            <td><?= h($students->phone) ?></td>
                            <td><?= h($students->matrix) ?></td>
                            <td><?= h($students->faculty_id) ?></td>
                            <td><?= h($students->program_id) ?></td>
                            <td><?= h($students->campus_id) ?></td>
                            <td><?= h($students->status) ?></td>
                            <td><?= h($students->created) ?></td>
                            <td><?= h($students->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>

		
	</div>
	<div class="col-md-3">
	  Column
	</div>
</div>




