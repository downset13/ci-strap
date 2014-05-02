<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Lost Password - CI-Strap</title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/ambassadors.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 primary-content rounded-bottom">
						<div class="row">
							<div class="col-md-12"><center>
								<img src="<?php echo base_url(); ?>assets/img/loginlogo.png" class="img-responsive top-margin-sm"/>
								<h3>Password Reset</h3>
								</center>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><center><h5>Please Enter Your New Password.</h5></center>
							</div>
						</div>
						<?php echo form_open('login/change_password/'.$token, array('class' => 'form-horizontal', 'role' => 'form')); ?>
							<div class="form-group">
								<div class="col-md-12"><?php if (!empty($errors)) : ?><div class="bg-danger"><center><?php echo 'Oops! '.$errors['pass']; ?></center></div><?php endif; ?></div>
							</div>
							<div class="form-group <?php if (!empty($errors)) : ?>has-error<?php endif; ?>">
								<div class="col-md-12"><input class="form-control"  value="" type="password" name="password" placeholder="New Password" tabindex="1"/></div>
							</div>
							<div class="form-group <?php if (!empty($errors)) : ?>has-error<?php endif; ?>">
								<div class="col-md-12"><input class="form-control"  value="" type="password" name="password2" placeholder="New Password Again" tabindex="2"/></div>
							</div>
							<div class="form-group">
								<div class="col-md-12"><?php echo form_submit('submit', 'Change Password', 'class="btn btn-primary center-block" tabindex="2"'); ?></div>
							</div>
						<?php echo form_close(); ?>
						<center><?php echo anchor('login', '&larr; Back to Login'); ?></center>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>