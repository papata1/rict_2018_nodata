<div class="modal fade pic1" id="pic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">รูปกระบวนการทำงาน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="modal-body">
                            <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                            <div id="t01"></div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>

            </div>
        </div>
    </div>
</div>
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
								<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modell): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<div class="panel-heading">
									<a href="<?php echo url('main/Bus'); ?>"> กระบวนการ</a> > <?php echo e($modell->blname); ?>

								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<!-- Start: table content -->
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
											<tr><td width="200">รหัส</td>	<td><?php echo e($modell->lv1); ?><?php echo e($modell->lv2); ?><?php echo e($modell->lv3); ?><?php echo e($modell->blid); ?></td></tr>
											<tr><td>ประเภท</td><td>
											<?php if($modell->n1): ?>
											<a href="<?php echo url('main/lv/1/'. $modell->id1 ); ?>">
											- <?php echo e($modell-> n1); ?></a><br>
											<?php endif; ?>	
											<?php if($modell->n2): ?>
											<a href="<?php echo url('main/lv/2/'. $modell->id2 ); ?>">
											- <?php echo e($modell-> n2); ?></a><br>
											<?php endif; ?>	
											<?php if($modell->n3): ?>
											<a href="<?php echo url('main/lv/3/'. $modell->id3 ); ?>">
											- <?php echo e($modell-> n3); ?></a><br>
											<?php endif; ?>												
											</td></tr>											
											<tr><td>ข้อมูลที่เกี่ยวข้อง</td><td>
											<?php $__currentLoopData = $liste; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>	
											<a href="<?php echo url('main/DatDetail/'.$row["dlid"] ); ?>">- <?php echo e($row["dlname"]); ?></a><br>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</td></tr>
												<tr><td>หน่วยงานที่เกี่ยวข้อง</td><td>
													<?php $__currentLoopData = $model4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modell3): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<?php
													if($modell3->drbusid == $modell->blid){
														echo"- ".$modell3->dpname."<br>";
													}
													?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</td></tr>
												<tr><td>ระบบสารสนเทศที่เกี่ยวข้อง</td><td>

													<?php $__currentLoopData = $model2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modell2): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<a href="<?php echo url('main/AppDetail/'. $modell2->alid ); ?>">
														- <?php echo e($modell2-> alname); ?></a><br>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</td></tr>
													<tr><td>รายละเอียด</td><td><?php echo e($modell->blremark); ?></td></tr>
													<tr><td colspan="2">
														<a class="button btn btn-success" id="pic_btn"
	
														src="<?php echo e(URL::to('/')); ?>/images/bus/<?php echo e($modell->workflow_path); ?>"
														>รูปกระบวนการทำงาน</a>
														<a class="button btn btn-success" 

														<?php if($modell->workflow_path!=NULL){
															echo 'onclick="dload()"';
														}?>

														<?php if($modell->workflow_path==NULL){
															echo 'onclick="nothing()"';
														}?>
														>ดาวน์โหลดเอกสาร กระบวนการทำงาน</a>
													</td></tr>
													<!-- <tr><td>รายละเอียด</td><td><img src="<?php echo e(URL::to('/')); ?>/images/bus/<?php echo e($modell->workflow_path); ?>"></td></tr> -->
												</table>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										
												
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
														window.location="<?php echo e(asset('/downloadbus/'.$modell->workflow_path)); ?>";
													}
												</script>
				<script>
					jQuery(document).ready(function() {
						Main.init();
					});
				</script>
						<script type="text/javascript">
    												$(document).ready(function() {
															Main.init();
													    $('#pic_btn').on('click', function() {
															$('#imagepreview').attr('src',$(this).attr('src'));
															$('#pic').modal('show');

														});
													});	
												</script>

			</body>
			<!-- end: BODY -->
			</html>