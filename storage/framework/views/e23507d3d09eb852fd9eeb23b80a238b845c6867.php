<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($role_id == 3): ?>
                        ceo
                    <?php endif; ?>
                    <div class="container">
                        <?php for($i = 0 ; $i< count($companies) ; $i += 2 ): ?>
                            <div class="row">
                                
                                <div class="card col-5 m-3"  >
                                    <a href="#">
                                        <div class="card-body">
                                        <p class="card-text text-center"> <?php echo e($companies[$i]->name); ?> </p>
                                        </div>
                                        <img class="card-img-top pb-3" src='images/picture.jpg' alt="Card image cap">
                                    </a>
                                </div>
                                <?php if( count($companies) > $i +1 ): ?>
                                    <div class="card col-5 m-3"  >
                                        <a href="#">
                                            <div class="card-body">
                                            <p class="card-text text-center"> <?php echo e($companies[$i+1]->name); ?> </p>
                                            </div>
                                            <img class="card-img-top pb-3" src='images/picture.jpg' alt="Card image cap">
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

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>