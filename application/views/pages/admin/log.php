<?php $this->load->view('pages/includes/header'); ?>
		<!--Body-->
		<div class="row top-margin-sm">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 primary-content rounded">
						<div class="row">
							<div class="col-md-12"><h3><i class="fa fa-bell fa-lg"></i> System Log <small>(25 Most Recent)</small></h3></div>
						</div>
						<table class="table table-striped table-hover">
							<tr>
								<td class="col-sm-2  hidden-xs"><strong>Timestamp</strong></td>
								<td class="col-sm-2"><strong>Username</strong></td>
								<td class="col-xs-10 col-sm-7"><strong>Message</strong></td>
								<td class="col-sm-1 hidden-xs hidden-sm"><strong>IP Address</strong></td>
							</tr>
							<?php foreach($log as $l): ?>
							<tr>
								<td class="col-sm-2 hidden-xs"><?=$l->timestamp?></td>
								<td class="col-sm-2"><?=$l->username?></td>
								<td class="col-xs-10 col-sm-7"><?=$l->message?></td>
								<td class="col-sm-1 hidden-xs hidden-sm"><?=$l->ipAddr?></td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>