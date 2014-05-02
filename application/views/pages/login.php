<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Login - CI-Strap</title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/ambassadors.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<!--Alerts-->
		<?php if(isset($message)){
			echo '<div class="row alert-top">
				<div class="col-md-12">
					<div class="row" id="alertContainer">
						<div id="alert" class="alert alert-success alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<center><strong>' . $message . '</strong></center></div>
					</div>
				</div>
			</div>';}?>			
		<!--Body-->
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 primary-content rounded-bottom">
						<div class="row">
							<div class="col-md-12"><center>
								<img src="<?php echo base_url(); ?>assets/img/loginlogo.png" class="img-responsive top-margin-sm"/>
								</center>
								<center><h3>User Management System</h3></center>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"/>
							<div class="<?php if (!empty($errors)) : ?>has-error<?php endif; ?>">
								<?php echo form_open('login/validate'); ?>
								<div class="row">
									<div class="col-md-12">
										<h6><strong>Username</strong>
										<?=anchor('login/request','Request Access','class="pull-right"') ?></h6>
									</div>
								</div>
								<input class="form-control<?php if (!empty($errors)) : ?> has-error<?php endif; ?>"  value="<?php if (isset($user['username'])){echo $user['username'];} ?>" type="text" name="username" placeholder="Enter username" tabindex="1"/>
								<div class="row">
									<div class="col-md-12">
										<h6><strong>Password</strong>
										<?=anchor('login/password','Forgot your password?','class="pull-right"') ?></h6>
									</div>
								</div>
								<input class="form-control" type="password" name="password" placeholder="Password" tabindex="2" />
								<div>&nbsp;</div>
								<?php echo form_submit('submit', 'Login', 'class="btn btn-primary center-block"'); ?>
								<div>&nbsp;</div>
								<div><center><h6><a href="#">&larr; Back to Home</a></h6></center></div>
								<?php if (!empty($errors)) : ?><div class="bg-danger"><center>Oops!  Looks like your username/password is incorrect.</center></div><?php endif; ?>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>