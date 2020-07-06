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
                        <h4><?php echo e(trans('file.Add User')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic">
                            <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
                        </p>
                        <?php echo Form::open(['route' => 'user.store', 'method' => 'post', 'files' => true]); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.UserName')); ?> *</strong> </label>
                                    <input type="text" name="name" required class="form-control">
                                    <?php if($errors->has('name')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.Password')); ?> *</strong> </label>
                                    <div class="input-group">
                                        <input type="password" name="password" required class="form-control">
                                        <div class="input-group-append">
                                            <button id="genbutton" type="button"
                                                class="btn btn-default"><?php echo e(trans('file.Generate')); ?></button>
                                        </div>
                                        <?php if($errors->has('password')): ?>
                                        <span>
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.Email')); ?> *</strong></label>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control">
                                    <?php if($errors->has('email')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.Phone Number')); ?> *</strong></label>
                                    <input type="text" name="phone" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                    <label class="mt-2"><strong><?php echo e(trans('file.Active')); ?></strong></label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.Company Name')); ?></strong></label>
                                    <br>
                                    <div class="form-check form-group form-check-inline ">
                                        <input type="checkbox" class="form-check-input" name="all" id="all" value="all">
                                        <label class="form-check-label " for="all">all</label>
                                    </div>
                                    <br>
                                    <?php for($i = 0; $i < count($companies); $i++): ?> <div class="form-check form-group  ">
                                        <input type="checkbox" class="form-check-input check-company "
                                            name="<?=$companies[$i]->name?>" id="check-company-<?=$i?>"
                                            value="<?=$companies[$i]->name?>">
                                        <label class="form-check-label "
                                            for="<?=$companies[$i]->name?>"><?=$companies[$i]->name?></label>


                                        
                                </div>
                                <div class="d-none permissions form-group" id="permissions-<?=$i?>">
                                    
                                    <?php $company_modules = $companies_permissions[$companies[$i]->name]; ?>
                                    <?php if(empty($company_modules)): ?>
                                    empty
                                    <?php else: ?>
                                    <?php $__currentLoopData = $company_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_module => $module_permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $module_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check form-group form-check-inline ">
                                        <input type="checkbox" class="form-check-input " name="<?=$permission?>"
                                            id="company-<?=$i?>-permission" value="<?=$permission?>">
                                        <label class="form-check-label " for="<?=$permission?>">
                                            <?php
                                                if(strpos($permission,'index')){
                                                    $exploded = explode('-',$permission); 
                                                    $exploded[1] = 'list';
                                                    $string = implode(' ', $exploded);
                                                    echo $string;
                                                }else if(strpos($permission,'add') || strpos($permission,'delete')){
                                                    $exploded = explode('-',$permission);
                                                    $exploded = array_reverse($exploded);
                                                    $string = implode(' ', $exploded);
                                                    echo $string;
                                                }else {
                                                    $exploded = explode('-',$permission);
                                                    $string = implode(' ', $exploded);
                                                    echo $string;
                                                } 
                                            ?>
                                        </label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php endfor; ?>
                            </div>
                            <div class="form-group">
                                <label><strong><?php echo e(trans('file.Role')); ?> *</strong></label>
                                <select name="role_id" required class="selectpicker form-control"
                                    data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                    <?php $__currentLoopData = $lims_role_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="biller-id">
                                <label><strong><?php echo e(trans('file.Biller')); ?> *</strong></label>
                                <select name="biller_id" required class="selectpicker form-control"
                                    data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                    <?php $__currentLoopData = $lims_biller_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($biller->id); ?>"><?php echo e($biller->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="warehouseId">
                                <label><strong><?php echo e(trans('file.Warehouse')); ?> *</strong></label>
                                <select name="warehouse_id" required class="selectpicker form-control"
                                    data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                    <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
    $("ul#people #user-create-menu").addClass("active");

    $('#warehouseId').hide();
    $('#biller-id').hide();

    $('.selectpicker').selectpicker({
      style: 'btn-link',
    });
    
    $('#genbutton').on("click", function(){
      $.get('genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

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

    // Companies  and permissions
    // Selecting all Companies
    $('#all').on('change',function(){
        const company = $('.check-company');

      if($(this).prop("checked")){
          company.prop('checked',true).trigger('change');

      }else {
        company.prop('checked',false).trigger('change');
      }
    });

    // Showing permissions for selected company

    $('.check-company').on('change',function(){
            const company_id = $(this).prop('id');
            const company_id_number = company_id.split('-')[2];
        if($(this).prop('checked')){
            $('#permissions-'+company_id_number).removeClass('d-none')
        }else {
            $('#permissions-'+company_id_number).addClass('d-none')
        }
    });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>