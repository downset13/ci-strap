<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Request Access &bull; CI-Strap</title>
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
								<h3>Access Request Form</h3>
								</center>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php echo form_open('login/submit_request',array('class' => 'form-horizontal', 'role' => 'form')); ?>
								<div class="form-group <?php if (isset($errors['fname']) && $errors['fname']) : ?>has-error<?php endif; ?>">
									<label for="fname" class="col-md-4 control-label">First Name</label>
									<div class="col-md-8">
										<input class="form-control"  value="<?php if (isset($fname)){echo $fname;} ?>"type="text" name="fname" placeholder="First Name" required tabindex="1"/>
										<?php if (isset($errors['fname']) && $errors['fname']) : ?><h6 class="pull-right"><?=$errors['fname'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['lname']) && $errors['lname']) : ?>has-error<?php endif; ?>">
									<label for="lname" class="col-md-4 control-label">Last Name</label>
									<div class="col-md-8">
										<input class="form-control"  value="<?php if (isset($lname)){echo $lname;} ?>"type="text" name="lname" placeholder="Last Name" required tabindex="2"/>
										<?php if (isset($errors['lname']) && $errors['lname']) : ?><h6 class="pull-right"><?=$errors['lname'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['email']) && $errors['email']) : ?>has-error<?php endif; ?>">
									<label for="email" class="col-md-4 control-label">Email</label>
									<div class="col-md-8">
										<input class="form-control"  value="<?php if (isset($email)){echo $email;} ?>"type="email" name="email" placeholder="email@gmail.com" required tabindex="3"/>
										<?php if (isset($errors['email']) && $errors['email']) : ?><h6 class="pull-right"><?=$errors['email'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['username']) && $errors['username']) : ?>has-error<?php endif; ?>">
									<label for="username" class="col-md-4 control-label">Username</label>
									<div class="col-md-8">
										<input class="form-control"  value="<?php if (isset($username)){echo $username;} ?>"type="text" name="username" placeholder="Desired username" required tabindex="5"/>
										<?php if (isset($errors['username']) && $errors['username']) : ?><h6 class="pull-right"><?=$errors['username'] ?></h6><?php endif; ?>
									</div>
								</div>			
								<div class="form-group <?php if (isset($errors['pass']) && $errors['pass']) : ?>has-error<?php endif; ?>">
									<label for="pass" class="col-md-4 control-label">Password</label>
									<div class="col-md-8">
										<input class="form-control"  value="<?php if (isset($pass)){echo $pass;} ?>"type="password" name="password" placeholder="Password" required tabindex="6"/>
										<?php if (isset($errors['pass']) && $errors['pass']) : ?><h6 class="pull-right"><?=$errors['pass'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['pass2']) && $errors['pass2']) : ?>has-error<?php endif; ?>">
									<label for="pass2" class="col-md-4 control-label">Password Again</label>
									<div class="col-md-8">
										<input class="form-control"  value="<?php if (isset($pass2)){echo $pass2;} ?>"type="password" name="password2" placeholder="Password Again" required tabindex="7"/>
										<?php if (isset($errors['pass2']) && $errors['pass2']) : ?><h6 class="pull-right"><?=$errors['pass2'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
									<?php echo form_submit('submit', 'Submit Request', 'class="btn btn-primary center-block"'); ?>
									</div>
								</div>
								<?php echo form_close(); ?>
								<center><h6><?php echo anchor('login', '&larr; Back to Login'); ?></h6></center>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
</body>
</html>