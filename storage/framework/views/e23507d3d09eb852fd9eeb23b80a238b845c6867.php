 
<?php $__env->startSection('content'); ?>


<?php if(session()->has('message1')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message1'); ?></div> 
<?php endif; ?>
<?php if(session()->has('message2')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message2')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message3')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message3')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header"><?php echo e(trans('file.dashboard')); ?></div>
                <div class="card-body pt-0">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="container">
                        <?php for($i = 0 ; $i< count($companies) ; $i += 2 ): ?>
                            <div class="row">
                                <div class="card col-5 m-3"  >
                                    <a href=<?php echo e(url($companies[$i]->name)); ?>>
                                        <div class="card-body">
                                        <p class="card-text text-center"> <?php echo e($companies[$i]->name); ?> </p>
                                        </div>
                                        <img class="card-img-top pb-3" src=<?= "images/".$companies[$i]->name.".png"?> alt="Card image cap">
                                    </a>
                                </div>
                                <?php if( count($companies) > $i +1 ): ?>
                                    <div class="card col-5 m-3"  >
                                        <a href=<?php echo e($companies[$i+1]->name); ?>>
                                            <div class="card-body">
                                            <p class="card-text text-center"> <?php echo e($companies[$i+1]->name); ?> </p>
                                            </div>
                                            <img class="card-img-top pb-3" src=<?= "images/".$companies[$i+1]->name.".png"?> alt="Card image cap">
                                        </a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>