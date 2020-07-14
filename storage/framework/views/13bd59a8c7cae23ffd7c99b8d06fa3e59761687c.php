 <?php $__env->startSection('content'); ?>

<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Update User')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic">
                            <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
                        </p>
                        <?php echo Form::open(['route' => ['user.update', $lims_user_data->id], 'method' => 'put', 'files' =>
                        true]); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.UserName')); ?> *</strong> </label>
                                    <input type="text" name="name" required class="form-control"
                                        value="<?php echo e($lims_user_data->name); ?>">
                                    <?php if($errors->has('name')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.Change Password')); ?></strong> </label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control">
                                        <div class="input-group-append">
                                            <button id="genbutton" type="button"
                                                class="btn btn-default"><?php echo e(trans('file.Generate')); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label><strong><?php echo e(trans('file.Email')); ?> *</strong></label>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control" value="<?php echo e($lims_user_data->email); ?>">
                                    <?php if($errors->has('email')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label><strong><?php echo e(trans('file.Phone Number')); ?> *</strong></label>
                                    <input type="text" name="phone" required class="form-control"
                                        value="<?php echo e($lims_user_data->phone); ?>">
                                </div>
                                <div class="form-group">
                                    <?php if($lims_user_data->is_active): ?>
                                    <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                    <?php else: ?>
                                    <input class="mt-2" type="checkbox" name="is_active" value="1">
                                    <?php endif; ?>
                                    <label class="mt-2"><strong><?php echo e(trans('file.Active')); ?></strong></label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    function belongsTo($array,$string){
                                        return  array_search($string, $array);
                                       
                                    }
                                   
                                    function printPermission($permission){
                                        if(strpos($permission,'index')){
                                                    $exploded = explode('-',$permission); 
                                                    $exploded[1] = 'list';
                                                    $string = implode(' ', $exploded);
                                                    return  $string;
                                                }else if(strpos($permission,'add') || strpos($permission,'delete')){
                                                    $exploded = explode('-',$permission);
                                                    $exploded = array_reverse($exploded);
                                                    $string = implode(' ', $exploded);
                                                     return  $string;
                                                }else {
                                                    $exploded = explode('-',$permission);
                                                    $string = implode(' ', $exploded);
                                                     return  $string;
                                                } 
                                    }

                                        ?>
                                    <label><strong><?php echo e(trans('file.Company Name')); ?></strong></label>
                                    <br>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check  form-group ">
                                        <input type="checkbox" class="form-check-input" name=<?=$company?>
                                            id=<?=$company?> value=<?=$company?>
                                            <?php if(belongsTo($user_companies,$company)) echo "checked" ?>>
                                        <label class="form-check-label " for=<?=$company?>> <?=$company?> </label>
                                    </div>

                                    
                                    <?php if(!empty($activated_permissions[$company])): ?>
                                    <div class="ml-2">
                                        <?php $__currentLoopData = $activated_permissions[$company]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_name => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $module; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class=" form-check form-check-inline  form-group ">
                                            <input type="checkbox" class="form-check-input"
                                                name=<?="companies[$company][$module_name][$permission]"?>
                                                id=<?="$company-$permission"?> value=<?=$permission?> checked>
                                            <label class="form-check-label "
                                                for=<?="$company-$permission"?>><?=printPermission($permission)?>
                                            </label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($desactivated_permissions[$company])): ?>
                                    <div class="ml-2">
                                        <?php $__currentLoopData = $desactivated_permissions[$company]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_name => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $module; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class=" form-check form-check-inline  form-group ">
                                            <input type="checkbox" class="form-check-input"
                                                name=<?="companies[$company][$module_name][$permission]"?>
                                                id=<?="$company-$permission"?> value=<?=$permission?>>
                                            <label class="form-check-label "
                                                for=<?="$company-$permission"?>><?=printPermission($permission)?>
                                            </label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </div>

                                
                            
                        
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
    </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $('#biller-id').hide();
    $('#warehouseId').hide();
    
    

    $('select[name=role_id]').val($("input[name='role_id_hidden']").val());
    if($('select[name=role_id]').val() > 2){
        $('#warehouseId').show();
        $('select[name=warehouse_id]').val($("input[name='warehouse_id_hidden']").val());
        $('#biller-id').show();
        $('select[name=biller_id]').val($("input[name='biller_id_hidden']").val());
    }
    $('.selectpicker').selectpicker('refresh');

    $('select[name="role_id"]').on('change', function() {
        if($(this).val() > 2){
            $('select[name="warehouse_id"]').prop('required',true);
            $('select[name="biller_id"]').prop('required',true);
            $('#biller-id').show();
            $('#warehouseId').show();
        }
        else{
            $('select[name="warehouse_id"]').prop('required',false);
            $('select[name="biller_id"]').prop('required',false);
            $('#biller-id').hide();
            $('#warehouseId').hide();
        }
    });

    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>