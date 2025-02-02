@extends('layout.main')
@section('content')
@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
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
<section>
    <div class="container-fluid">
        <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-info"><i class="dripicons-plus"></i>
            {{trans('file.Add Warehouse')}}</a>
        <a href="#" data-toggle="modal" data-target="#importWarehouse" class="btn btn-primary"><i
                class="dripicons-copy"></i> {{trans('file.Import Warehouse')}}</a>
    </div>
    <div class="table-responsive">
        <table id="warehouse-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Warehouse')}}</th>
                    <th>{{trans('file.Phone Number')}} </th>
                    <th>{{trans('file.Email')}}</th>
                    <th>{{trans('file.Address')}}</th>
                    <th>{{trans('file.Number of Product')}}</th>
                    <th>{{trans('file.Stock Quantity')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($lims_warehouse_all))
                @foreach ($lims_warehouse_all as $company => $warehouses)
                @if(empty($warehouses))
                    @continue
                @endif
                @foreach($warehouses as $key=>$warehouse)
                <tr data-id="{{$warehouse->id}}" data-company="{{$company}}">
                    <td>{{$key}}</td>
                    <td>{{ $warehouse->name }} </td>
                    <td>{{ $warehouse->phone}}</td>
                    <td>{{ $warehouse->email}}</td>
                    <td>{{ $warehouse->address}}</td>
                    @if (isset($number_of_products[$company][$warehouse->id]))
                    <td>{{$number_of_products[$company][$warehouse->id]}}</td>
                    @else
                    <td>0</td>
                    @endif
                    @if (isset($stock_quantity[$company][$warehouse->id]))
                    <td>{{$stock_quantity[$company][$warehouse->id]}}</td>
                    @else
                    <td>0</td>
                    @endif
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-company="{{$company}}" data-id="{{$warehouse->id}}"
                                        class="open-EditWarehouseDialog btn btn-link" data-toggle="modal"
                                        data-target="#editModal"><i class="dripicons-document-edit"></i>
                                        {{trans('file.edit')}}
                                    </button>
                                </li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['warehouse.destroy' ,$warehouse->id ], 'method' => 'DELETE'] ) }}
                                <li>
                                    <input type="hidden" name="company_name" value=<?=$company?> class="hidden">
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i
                                            class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'warehouse.store', 'method' => 'post']) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Warehouse')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="form-group">
                    <label>{{trans('file.name')}} *</label>
                    <input type="text" placeholder="Type WareHouse Name..." name="name" required="required"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Phone Number')}} *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><strong>Company name *</strong></label>
                    {{-- <input type="hidden" name="biller_id_hidden" value="{{$lims_user_data->biller_id}}"> --}}
                    <select name="company_name" class="selectpicker form-control" title="Select Company..." required>
                        @foreach($companies as $company)
                        <option value="{{$company->name}}">{{ printCompanyName($company->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('file.Email')}}</label>
                    <input type="email" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Address')}} *</label>
                    <textarea required class="form-control" rows="3" name="address"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@if(!empty($lims_warehouse_all) && isset($warehouse))
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => ['warehouse.update',$warehouse->id], 'method' => 'put']) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"> {{trans('file.Update Warehouse')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="form-group">
                    <input type="hidden" name="company" value=<?=$company?>>

                    <input type="hidden" name="warehouse_id" value=<?=$warehouse->id?>>
                    <label>{{trans('file.name')}} *</label>
                    <input type="text" placeholder="Type WareHouse Name..." name="name" required="required"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label><strong>Company name *</strong></label>
                    {{-- <input type="hidden" name="biller_id_hidden" value="{{$lims_user_data->biller_id}}"> --}}
                    <select id="select_company" name="company_name" class="selectpicker form-control"
                        title="Select Company..." required>
                        @foreach($companies as $company)
                        <option value="{{$company->name}}">{{printCompanyName($company->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('file.Phone Number')}} *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>{{trans('file.Email')}}</label>
                    <input type="email" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Address')}} *</label>
                    <textarea class="form-control" rows="3" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endif

<div id="importWarehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'warehouse.import', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Import Warehouse')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <p>{{trans('file.The correct column order is')}} (name*, phone, email, address*)
                    {{trans('file.and you must follow this')}}.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Upload CSV File')}} *</label>
                            {{Form::file('file', array('class' => 'form-control','required'))}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{trans('file.Sample File')}}</label>
                            <a href="public/sample_file/sample_warehouse.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> {{trans('file.Download')}}</a>
                        </div>
                    </div>
                </div>
                <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<script type="text/javascript">
    function printCompanyName(company){
        if(company == "hygiene"){
            return "akeed hygiene";
        }else if(company == "sweet"){
            return "akeed sweet";
        }else if (company == "goods"){
            return "akeed food";
        }else if(company == "hafko"){
            return "akeed factory";
        }else if(company == "sanfora"){
            return "bruxelle salon";
        }else if(company == "service"){
            return "akeed trading";
        }
    }
    //pdf Fonts 
   pdfMake.fonts = {
        Arial: {
                normal: 'Arial.ttf',
                bold: 'Arial.ttf',
                italics: 'Arial.ttf',
                bolditalics: 'Arial.ttf'
        },
        Roboto:{
            normal: 'Roboto-Medium.ttf',
                bold: 'Roboto-Medium.ttf',
                italics: 'Roboto-Medium.ttf',
                bolditalics: 'Roboto-Medium.ttf'
        }
};
// 
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #warehouse-menu").addClass("active");
    var warehouse_id = [];
    var user_verified = <?php echo json_encode(config("user.user_verified")) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
  }


	$(document).ready(function() {
        
	    $('.open-EditWarehouseDialog').on('click', function() {
	        var url = "warehouse/"
	        var id = $(this).data('id').toString();
            var company = $(this).closest('tr').data('company').toString();
	        url = url.concat(id).concat("/edit");
	        $.get(url,{company,id}, function(data) {
	            $("#editModal input[name='name']").val(data['name']);
	            $("#editModal input[name='phone']").val(data['phone']);
	            $("#editModal input[name='email']").val(data['email']);
	            $("#editModal textarea[name='address']").val(data['address']);
	            $("#editModal input[name='warehouse_id']").val(data['id']);
	            $("#editModal input[name='company']").val(data['company']);
                $("#editModal select[name='company_name']").val(data['company']);
                $('.selectpicker').selectpicker('refresh');

	        });
	    });
  });
  $('#warehouse-table').DataTable( {
    "drawCallback": function( settings ) {
        $('.open-EditWarehouseDialog').on('click', function() {
	        var url = "warehouse/"
	        var id = $(this).data('id').toString();
            var company = $(this).closest('tr').data('company').toString();
	        url = url.concat(id).concat("/edit");
	        $.get(url,{company,id}, function(data) {
	            $("#editModal input[name='name']").val(data['name']);
	            $("#editModal input[name='phone']").val(data['phone']);
	            $("#editModal input[name='email']").val(data['email']);
	            $("#editModal textarea[name='address']").val(data['address']);
	            $("#editModal input[name='warehouse_id']").val(data['id']);
	            $("#editModal input[name='company']").val(data['company']);
                $("#editModal select[name='company_name']").val(data['company']);
                $('.selectpicker').selectpicker('refresh');

                // console.log('company name 2', data['company']);

	        });
	    });

    },
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 5, 6, 7]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }
                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                customize: function(doc) {
                    doc.defaultStyle.font = 'Arial';
                },
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        warehouse_id.length = 0;
                        deletedCompanies = [];
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                warehouse_id[i-1] = $(this).closest('tr').data('id');
                                company = $(this).closest('tr').data('company');
                                deletedCompanies.push({id:$(this).closest('tr').data('id'),company});                                
                            }
                            
                        });
                        if(deletedCompanies.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'warehouse/deletebyselection',
                                data:{
                                    deletedCompanies
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            setTimeout(()=>{
                            location.reload();

                            },500);
                            // dt.draw();
                            // dt.rows({ page: 'current', selected: true }).remove().draw();

                        }
                        else if(!warehouse_id.length)
                            alert('No warehouse is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            },
        ],
    } );
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$( "#select_all" ).on( "change", function() {
    if ($(this).is(':checked')) {
        $("tbody input[type='checkbox']").prop('checked', true);
    } 
    else {
        $("tbody input[type='checkbox']").prop('checked', false);
    }
});
$("#export").on("click", function(e){
    e.preventDefault();
    var warehouse = [];
    $(':checkbox:checked').each(function(i){
      warehouse[i] = $(this).val();
    });
    $.ajax({
       type:'POST',
       url:'/exportwarehouse',
       data:{
            warehouseArray: warehouse
        },
       success:function(data){
        alert('Exported to CSV file successfully! Click Ok to download file');
        window.location.href = data;
       }
    });
});
</script>
@endsection