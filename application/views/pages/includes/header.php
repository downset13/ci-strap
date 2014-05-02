<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?=$pageTitle?> &bull; CI-Strap</title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/ambassadors.css" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<!--Header-->
		<div class="row">
			<div class="col-md-12 header-content">
				<div class="row">
					<div class="col-md-12">
						<img src="<?php echo base_url(); ?>assets/img/headerlogo.png" class="top-margin-sm hidden-xs" title="CI-Strap"/>
						<div class="btn-group top-margin-sm pull-right">
							<?php echo anchor('main','<i class="fa fa-home fa-lg"></i>','title="Dashboard" class="btn btn-default"'); ?>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('username'); ?> <span class="caret"></span></button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><?php echo anchor('account','Account'); ?></li>
									<?php if ($this->user_model->group() == 'admin'){echo '<li>'.anchor('users','Manage Users').'</li><li>'.anchor('log','System Log').'</li>';} ?>
									<li class="divider"></li>
									<li><?php echo anchor('main/logout','Logout'); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>