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
                        <h4>{{trans('file.Add User')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>
                        {!! Form::open(['route' => 'user.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                    <input type="text" name="name" required class="form-control">
                                    @if($errors->has('name'))
                                    <span>
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><strong>{{trans('file.Password')}} *</strong> </label>
                                    <div class="input-group">
                                        <input type="password" name="password" required class="form-control">
                                        <div class="input-group-append">
                                            <button id="genbutton" type="button"
                                                class="btn btn-default">{{trans('file.Generate')}}</button>
                                        </div>
                                        @if($errors->has('password'))
                                        <span>
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>{{trans('file.Email')}} *</strong></label>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control">
                                    @if($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                    <input type="text" name="phone" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                    <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>{{trans('file.Companies Name')}}</strong></label>
                                    <br>
                                    <div class="form-check form-group form-check-inline ">
                                        <input type="checkbox" class="form-check-input" name="all" id="all" value="all">
                                        <label class="form-check-label " for="all">all</label>
                                    </div>
                                    <br>
                                    @for ($i = 0; $i < count($companies); $i++) <div class="form-check form-group  ">
                                        <input type="checkbox" class="form-check-input check-company "
                                            name="<?='companies['.$companies[$i]->name.']'?>" id="check-company-<?=$i?>"
                                            value="<?=$companies[$i]->name?>">
                                        <label class="form-check-label "
                                            for="<?=$companies[$i]->name?>"><?=$companies[$i]->name?></label>
                                </div>
                                <div class="d-none form-group roles_list" id=<?="roles-$i"?>>
                                    <label><strong>{{trans('file.Role')}} *</strong></label>
                                    <select id=<?="select-$i"?> name=<?="companies[".$companies[$i]->name."][role]" ?>
                                        class="selectpicker form-control " data-live-search="true"
                                        data-live-search-style="begins" title="Select Role...">
                                        @foreach($lims_role_list as $role)
                                        <option value="{{$role->id}}">
                                            {{$role->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-none permissions form-group" id="permissions-<?=$i?>">
                                    <?php $company_modules = $companies_permissions[$companies[$i]->name]; ?>
                                    @if (empty($company_modules))
                                    empty
                                    @else

                                    @foreach ($company_modules as $company_module => $module_permissions)
                                    
                                        
                                    <p>
                                        {{ trans('file.'.$company_module) }}
                                    </p>
                                    @foreach ($module_permissions as $permission)
                                    <div class="form-check form-group form-check-inline "
                                        id=<?="company-$i-$permission"?>>
                                        <input type="checkbox" class="form-check-input "
                                            name="<?='companies['.$companies[$i]->name.']'.'['. $company_module .'][]'?>"
                                            value="<?=$permission?>">
                                        <label class="form-check-label" for="<?=$permission?>">
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
                                    @endforeach
                                    @endforeach
                                    @endif
                                </div>
                                @endfor
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

    // $('select[name="role_id"]').on('change', function() {
    //     if($(this).val() > 2){
    //         $('select[name="warehouse_id"]').prop('required',true);
    //         $('select[name="biller_id"]').prop('required',true);
    //         $('#biller-id').show();
    //         $('#warehouseId').show();
    //     }
    //     else{
    //         $('select[name="warehouse_id"]').prop('required',false);
    //         $('select[name="biller_id"]').prop('required',false);
    //         $('#biller-id').hide();
    //         $('#warehouseId').hide();
    //     }
    // });

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
            console.log(roleDropDown)
            $('#permissions-'+id).addClass('d-none')
        }

        const staffPermissions = ['print_barcode','adjustment','stock_count' , 'gift-card', 'coupon', 'expenses-index', 'expenses-add','quotes-index', 'quotes-edit', 'quotes-add', 'quotes-delete','account-index', 'account-statement', 'money-transfer', 'balance-sheet','department', 'employees-index', 'attendance', 'payroll','users-index', 'users-add', 'billers-index', 'billers-add', 'suppliers-index', 'suppliers-add','profit-loss', 'best-seller', 'warehouse-report', 'warehouse-stock-report', 'product-report', 'daily-sale', 'monthly-sale', 'daily-purchase', 'monthly-purchase', 'purchase-report', 'sale-report', 'payment-report', 'product-qty-alert', 'customer-report', 'supplier-report', 'due-report']

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


</script>
@endsection