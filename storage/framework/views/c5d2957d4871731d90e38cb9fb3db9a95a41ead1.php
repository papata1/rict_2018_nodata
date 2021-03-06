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
				<?php echo $__env->make('front.topnav', ['lv1' => $lv1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
									<div style="font-size:33px;">&nbsp;&nbsp;&nbsp;กระบวนการ</div>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<!-- Start: table content -->
										<input style="float:right; width: 400px;" type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหา" title="Type in a name"><br><br>
										<table class="table table-bordered table-hover" id="myTable">
											<thead>
												<tr>
													
													<th><center>ชื่อ</center></th>
													<th><center>รูป</center></th>
													<th><center>ไฟล์</center></th>
												</tr>
											</thead>
											<tbody>
												<?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<tr>
														<td><?php echo e($model->name); ?></td>
														<td><center>
<?php if($model->pic): ?>
                                                    
                                                              <a class="button btn btn-success" 
                                                              target="_blank"
                                                 href="<?php echo e(URL::to('/')); ?>/images/obus/<?php echo e($model->pic); ?>"
                                                   >เรียกดูรูป</a>
                                                   <?php else: ?>
                                                   <div>ไม่มีรูป</div>
                                                   <?php endif; ?>
														</center></td>
														<td><center>
<?php if($model->data): ?>
                                                        <a class="button btn btn-success" 
                                                href="<?php echo e(action('ObusController@download' ,[$model->data])); ?>"        
                                                   >ดาวน์โหลดเอกสาร</a>
                                                   <?php else: ?>
                                                   <div>ไม่มีไฟล์</div>
                                                   <?php endif; ?>
											   		</center></td>
													</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</tbody>
											</table>
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
											   function nothing() {
												   alert("ไม่พบข้อมูล");
											   }
										   </script>
										   <script>
											   function dload() {
												   window.location="<?php echo e(asset('/downloadbus/'.$model->data)); ?>";
											   }
										   </script>
										   <script>
											   function newwin() {
												   Image = window.open('<?php echo e(URL::to('/')); ?>/images/obus/<?php echo e($model->pic); ?>','Image');
											   }
										   </script>

			<script>
				jQuery(document).ready(function() {
					Main.init();
				});

				function myFunction() {
					var input, filter, table, tr, td0, td1, td2, td3, td4, td5, td6, td7, i;
					input = document.getElementById("myInput");
					filter = input.value.toUpperCase();
					table = document.getElementById("myTable");
					tr = table.getElementsByTagName("tr");
					for (i = 0; i < tr.length; i++) {
						td0 = tr[i].getElementsByTagName("td")[0];
						td1 = tr[i].getElementsByTagName("td")[1];
						td2 = tr[i].getElementsByTagName("td")[2];
						td3 = tr[i].getElementsByTagName("td")[3];
						td4 = tr[i].getElementsByTagName("td")[4];
						if (td0 || td1 || td2 || td3 || td4) {
							if (td0.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							} else {
								tr[i].style.display = "none";
							}
						}
					}
				}
			</script>
		</body>
		<!-- end: BODY -->
		</html>
