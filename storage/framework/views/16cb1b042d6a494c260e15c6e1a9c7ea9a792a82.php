<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
	<title>EA DOCUMENT REPOSITORY</title>
	<!-- start: META -->
	<meta charset="utf-8" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- end: META -->
	<!-- start: MAIN CSS -->
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/plugins/bootstrap/css/bootstrap.min.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/plugins/font-awesome/css/font-awesome.min.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/fonts/style.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/css/main.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/css/main-responsive.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/plugins/iCheck/skins/all.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/plugins/perfect-scrollbar/src/perfect-scrollbar.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/css/theme_light.css')); ?>" >
	<link rel="stylesheet" href="<?php echo e(URL::asset('css/theme/css/print.css')); ?>" >
		<link rel="shortcut icon" href="<?php echo e(URL::asset('images/kmutnb.ico')); ?>" />

		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<div class="page-container container">
			<div class="form-group">
				<center><?php echo Html::image('images\banner.jpg'); ?></center>
			</div>
			<div style="text-align:center">
				<?php echo $__env->make('front.topnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div> 
			<!-- start: MAIN CONTAINER -->
			<div class="main-container">
				<!-- start: PAGE -->
					<!-- /.modal -->
					<!-- end: SPANEL CONFIGURATION MODAL FORM -->
					<div class="container">

						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-md-12">
									<!-- start: RESPONSIVE TABLE PANEL -->
									<div class="panel panel-default">
										<div style="height: 50px;padding:0" class="panel-heading">
											<div style="font-size:33px;">&nbsp;&nbsp;&nbsp;</div>
										</div>
										<div class="panel-body">
											<div class="table-responsive">
												<!-- Start: table content -->
												
												<h1>ไม่มีข้อมูล</h1>
												<!-- End: table content -->
											</div>
										</div>
									</div>
									<!-- end: RESPONSIVE TABLE PANEL -->
								</div>
							</div>
							<!-- end: PAGE CONTENT-->
						</div>
					</div>
					<!-- end: PAGE -->
				</div>
				<!-- end: MAIN CONTAINER -->
			</div>
			<!-- start: MAIN JAVASCRIPTS -->
			<script src="<?php echo e(URL::asset('css/theme/plugins/jQuery-lib/2.0.3/jquery.min.js')); ?>"></script>
			<!--<![endif]-->
			<script src="<?php echo e(URL::asset('css/theme/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/blockUI/jquery.blockUI.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/iCheck/jquery.icheck.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/perfect-scrollbar/src/jquery.mousewheel.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/perfect-scrollbar/src/perfect-scrollbar.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/less/less-1.5.0.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/jquery-cookie/jquery.cookie.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('css/theme/js/main.js')); ?>"></script>

			<!-- end: MAIN JAVASCRIPTS -->
			<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
			<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
			<script>
				jQuery(document).ready(function() {
					Main.init();
				});
			</script>
		</body>
		<!-- end: BODY -->
		</html>
