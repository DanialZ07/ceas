<!--Header-->
<div class="row text-body-secondary">
	<div class="col-12">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
</div>
<div class="line mb-4"></div>

<div class="row mt-3">
	<div class="col-md-9">
		<ul class="nav nav-pills flex-column flex-md-row mb-3">
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
		</ul>
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="p-3">
				<?= $this->Form->create($user, ['type' => 'file']); ?>

				<fieldset>
					<div class="row">
						<div class="col-md-2" align="center">
							<?php if ($user->avatar != NULL) {
								echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar, ['class' => 'img-circle', 'width' => '100px', 'height' => '100px']);
							} else
								echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'img-circle', 'width' => '100px', 'height' => '100px']);
							?>
						</div>
						<div class="col-md-10">
							Are confirm to remove your profile picture?
							<div class="form-group">
								<?php echo $this->Form->hidden('avatar', ['value' => '', 'class' => 'form-control', 'required' => false]); ?>
								<?php echo $this->Form->hidden('avatar_dir', ['value' => '', 'class' => 'form-control', 'required' => false]); ?>
							</div>
						</div>
					</div>

				</fieldset>
				<div class="text-end">
					<?= $this->Form->button(__('Yes'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Instruction</div>
				<div class="tricolor_line mb-3"></div>
				<div class="card-body">
					<ul>
						<li>Use appropriate profile picture.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>