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
                                
                            </div>
                            <?php if($lims_user_data->role_id !=3): ?>
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
                                                }else if(strpos($permission,'add') || strpos($permission,'delete')){
                                                    $exploded = explode('-',$permission);
                                                    $exploded = array_reverse($exploded);
                                                    $string = implode(' ', $exploded);
                                                }else {
                                                    $exploded = explode('-',$permission);
                                                    $string = implode(' ', $exploded);
                                                }

                                                 if (strpos($permission,'_')){
                                                    $string  = str_replace('_',' ' , $string);
                                                }
                                                
                                                return  $string;
                                    }
                                        ?>
                                    <label><strong><?php echo e(trans('file.Company Name')); ?></strong></label>
                                    <br>
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
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check  form-group ">
                                        <input type="checkbox" class="form-check-input check-company"
                                            id="check-company-<?=$loop->index?>" name=<?=$company?> id=<?=$company?>
                                            value=<?=$company?>
                                            <?php if(belongsTo($user_companies,$company)) echo "checked" ?>>
                                        <label class="form-check-label " for=<?=$company?>> <?= printCompanyName($company)?> </label>
                                    </div>
                                    
                                    <?php if(isset($roles[$company])): ?>
                                        
                                    <div class=" form-group roles_list" id=<?="roles-$loop->index"?>>
                                        <label><strong><?php echo e(trans('file.Role')); ?> *</strong></label>
                                        <select id=<?="select-$loop->index"?> name=<?="companies[".$company."][role]"  ?>
                                            class="selectpicker form-control " data-live-search="true"
                                            data-live-search-style="begins" title="Select Role...">
                                            <?php $__currentLoopData = $lims_role_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"
                                                <?php if($roles[$company] == $role->id) echo "selected" ?>>
                                                <?php echo e($role->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php else: ?>
                                    <div class="d-none form-group roles_list" id=<?="roles-$loop->index"?>>
                                        <label><strong><?php echo e(trans('file.Role')); ?> *</strong></label>
                                        <select id=<?="select-$loop->index"?> name=<?="companies[".$company."][role]" ?>
                                            class="selectpicker form-control " data-live-search="true"
                                            data-live-search-style="begins" title="Select Role...">
                                            <?php $__currentLoopData = $lims_role_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>">
                                                <?php echo e($role->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                    <?php $i = $loop->index; ?>
                                    <div id="permissions-<?=$loop->index?>"
                                        class=<?php if(!belongsTo($user_companies,$company)) echo "d-none" ?>>
                                        <div class=" ml-2">

                                            <?php $__currentLoopData = $user_permissions[$company]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_name => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p>
                                                <?php echo e(trans('file.'.$module_name)); ?>

                                            </p>
                                            <div class="form-check form-group ">
                                                <input type="checkbox" class="form-check-input all-permissions"
                                                        name="all"  data-permissions=<?="all-$i-$module_name"?>
                                                        >
        
                                                <label class="form-check-label "
                                                        for="all"> <?php echo e(trans('file.all')); ?> </label>
                                            </div>
                                            <?php $__currentLoopData = $module; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission => $has_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $class = " form-check-input all-$i-$module_name ";
                                    ?>
                                            <div class=" form-check form-check-inline  form-group " id=<?="company-$i-$permission"?>>
                                            <input type="checkbox" class='<?php echo e($class); ?>'
                                                    name=<?="companies[$company][$module_name][$permission]"?>
                                                    id=<?="$company-$permission"?> value=<?=$permission?> 
                                                    <?php if($has_permission) {echo "checked";} ?>
                                                    >
                                                <label class="form-check-label "
                                                    for=<?="$company-$permission"?>><?=printPermission($permission)?>
                                                </label>
                                            </div>    
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                            </div>
                            <?php endif; ?>
                            
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                        </div>
                        <?php echo Form::close(); ?>


                        
                    </div>
                </div>
            </div>

        </div>
        
        <?php if($lims_user_data->role_id == 3): ?>
        <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4><?php echo e(trans('file.Change Password')); ?></h4>
                </div>
                <div class="card-body">
                    <?php echo Form::open(['route' => ['user.password', Auth::id()], 'method' => 'put']); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Current Password')); ?> *</strong> </label>
                                <input type="password" name="current_pass" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('file.New Password')); ?> *</strong> </label>
                                <input type="password" name="new_pass" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('file.Confirm Password')); ?> *</strong> </label>
                                <input type="password" name="confirm_pass" id="confirm_pass" required class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>

        <?php endif; ?>
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
    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });
    // Showing permissions for selected company
    checkCompany = $('.check-company');
    // checkCompany.on('change', showPermissions);
    checkCompany.on('change', showRoles);
    function showPermissions(id,state,roleDropDown){
        let role;
        
        if(roleDropDown){
         role = Number($(roleDropDown).val());
        }
        if(state == "show"){
            $('#permissions-'+id).removeClass('d-none')
        }else if(state == "hide"){
            $('#permissions-'+id).addClass('d-none')
        }
        // const staffPermissions = ['print_barcode','adjustment','stock_count' , 'gift-card', 'coupon', 'expenses-index', 'expenses-add','quotes-index', 'quotes-edit', 'quotes-add', 'quotes-delete','account-index', 'account-statement', 'money-transfer', 'balance-sheet','department', 'employees-index', 'attendance', 'payroll','users-index', 'users-add', 'billers-index', 'billers-add', 'suppliers-index', 'suppliers-add','profit-loss', 'best-seller', 'warehouse-report', 'warehouse-stock-report', 'product-report', 'daily-sale', 'monthly-sale', 'daily-purchase', 'monthly-purchase', 'purchase-report', 'sale-report', 'payment-report', 'product-qty-alert', 'customer-report', 'supplier-report', 'due-report']
        if(role === 1){
            staffPermissions.forEach(el=>{
                $("#company-"+id+"-"+el).show();
            })
        }else if(role === 4){
            staffPermissions.forEach(el=>{
                $("#company-"+id+"-"+el).hide();
            })
        }
    }
    function showRoles(event){
        const company_id = $(this).prop('id');
        const company_id_number = company_id.split('-')[2];
        const permissions = $('#permissions-'+company_id_number);
        if($(this).prop('checked')){
            $('#roles-'+company_id_number).removeClass('d-none').prop('required',true);
            $('#roles-'+company_id_number).on('change',(event)=> showPermissions(company_id_number,'show',event.target));
        }else {
            $('#roles-'+company_id_number).addClass('d-none').prop('required',false)
            showPermissions(company_id_number,'hide');
            $('#select-'+company_id_number).val(null)
        }
    }
    
    
    $(document).ready(()=>{
        $('.roles_list').on('change',()=>{
            let company_id_number = $(event.target).prop('id').split("-")[1]; 
            let role = $(event.target).val();
            if(role == 1){
                staffPermissions.forEach((el)=>{
                    $("#company-"+company_id_number+"-"+el).show();
                })
            }else if(role == 4){
                staffPermissions.forEach((el)=>{
                    $("#company-"+company_id_number+"-"+el).hide();
                })
            }
        })

        $('.check-company').each((index,el)=>{
            let isChecked = $(`#check-company-${index}`).prop('checked');
            if(isChecked){
            let role = $(`#select-${index}`).val();
            if(role == 1){
                staffPermissions.forEach((permission)=>{
                    $("#company-"+index+"-"+permission).show();
                })
            }else if(role == 4){
                staffPermissions.forEach((permission)=>{
                    $("#company-"+index+"-"+permission).hide();
                })
            }
            }else if (!isChecked){
                $('#roles-'+index).addClass('d-none').prop('required',false)
            showPermissions(index,'hide');
            }
        })

        $('.all-permissions').on('change',function(){
            let permissionsTargetClass = $(this).data('permissions');
            let isAllChecked = $(this).prop('checked');
            console.log('class',permissionsTargetClass);
            console.log('isallchecked',isAllChecked);

            handleAllPermissionsChange(isAllChecked,permissionsTargetClass);

        })
        $('all-permissions').trigger('change');
        
    })
    const staffPermissions = ['print_barcode','adjustment','stock_count' , 'gift-card', 'coupon', 'expenses-index', 'expenses-add','quotes-index', 'quotes-edit', 'quotes-add', 'quotes-delete','account-index', 'account-statement', 'money-transfer', 'balance-sheet','department', 'employees-index', 'attendance', 'payroll','users-index', 'users-add', 'billers-index', 'billers-add', 'suppliers-index', 'suppliers-add','profit-loss', 'best-seller', 'warehouse-report', 'warehouse-stock-report', 'product-report', 'daily-sale', 'monthly-sale', 'daily-purchase', 'monthly-purchase', 'purchase-report', 'sale-report', 'payment-report', 'product-qty-alert', 'customer-report', 'supplier-report', 'due-report']
    function handleAllPermissionsChange(isAllChecked,permissionsTargetClass){
        if(isAllChecked){
        $('.'+permissionsTargetClass).prop('checked',true);
        }else {
        $('.'+permissionsTargetClass).prop('checked',false);
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>