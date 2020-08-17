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
                                <?php
                                 function printCompanyName($company){
                                    if($company == "hygiene"){
                                        return "akeed hygiene";
                                    }else if($company == "sweet"){
                                        return "akeed sweet";
                                    }else if ($company == "goods"){
                                        return "akeed food";
                                    }else if($company == "hafko"){
                                        return "akeed factory";
                                    }else if($company == "sanfora"){
                                        return "bruxelle salon";
                                    }else if($company == "service"){
                                        return "akeed trading";
                                    }
                                }
                            ?>
                                <div class="card">
                                        <h3 class="card-header"><?= printCompanyName($company_name) ?> <?php echo e(trans('file.modules')); ?> </h3>
                                        <div class="card-body">
                                                <?php echo Form::open(['route' => ['module.update', $company->id], 'method' =>
                                                'put', 'files' => true]); ?>


                                                <h6> <?php echo e(trans('file.activated modules')); ?> </h6>
                                                <?php $__currentLoopData = $company_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check form-group form-check-inline ">
                                                        <input type="checkbox" class="form-check-input"
                                                                name="<?=$module?>" id="<?=$module?>"
                                                                value="<?=$module?>" checked>

                                                        <label class="form-check-label "
                                                                for="<?=$module?>"> <?php echo e(trans("file.$module")); ?></label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <h6> <?php echo e(trans('file.desactivated modules')); ?> </h6>
                                                <?php if(count($desactivated_modules) > 1): ?>
                                                <div class="form-check form-group ">
                                                        <input type="checkbox" class="form-check-input"
                                                                name="all" id="all"
                                                                >

                                                        <label class="form-check-label "
                                                                for="all"> <?php echo e(trans('file.all')); ?> </label>
                                                </div>    
                                                <?php endif; ?>
                                                
                                                <?php $__currentLoopData = $desactivated_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="form-check form-group form-check-inline ">
                                                        <input type="checkbox" class="form-check-input modules"
                                                                name="<?=$module?>" id="<?=$module?>"
                                                                value="<?=$module?>">

                                                        <label class="form-check-label "
                                                                for="<?=$module?>"> <?php echo e(trans("file.$module")); ?></label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group">
                                                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>"
                                                                class="btn btn-primary mt-3">
                                                </div>
                                        </div>

                                        <?php echo Form::close(); ?>

                                </div>
                        </div>
                </div>
        </div>
</section>

<script type="text/javascript">

$(document).ready(()=>{
                let isAllChecked = $('#all').prop('checked');
              handleAllChange(isAllChecked);

        $("#all").on('change', function(){
                let isAllChecked = $(this).prop('checked');
              handleAllChange(isAllChecked);

        })
})

function handleAllChange(isAllChecked){
        if(isAllChecked){
                      $('.modules').prop('checked',true);
              }else {
                $('.modules').prop('checked',false);
              }
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>