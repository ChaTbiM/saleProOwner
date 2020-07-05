@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
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
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['user.update', $lims_user_data->id], 'method' => 'put', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control" value="{{$lims_user_data->name}}">
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
                                                <button id="genbutton" type="button" class="btn btn-default">{{trans('file.Generate')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control" value="{{$lims_user_data->email}}">
                                        @if($errors->has('email'))
                                       <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                        <input type="text" name="phone" required class="form-control" value="{{$lims_user_data->phone}}">
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
                                            $belongs_to_hygiene = $companies->search("hygiene");
                                            $belongs_to_sweet = $companies->search("sweet");
                                            $belongs_to_hafko = $companies->search("hafko");
                                            $belongs_to_sanfora = $companies->search("sanfora");
                                            $belongs_to_service = $companies->search("service");
                                            $belongs_to_goods = $companies->search("goods");
                                            
                                        ?>
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                       <br>
                                        <div class="form-check form-group form-check-inline ">
                                            <input type="checkbox" class="form-check-input" name="hygiene" id="hygiene" value="hygiene" <?php if($belongs_to_hygiene) echo "checked" ?>
                                            >
                                            <label class="form-check-label " for="hygiene">hygiene</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="sweet" id="sweet" value="sweet" 
                                            <?php if($belongs_to_sweet) echo "checked" ?>
                                            >
                                            <label class="form-check-label " for="sweet">sweet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="hafko" name="hafko" value="hafko" 
                                            <?php if($belongs_to_hafko) echo "checked" ?>
                                            >
                                            <label class="form-check-label " for="hafko">hafko</label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="sanfora" name="sanfora"  value="sanfora"
                                            <?php if($belongs_to_sanfora) echo "checked" ?>
                                            >
                                            <label class="form-check-label " for="sanfora">sanfora</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="service" name="service" value="service"
                                            <?php if($belongs_to_service) echo "checked" ?>
                                            >
                                            <label class="form-check-label " for="service">service</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="goods" name="goods" value="goods"
                                            <?php if($belongs_to_goods) echo "checked" ?>
                                            >
                                            <label class="form-check-label " for="goods">goods</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <input type="hidden" name="role_id_hidden" value="{{$lims_user_data->role_id}}">
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                          @foreach($lims_role_list as $role)
                                              <option value="{{$role->id}}">{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="biller-id">
                                        <label><strong>{{trans('file.Biller')}} *</strong></label>
                                        <input type="hidden" name="biller_id_hidden" value="{{$lims_user_data->biller_id}}">
                                        <select name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                          @foreach($lims_biller_list as $biller)
                                              <option value="{{$biller->id}}">{{$biller->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="warehouseId">
                                        <label><strong>{{trans('file.Warehouse')}} *</strong></label>
                                        <input type="hidden" name="warehouse_id_hidden" value="{{$lims_user_data->warehouse_id}}">
                                        <select name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                          @foreach($lims_warehouse_list as $warehouse)
                                              <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                          @endforeach
                                        </select>
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
@endsection