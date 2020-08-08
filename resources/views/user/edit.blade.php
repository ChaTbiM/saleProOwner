@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Update User')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>
                        {!! Form::open(['route' => ['user.update', $lims_user_data->id], 'method' => 'put', 'files' =>
                        true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                    <input type="text" name="name" required class="form-control"
                                        value="{{$lims_user_data->name}}">
                                    @if($errors->has('name'))
                                    <span>
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><strong>{{trans('file.Change Password')}}</strong> </label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control">
                                        <div class="input-group-append">
                                            <button id="genbutton" type="button"
                                                class="btn btn-default">{{trans('file.Generate')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label><strong>{{trans('file.Email')}} *</strong></label>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control" value="{{$lims_user_data->email}}">
                                    @if($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mt-3">
                                    <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                    <input type="text" name="phone" required class="form-control"
                                        value="{{$lims_user_data->phone}}">
                                </div>
                                <div class="form-group">
                                    @if($lims_user_data->is_active)
                                    <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                    @else
                                    <input class="mt-2" type="checkbox" name="is_active" value="1">
                                    @endif
                                    <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
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
                                    <label><strong>{{trans('file.Company Name')}}</strong></label>
                                    <br>
                                    @foreach ($companies as $company)
                                    <div class="form-check  form-group ">
                                        <input type="checkbox" class="form-check-input check-company"
                                            id="check-company-<?=$loop->index?>" name=<?=$company?> id=<?=$company?>
                                            value=<?=$company?>
                                            <?php if(belongsTo($user_companies,$company)) echo "checked" ?>>
                                        <label class="form-check-label " for=<?=$company?>> <?=$company?> </label>
                                    </div>
                                    {{-- roles --}}
                                    @if (isset($roles[$company]))

                                    <div class=" form-group roles_list" id=<?="roles-$loop->index"?>>
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <select id=<?="select-$loop->index"?> name=<?="companies[".$company."][role]" ?>
                                            class="selectpicker form-control " data-live-search="true"
                                            data-live-search-style="begins" title="Select Role...">
                                            @foreach($lims_role_list as $role)
                                            <option value="{{$role->id}}"
                                                <?php if($roles[$company] == $role->id) echo "selected" ?>>
                                                {{$role->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    <div class="d-none form-group roles_list" id=<?="roles-$loop->index"?>>
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <select id=<?="select-$loop->index"?> name=<?="companies[".$company."][role]" ?>
                                            class="selectpicker form-control " data-live-search="true"
                                            data-live-search-style="begins" title="Select Role...">
                                            @foreach($lims_role_list as $role)
                                            <option value="{{$role->id}}">
                                                {{$role->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <?php $i = $loop->index; ?>
                                    <div id="permissions-<?=$loop->index?>"
                                        class=<?php if(!belongsTo($user_companies,$company)) echo "d-none" ?>>

                                        {{-- enabled permissions --}}
                                        @if (!empty($activated_permissions[$company]))
                                        <div class=" ml-2">
                                            @foreach ($activated_permissions[$company] as $module_name => $module)
                                            @foreach ($module as $permission)
                                            <div class=" form-check form-check-inline  form-group " id=<?="company-$i-$permission"?>>
                                                <input type="checkbox" class="form-check-input"
                                                    name=<?="companies[$company][$module_name][$permission]"?>
                                                    id=<?="$company-$permission"?> value=<?=$permission?> checked>
                                                <label class="form-check-label "
                                                    for=<?="$company-$permission"?>><?=printPermission($permission)?>
                                                </label>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                        @endif
                                        {{-- disabled permissions --}}
                                        @if (!empty($desactivated_permissions[$company]))
                                        <div class="ml-2">
                                            @foreach ($desactivated_permissions[$company] as $module_name => $module)
                                            @foreach ($module as $permission)
                                            <div class=" form-check form-check-inline  form-group " id=<?="company-$i-$permission"?>>
                                                <input type="checkbox" class="form-check-input"
                                                    name=<?="companies[$company][$module_name][$permission]"?>
                                                    id=<?="$company-$permission"?> value=<?=$permission?>>
                                                <label class="form-check-label "
                                                    for=<?="$company-$permission"?>><?=printPermission($permission)?>
                                                </label>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                        {!! Form::close() !!}
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


    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });


    $('#all').on('change',function(){
        const company = $('.check-company');
      if($(this).prop("checked")){
          company.prop('checked',true).trigger('change');

      }else {
        company.prop('checked',false).trigger('change');
      }
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
        if(state === "show"){
            $('#permissions-'+id).removeClass('d-none')
        }else if(state === "hide"){
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
            $('#select-'+company_id_number).val('default');
            $('#select-'+company_id_number).selectpicker('refresh');

            $('#roles-'+company_id_number).addClass('d-none').prop('required',false)
            showPermissions(company_id_number,'hide');
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
            }
        })
    })


    const staffPermissions = ['print_barcode','adjustment','stock_count' , 'gift-card', 'coupon', 'expenses-index', 'expenses-add','quotes-index', 'quotes-edit', 'quotes-add', 'quotes-delete','account-index', 'account-statement', 'money-transfer', 'balance-sheet','department', 'employees-index', 'attendance', 'payroll','users-index', 'users-add', 'billers-index', 'billers-add', 'suppliers-index', 'suppliers-add','profit-loss', 'best-seller', 'warehouse-report', 'warehouse-stock-report', 'product-report', 'daily-sale', 'monthly-sale', 'daily-purchase', 'monthly-purchase', 'purchase-report', 'sale-report', 'payment-report', 'product-qty-alert', 'customer-report', 'supplier-report', 'due-report']

    // $(document).ready(()=> {
    //     // id=<?="$company-$permission"?>
    //     $('.roles_list').on('change',(e)=>{
    //         company_id_number = $(event.target).prop('id').split("-")[1]; 
    //         let role = event.target.val();
    //         console.log("role",role);
    //         // $('#roles-'+company_id_number).on('change',(event)=> showPermissions(company_id_number,'show',event.target));
    //     })

    // }
    // )

</script>
@endsection