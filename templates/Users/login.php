<?php echo $this->Html->css('animate.min'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.css" integrity="sha256-iwSnUqgAndMlZnwFWAAzto9R/6Un2RBguZEITMb0Olk=" crossorigin="anonymous" />


<div class="mx-auto my-auto p-2 col-md-6">
	<div class="card bg-body-tertiary border-0 shadow mb-4">
		<div class="card-body">
			<div class="my-4 text-center">
				<h1 class="my-0 page_title">LOGIN</h1>
			</div>
			<div class="tricolor_line mb-3"></div>
			<?= $this->Form->create() ?>
			<div class="row">
				<div class="col-md-6">
					<?= $this->Form->control('email', ['required' => true, 'class' => 'form-control border-0', 'autocomplete' => 'off']) ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->control('password', ['required' => true, 'class' => 'form-control border-0']) ?>
				</div>
			</div>
			<div class="text-end">
				<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning btn-sm']); ?>
				<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary btn-sm']) ?>
				<?= $this->Form->end() ?>
			</div>

			<div class="postlink_space">
				<?php echo $this->Html->link('Register', ['controller' => 'Users', 'action' => 'registration']); ?> |
				<?php //echo $this->Html->link('Forgot Username', array('controller'=>'Users','action'=>'forgot_username')); 
				?>
				<?php echo $this->Html->link('Forgot Password', array('controller' => 'Users', 'action' => 'forgot_password')); ?>
			</div>

			<hr>

			<div class="btn-grid">
				<?php echo $this->Html->link(__('User Manual'), array('controller' => 'pages', 'action' => 'manual'), array('class' => 'btn btn-primary btn-xs', 'escape' => false)); ?>

				<?php echo $this->Html->link(__('Frequently Asked Question'), array('controller' => 'Faqs', 'action' => 'index'), array('class' => 'btn btn-primary btn-xs', 'escape' => false)); ?>

				<?php echo $this->Html->link(__('Contact Us'), array('controller' => 'Contacts', 'action' => 'add'), array('class' => 'btn btn-primary btn-xs', 'escape' => false)); ?>
			</div>
			<hr>
			<div id="supported" align="center">
				<b class="gradient-animate-tiny"><b class="logo-small">&lt;/&gt;</b> <?php echo $system_abbr; ?></b>
				&nbsp;&nbsp;&nbsp;
				<?php echo $this->Html->link($this->Html->image(
					'ctp.png',
					array('alt' => 'Code The Pixel', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
				) . '' . (''), 'https://codethepixel.com', array('target' => 'blank', 'escape' => false)); ?>
				&nbsp;&nbsp;&nbsp;
				<?php echo $this->Html->link($this->Html->image(
					'github.png',
					array('alt' => 'Github', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
				) . '' . (''), 'https://github.com/', array('target' => 'blank', 'escape' => false)); ?>
				&nbsp;&nbsp;&nbsp;
				<?php echo $this->Html->link($this->Html->image(
					'gitlab.png',
					array('alt' => 'GitLab', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
				) . '' . (''), 'https://gitlab.com/', array('target' => 'blank', 'escape' => false)); ?>
			</div>

			<br />
			<div class="">
				<p class="text-center">
					Leading The CRUD Evolution<br>
					<?= $system_name; ?> (<?= $system_abbr; ?>)<br>
					<SCRIPT LANGUAGE="JavaScript">
						today = new Date();
						y0 = today.getFullYear();
					</SCRIPT>
					Copyright &copy; 2022-<SCRIPT LANGUAGE="JavaScript">
						document.write(y0);
					</SCRIPT> <?= $system_abbr; ?>. All rights reserved. [V <?= $version; ?>] <br>
					<br>
				</p>
			</div>

		</div>
	</div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.min.js" integrity="sha256-qG3zvg7/f5CZHwV8IeaQfBY5Hm+M0KR3PMk9lAHp39s=" crossorigin="anonymous"></script>
<script>
	$("#js-rotating").Morphext({
		animation: "fadeInDown",
		complete: function() {
			console.log("This is called after a phrase is animated in! Current phrase index: " + this.index);
		}
	});
</script>