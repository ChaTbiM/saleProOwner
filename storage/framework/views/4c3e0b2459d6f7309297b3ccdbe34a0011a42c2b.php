 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message1')): ?>
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message1'); ?>

</div>
<?php endif; ?>
<?php if(session()->has('message2')): ?>
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message2')); ?>

</div>
<?php endif; ?>
<?php if(session()->has('message3')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message3')); ?>

</div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?>

</div>
<?php endif; ?>

<section>
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col-md-10">
                                <div class="card">
                                        <div class="card-header">Companies Modules</div>
                                        <div class="card-body">
                                                <?php if(session('status')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?php echo e(session('status')); ?>

                                                </div>
                                                <?php endif; ?>
                                                <div class="container">
                                                        <?php for($i = 0 ; $i< count($companies) ; $i +=2 ): ?> <div
                                                                class="row">
                                                                <div class="card col-5 m-3">
                                                                        <div class="card-header">
                                                                                <?= $companies[$i]->name?>
                                                                        </div>
                                                                        <div class="card-body">
                                                                                <?php $modules = $companies[$i]->modules; ?>
                                                                                <ul class="list-group">
                                                                                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                                        <li class="list-group-item">
                                                                                                <?= $module->name?></li>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </ul>
                                                                        </div>
                                                                        <a href="<?php echo e(route(modules.edit,['id' => $companies[$i+1]->id])); ?>"
                                                                                class="btn btn-primary  active mx-auto w-50 mb-3"
                                                                                role="button"
                                                                                aria-pressed="true">edit</a>
                                                                </div>
                                                                <?php if( count($companies) > $i +1 ): ?>
                                                                <div class="card col-5 m-3">
                                                                        <div class="card-header">
                                                                                <?= $companies[$i+1]->name?>
                                                                        </div>
                                                                        <div class="card-body">
                                                                                <?php $modules = $companies[$i+1]->modules; ?>
                                                                                <ul class="list-group ">
                                                                                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                                        <li class="list-group-item">
                                                                                                <?= $module->name?></li>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </ul>
                                                                        </div>
                                                                        <a href="<?php echo e(route(modules.edit,['id' => $companies[$i+1]->id])); ?>"
                                                                                class="btn btn-primary  active mx-auto w-50 mb-3"
                                                                                role="button"
                                                                                aria-pressed="true">edit</a>

                                                                        

                                                                </div>
                                                                <?php endif; ?>
                                                </div>
                                                <?php endfor; ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        </div>
</section>

<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>