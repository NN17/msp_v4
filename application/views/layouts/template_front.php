<!DOCTYPE html>
<html>
<head>
	<title>Ignite Source</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<base href="<?=base_url()?>" />
	<link rel="shorcut icon" href="asset/system_img/ignite-logo1.png" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap4/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/flaticon.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style-ignite.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css" />

	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/jquery.datetimepicker.js"></script>
	<script type="text/javascript" src="assets/js/myscript.js"></script>
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-lg-1">
					<img src="assets/system_img/ignite-logo1.png" class="img-responsive" />
				</div>
				<div class="col-sm-8 slogam">
					Ignite Soruce <span class="text-warning small-font">version 3.0.1</span>
				</div>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-4 mid-margin">
				<div class="login">
				<h3 class="text-ignite">User Login</h3>
				<hr/>

				<!-- Error Message -->

				<?php if($err_msg == true):?>
					<div class="bg-danger text-center small-padding">
						<span class="text-danger">Username or Password is Invalid</span>
					</div>
				<?php endif;?>

				<?=form_open('login/login_state')?>
					<div class="form-group">
						<?=form_label('Username')?>
						<?=form_input('name','','class="form-control" placeholder="Username" required="required"')?>
					</div>
					<div class="form-group">
						<?=form_label('Password')?>
						<?=form_password('psw','','class="form-control" placeholder="Password" required="required"')?>
					</div>
					<div class="form-group pull-right">
						<?=form_submit('submit','Login','class="btn btn-warning"')?>
					</div>
					<div class="clearfix"></div>
				<?=form_close()?>
				</div>

				<div class="partner mid-margin">
					<div class="row">
						<div class="col-sm-6 col-lg-3 col-xs-6">
							<img src="assets/system_img/tech_logos/bs.png" />
						</div>
						<div class="col-sm-6 col-lg-3">
							<img src="assets/system_img/tech_logos/jquery.png" />
						</div>
						<div class="col-sm-6 col-lg-3">
							<img src="assets/system_img/tech_logos/ci.png" />
						</div>
						<div class="col-sm-6 col-lg-3">
							<img src="assets/system_img/tech_logos/admin_lte.png" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-8 mid-margin">
				<div class="content">
					<img src="assets/system_img/ecm.png" class="img-responsive center-block" />
						<p>
							<span class="mid-font text-ignite">Ignite Source</span> is the most easy <strong>Content Management System (CMS)</strong> for creating your own website. It is using PHP plat-form and the frame-work of Codeigniter (CI). That can add lots of interesting features like forums, user blogs, OpenID, profiles and more. It's trivial to create a site with social features with Source Ignite.
						</p>
						<h4>Using</h4>
						<ul>
							<li>Codeigniter version 3.1.0</li>
							<li>Bootstrap Frame-work</li>
							<li>Admin LTE</li>
						</ul>
						<h4>Requirement</h4>
						<ul>
							<li>PHP version 5.6</li>
						</ul>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>