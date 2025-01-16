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
				<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-cubes-stacked"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Audit Trail'), ['action' => 'audit_trail', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
		</ul>
		<div class="card bg-body-tertiary border-0 mb-4">
			<div class="card-body">
				<div class="card border-warning shadow text-body-secondary">
					<div class="card-body small-text pb-0">
						<div class="row">
							<div class="col-auto">
								<div class="fa-3x">
									<i class="fa-regular fa-circle-question fa-fade text-warning" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6;"></i>
								</div>
							</div>
							<div class="col">
								<ul>
									<li>Minimum 8 characters</li>
									<li>Combination of alphabet, number and symbol</li>
									<li>Do not use username as password</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="p-3">
					<?php echo $this->Form->create($user); ?>
					<fieldset>
						<div class="form-group">
							<?php echo $this->Form->control('current_password', ['class' => 'form-control', 'required' => false, 'value' => '', 'autocomplete' => 'off', 'type' => 'password', 'id' => 'myPassword']); ?>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<?php echo $this->Form->control('password', ['class' => 'form-control', 'required' => false, 'label' => 'New Password', 'value' => '', 'autocomplete' => 'off', 'type' => 'password', 'id' => 'myPassword2']); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php echo $this->Form->control('cpassword', ['class' => 'form-control', 'type' => 'password', 'label' => 'Confirm New Password', 'required' => false, 'value' => '', 'autocomplete' => 'off', 'type' => 'password', 'id' => 'myPassword3']); ?>
								</div>
							</div>
						</div>
					</fieldset>

					<?php echo $this->Form->checkbox('showPass', ['value' => 'showPass', 'class' => 'form-check-input shadow', 'id' => 'showPass', 'onclick' => 'myFunction()']); ?>
					&nbsp;<label for="showPass">Show Password</label>


					<script>
						function myFunction() {
							var x = document.getElementById("myPassword");
							if (x.type === "password") {
								x.type = "text";
							} else {
								x.type = "password";
							}
							var x = document.getElementById("myPassword2");
							if (x.type === "password") {
								x.type = "text";
							} else {
								x.type = "password";
							}
							var x = document.getElementById("myPassword3");
							if (x.type === "password") {
								x.type = "text";
							} else {
								x.type = "password";
							}
						}
					</script>
					<div class="text-end">
						<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
						<?= $this->Form->end() ?>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>