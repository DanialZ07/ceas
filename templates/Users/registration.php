<?php
echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
//echo $this->Html->script('https://unpkg.com/feather-icons'); 
?>

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
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<?php echo $this->Form->create($user, ['type' => 'file', 'novalidate' => true]); ?>
				<fieldset>

					<div class="row">
						<div class="col">
							<?php echo $this->Form->control('fullname', ['required' => false]); ?>
						</div>
						<div class="col">
							<?php echo $this->Form->control('email', ['required' => false]); ?>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<?php echo $this->Form->control('password', ['required' => false]); ?>
						</div>
						<div class="col">
							<?php echo $this->Form->control('cpassword', ['class' => 'form-control', 'type' => 'password', 'label' => 'Confirm Password', 'required' => false]); ?>
						</div>
					</div>


					<?php echo $this->Form->control('avatar', ['type' => 'file', 'required' => false, 'class' => 'form-control', 'label' => 'Profile Image']); ?>

					<?php echo $this->Form->checkbox('terms', ['value' => 'terms', 'class' => 'form-check-input shadow', 'id' => 'terms']); ?>
					&nbsp;<label for="terms">I agree to the registration term &amp; conditions</label>


				</fieldset>
				<div class="text-end">
					<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
					<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'disabled' => 'disabled', 'class' => 'btn btn-outline-primary']) ?>
					<?= $this->Form->end() ?>
				</div>

				<script>
					var checkboxes = $("input[type='checkbox']"),
						submitButton = $("button[type='submit']");

					checkboxes.click(function() {
						submitButton.attr("disabled", !checkboxes.is(":checked"));
					});
				</script>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<ul>
					<li>All information provided during registration is correct</li>
					<li>One email can register only one account</li>
					<li>Please use strong password to ensure your account is secure</li>
					<li>Contact administrator if unable to register</li>
				</ul>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$(".input select").select2();
	});
</script>