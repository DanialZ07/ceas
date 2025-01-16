<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Exemption $exemption
 * @var \Cake\Collection\CollectionInterface|string[] $students
 * @var \Cake\Collection\CollectionInterface|string[] $faculties
 * @var \Cake\Collection\CollectionInterface|string[] $programs
 * @var \Cake\Collection\CollectionInterface|string[] $campuses
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
            <?= $this->Html->link(__('List Exemptions'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($exemption) ?>
            <fieldset>
                <legend><?= __('Add Exemption') ?></legend>
                
                    <?php echo $this->Form->control('student_id', ['options' => $students]); ?>
                    <?php echo $this->Form->control('faculty_id', ['options' => $faculties]); ?>
                    <?php echo $this->Form->control('program_id', ['options' => $programs]); ?>
                    <?php echo $this->Form->control('semester_id'); ?>
                    <?php echo $this->Form->control('campus_id', ['options' => $campuses]); ?>
                    <?php echo $this->Form->control('matrix'); ?>
                    <?php echo $this->Form->control('ic_number'); ?>
                    <?php echo $this->Form->control('kod_kursus_dipohon'); ?>
                    <?php echo $this->Form->control('nama_kursus_dipohon'); ?>
                    <?php echo $this->Form->control('kod_terdahulu'); ?>
                    <?php echo $this->Form->control('nama_kursus_terdahulu'); ?>
                    <?php echo $this->Form->control('status'); ?>
               
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>