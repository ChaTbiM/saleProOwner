<?php $__env->startSection('content'); ?>
<?php if($errors->has('name')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button><?php echo e($errors->first('name')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
        aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
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
            <?php echo e(trans('file.Add Warehouse')); ?></a>
        <a href="#" data-toggle="modal" data-target="#importWarehouse" class="btn btn-primary"><i
                class="dripicons-copy"></i> <?php echo e(trans('file.Import Warehouse')); ?></a>
    </div>
    <div class="table-responsive">
        <table id="warehouse-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                    <th><?php echo e(trans('file.Phone Number')); ?> </th>
                    <th><?php echo e(trans('file.Email')); ?></th>
                    <th><?php echo e(trans('file.Address')); ?></th>
                    <th><?php echo e(trans('file.Number of Product')); ?></th>
                    <th><?php echo e(trans('file.Stock Quantity')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($lims_warehouse_all)): ?>
                <?php $__currentLoopData = $lims_warehouse_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company => $warehouses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(empty($warehouses)): ?>
                    <?php continue; ?>
                <?php endif; ?>
                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($warehouse->id); ?>" data-company="<?php echo e($company); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($warehouse->name); ?> </td>
                    <td><?php echo e($warehouse->phone); ?></td>
                    <td><?php echo e($warehouse->email); ?></td>
                    <td><?php echo e($warehouse->address); ?></td>
                    <?php if(isset($number_of_products[$company][$warehouse->id])): ?>
                    <td><?php echo e($number_of_products[$company][$warehouse->id]); ?></td>
                    <?php else: ?>
                    <td>0</td>
                    <?php endif; ?>
                    <?php if(isset($stock_quantity[$company][$warehouse->id])): ?>
                    <td><?php echo e($stock_quantity[$company][$warehouse->id]); ?></td>
                    <?php else: ?>
                    <td>0</td>
                    <?php endif; ?>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-company="<?php echo e($company); ?>" data-id="<?php echo e($warehouse->id); ?>"
                                        class="open-EditWarehouseDialog btn btn-link" data-toggle="modal"
                                        data-target="#editModal"><i class="dripicons-document-edit"></i>
                                        <?php echo e(trans('file.edit')); ?>

                                    </button>
                                </li>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['warehouse.destroy' ,$warehouse->id ], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <input type="hidden" name="company_name" value=<?=$company?> class="hidden">
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i
                                            class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'warehouse.store', 'method' => 'post']); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Warehouse')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="form-group">
                    <label><?php echo e(trans('file.name')); ?> *</label>
                    <input type="text" placeholder="Type WareHouse Name..." name="name" required="required"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><strong>Company name *</strong></label>
                    
                    <select name="company_name" class="selectpicker form-control" title="Select Company..." required>
                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company->name); ?>"><?php echo e(printCompanyName($company->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Email')); ?></label>
                    <input type="email" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Address')); ?> *</label>
                    <textarea required class="form-control" rows="3" name="address"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>

<?php if(!empty($lims_warehouse_all) && isset($warehouse)): ?>
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => ['warehouse.update',$warehouse->id], 'method' => 'put']); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"> <?php echo e(trans('file.Update Warehouse')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <div class="form-group">
                    <input type="hidden" name="company" value=<?=$company?>>

                    <input type="hidden" name="warehouse_id" value=<?=$warehouse->id?>>
                    <label><?php echo e(trans('file.name')); ?> *</label>
                    <input type="text" placeholder="Type WareHouse Name..." name="name" required="required"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label><strong>Company name *</strong></label>
                    
                    <select id="select_company" name="company_name" class="selectpicker form-control"
                        title="Select Company..." required>
                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company->name); ?>"><?php echo e(printCompanyName($company->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Email')); ?></label>
                    <input type="email" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Address')); ?> *</label>
                    <textarea class="form-control" rows="3" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
<?php endif; ?>

<div id="importWarehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <?php echo Form::open(['route' => 'warehouse.import', 'method' => 'post', 'files' => true]); ?>

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Import Warehouse')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <p><?php echo e(trans('file.The correct column order is')); ?> (name*, phone, email, address*)
                    <?php echo e(trans('file.and you must follow this')); ?>.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(trans('file.Upload CSV File')); ?> *</label>
                            <?php echo e(Form::file('file', array('class' => 'form-control','required'))); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php echo e(trans('file.Sample File')); ?></label>
                            <a href="public/sample_file/sample_warehouse.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> <?php echo e(trans('file.Download')); ?></a>
                        </div>
                    </div>
                </div>
                <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
            <?php echo e(Form::close()); ?>

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
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
             "info":      '<small><?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)</small>',
            "search":  '<?php echo e(trans("file.Search")); ?>',
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
                text: '<?php echo e(trans("file.delete")); ?>',
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
                            // location.reload();
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>