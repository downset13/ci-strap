<?php $this->load->view('pages/includes/header'); ?>
		<!--Alerts-->
		<div class="row">
			<div class="col-md-12">
				<div class="row" id="alertContainer">
				<?php if(isset($message)){
					echo '<div id="alert" class="alert alert-success alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<center><strong>' . $message . '</strong></center></div>';
				}?>
				</div>
			</div>
		</div>
		<!--Body-->
		<div class="row top-margin-sm">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 primary-content rounded">
						<div class="row">
							<div class="col-md-12"><h3><i class="fa fa-group fa-lg"></i> Users <small><?=$count ?></small></h3></div>
						</div>
						<table class="table table-striped table-hover">
							<tr>
								<td class="col-sm-2 hidden-xs hidden-sm"><strong>Name</strong></td>
								<td class="col-xs-4 col-sm-2"><strong>Username</strong></td>
								<td class="col-sm-3 hidden-xs"><strong>Group</strong></td>
								<td class="col-xs-6 col-sm-3"><strong>Email</strong></td>
								<td class="col-sm-1 hidden-xs"><strong>Active</strong></td>
							</tr>
							<?php $groups = array(
								'user' => 'Basic User',
								'admin' => 'Administrator'
							); 
							foreach($users as $u) : ?>
							<tr <?php if($this->user_model->isCurrentUser($u->uid)){echo 'class="info"';} ?>>
								<td class="col-sm-2 hidden-xs hidden-sm"><?php echo anchor('users/user/' . $u->uid,$u->lname . ', ' . $u->fname,'title="View User Details"'); ?></td>
								<td class="col-xs-4 col-sm-2"><?php echo anchor('users/user/' . $u->uid,$u->username,'title="View User Details"'); ?></td>
								<td class="col-sm-3 hidden-xs">
									<?php if ($this->user_model->isCurrentUser($u->uid)) {
											echo form_dropdown('group-' . $u->uid, $groups, $u->group, "onChange='updateUserGroup(this, $u->uid)' disabled");
										}else{
											echo form_dropdown('group-' . $u->uid, $groups, $u->group, "onChange='updateUserGroup(this, $u->uid)'");
									} ?></td>
								<td class="col-xs-6 col-sm-3"><?php echo '<a href="mailto:' . $u->email . '">'. $u->email . '</a>' ?></td>
								<td class="col-sm-1 hidden-xs">
									<?php if (!$this->user_model->isCurrentUser($u->uid)) {
											if ($u->active == 'false'){
												echo anchor('users/activate_user/' . $u->uid, '<p class="text-danger"><i class="fa fa-ban"></i> No</p>');
											}else{
											echo anchor('users/deactivate_user/' . $u->uid, '<p class="text-success"><i class="fa fa-check-circle-o"></i> Yes</p>');
											}
										}else{
										echo '<p class="text-success"><i class="fa fa-check-circle-o"></i> Yes</p>';
									} ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	function updateUserGroup(ele, uid) {
		var group = $(ele).val();
		var data = {
			uid: uid,
			group: group,
			ajax: '1'
		};

		$.ajax({
			url: "<?php echo base_url(); ?>index.php/users/update_user_group",
			type: 'POST',
			data: data,
			success: function() {
				$('#alertContainer').html('<div id="alert" class="alert alert-success alert-dismissable fade">\
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\
				<center><strong>User Group Successfully Modified</strong></center></div>');
				$('#alert').addClass('in');
			}
		});

		return false;
	}
</script>
</body>
</html>