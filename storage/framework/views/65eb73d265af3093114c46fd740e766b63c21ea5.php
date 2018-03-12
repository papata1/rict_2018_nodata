<?php $__env->startSection('page_heading','Crate'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
       <div class="row">
           <div class="col-md-10 col-md-offset-1">.

               <div class="panel panel-default">

                   <div class="panel-heading">Data</div>

                   <div class="panel-body">

                     <?php echo Form::open(array('route'=>'dat.store','class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)); ?>



                                    <div class="form-group">
                                        <?php echo Form::label('name','ชื่อข้อมูล'); ?>

                                        <?php echo Form::text('name',null,['class'=>'form-control']); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('remark','ประเภทการจัดเก็บ'); ?>

                                        <?php echo Form::text('remark',null,['class'=>'form-control']); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('remark','รายละเอียดเพิ่มเติ่ม'); ?>

                                        <?php echo Form::text('remark',null,['class'=>'form-control']); ?>

                                    </div>

                                    <div class="form-group">
                                        <?php echo Form::button('Create',['type'=>'submit','class'=>'btn btn-primary']); ?>

                                    </div>
                                <?php echo Form::close(); ?>

                   </div>
               </div>
                                     <?php if($errors->any()): ?>
                                    <ul class="alert alert-danger">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </ul>
                                    <?php endif; ?>
           </div>
       </div>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>