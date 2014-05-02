<?php $this->load->view('pages/includes/header'); ?>
		<!--Alerts-->
		<div class="row">
			<div class="col-md-12">
				<div class="row" id="alertContainer">
				<?php if(isset($message)){
					echo '<div id="alert" class="alert alert-success alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<center><strong>' . $message . '</strong></center></div>';
				}; ?>
				</div>
			</div>
		</div>
		<!--Body-->
		<div class="row top-margin-sm">
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4 primary-content rounded">
						<div class="row">
							<div class="col-md-12"><h3><i class="fa fa-user fa-lg"></i> Account <small><?=$user->username ?></small></h3></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php echo form_open('account/save_user',array('class' => 'form-horizontal', 'role' => 'form')); ?>
								<div class="form-group">
									<label for="name" class="col-md-4 control-label">Name:</label>
									<div class="col-md-6">
										<input class="form-control"  value="<?=$user->fname ?> <?=$user->lname ?>" type="text" name="name" disabled tabindex="1"/>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['email']) && $errors['email']) : ?>has-error<?php endif; ?>">
									<label for="email" class="col-md-4 control-label">Email:</label>
									<div class="col-md-6">
										<input class="form-control"  value="<?=$user->email ?>" type="email" name="email" required tabindex="2"/>
										<?php if (isset($errors['email']) && $errors['email']) : ?><h6 class="pull-right"><?=$errors['email'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['phone']) && $errors['phone']) : ?>has-error<?php endif; ?>">
									<label for="phone" class="col-md-4 control-label">Phone:</label>
									<div class="col-md-6">
										<input class="form-control"  value="<?=$user->phone ?>" type="text" name="phone" required tabindex="3"/>
										<?php if (isset($errors['phone']) && $errors['phone']) : ?><h6 class="pull-right"><?=$errors['phone'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['pass']) && $errors['pass']) : ?>has-error<?php endif; ?>">
									<label for="pass" class="col-md-4 control-label">New Password:</label>
									<div class="col-md-6">
										<input class="form-control"  value="" type="password" name="pass" tabindex="4"/>
										<?php if (isset($errors['pass']) && $errors['pass']) : ?><h6 class="pull-right"><?=$errors['pass'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group <?php if (isset($errors['pass2']) && $errors['pass2']) : ?>has-error<?php endif; ?>">
									<label for="pass2" class="col-md-4 control-label">New password again:</label>
									<div class="col-md-6">
										<input class="form-control"  value="" type="password" name="pass2" tabindex="5"/>
										<?php if (isset($errors['pass2']) && $errors['pass2']) : ?><h6 class="pull-right"><?=$errors['pass2'] ?></h6><?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
									<?php echo form_submit('submit', 'Save Changes', 'class="btn btn-primary center-block"'); ?>
									</div>
								</div>
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