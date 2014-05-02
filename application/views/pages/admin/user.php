<?php $this->load->view('pages/includes/header'); ?>
		<!--Alerts-->
		<div class="row">
			<div class="col-md-12">
				<div class="row" id="alertContainer">
				</div>
			</div>
		</div>
		<!--Body-->
		<div class="row top-margin-sm">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 primary-content rounded">
						<div class="row">
							<div class="col-md-11"><h3><i class="fa fa-user fa-lg"></i> <?=$user->fname?> <?=$user->lname ?> 
							<small><?=$user->username ?> <?php if(!$this->user_model->isCurrentUser($user->uid)): ?> <a id="deleteUser" class="jqlink"><i class="fa fa-trash-o"></i></a><?php endif; ?></small></h3></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-striped table-hover">
									<tr>
										<td class="col-sm-3"><strong>Email:</strong></td>
										<td class="col-sm-9"><strong><?=$user->email?></strong></td>
									</tr>
									<tr>
										<td class="col-sm-3"><strong>Phone:</strong></td>
										<td class="col-sm-9"><strong><?=$user->phone?></strong></td>
									</tr>
								</table>
								<center><h6><?php echo anchor('users', '&larr; Back to Users'); ?></h6></center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$("#deleteUser").click(function() {
		$('#alertContainer').html('<div id="alert" class="alert alert-danger alert-dismissable fade">\
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\
			<center><strong>Are you sure you want to permanently delete this user?</strong><br/><br/>\
			<form action="<?php echo base_url(); ?>index.php/users/delete" method="post">\
			<input type="hidden" name="uid" value="<?=$user->uid?>">\
			<input type="submit" value="Delete User" class="btn btn-danger">\
			</form></center></div>');
		$('#alert').addClass('in');
	});
</script>
</body>
</html>