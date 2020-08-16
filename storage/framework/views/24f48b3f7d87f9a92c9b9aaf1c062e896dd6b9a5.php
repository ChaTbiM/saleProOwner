<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="<?php echo e(url('logo/logo.png')); ?>" />
  <title>akeed groupe</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>"
    type="text/css">
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>"
    type="text/css">
  <link rel="stylesheet" href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>"
    type="text/css">
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>"
    type="text/css">
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
  <!-- Drip icon font-->
  <link rel="stylesheet" href="<?php echo asset('vendor/dripicons/webfont.css') ?>" type="text/css">
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
  <!-- jQuery Circle-->
  <link rel="stylesheet" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">
  <!-- Custom Scrollbar-->
  <link rel="stylesheet" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>"
    type="text/css">
  <!-- virtual keybord stylesheet-->
  <link rel="stylesheet" href="<?php echo asset('vendor/keyboard/css/keyboard.css') ?>" type="text/css">
  <!-- date range stylesheet-->
  <link rel="stylesheet" href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" type="text/css">
  <!-- table sorter stylesheet-->
  <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo asset('css/dropzone.css') ?>">
  <link rel="stylesheet" href="<?php echo asset('css/style.css') ?>">
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.timepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/keyboard/js/jquery.keyboard.js') ?>"></script>
  <script type="text/javascript"
    src="<?php echo asset('vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
  <script type="text/javascript"
    src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/charts-custom.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/moment.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/knockout-3.4.2.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/daterangepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/dropzone.js') ?>"></script>

  <!-- table sorter js-->
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/jquery.dataTables.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.buttons.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.bootstrap4.min.js') ?>">
    ">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.colVis.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.html5.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.print.min.js') ?>"></script>

  <script type="text/javascript" src="<?php echo asset('vendor/datatable/sum().js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js">
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js">
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js">
  </script>
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?php echo asset('css/custom-default.css') ?>" type="text/css" id="custom-style">
</head>

<body onload="myFunction()">
  <div id="loader"></div>
  <!-- Side Navbar -->
  
  <!-- navbar-->
  <header class="header">
    <nav class="navbar">
      <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between flex-wrap">
            <?php $role = Auth::user()->role_id ?>
                
            <ul class="  nav-menu list-unstyled d-flex flex-md-row align-items-md-center flex-wrap">
              <li class="nav-item">
                <a class="dropdown-item" href="<?php echo e(url('')); ?>" ><i class="dripicons-home"></i>
                  Home </a>
              </li>
            <?php if($role == 3): ?>

              <li class="nav-item">
                <a class="dropdown-item" href="<?php echo e(url('user')); ?>" ><i class="dripicons-user"></i>
                  <?php echo e(trans('file.User')); ?> </a>
              </li>
              <li class="nav-item">
                <a class="dropdown-item" href="<?php echo e(url('module')); ?>" ><i class="dripicons-checklist"></i>
                  <?php echo e(trans('file.modules')); ?> </a>
              </li>
              <li class="nav-item">
                <a class="dropdown-item" href="<?php echo e(url('biller')); ?>" ><i class="dripicons-checklist"></i>
                  <?php echo e(trans('file.Biller')); ?></a>
              </li>
              <li class="nav-item">
                <a class="dropdown-item" href="<?php echo e(url('warehouse')); ?>" ><i class="dripicons-checklist"></i>
                  <?php echo e(trans('file.Warehouse')); ?> </a>
              </li>
              <?php endif; ?>

            </ul>

          <ul class="ml-auto nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
            <?php 
                  // $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                  // $add_permission_active = DB::table('role_has_permissions')->where([
                  //     ['permission_id', $add_permission->id],
                  //     ['role_id', $role->id]
                  // ])->first();

                  // $empty_database_permission = DB::table('permissions')->where('name', 'empty_database')->first();
                  // $empty_database_permission_active = DB::table('role_has_permissions')->where([
                  //     ['permission_id', $empty_database_permission->id],
                  //     ['role_id', $role->id]
                  // ])->first();
                ?>

            <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>

            <li class="nav-item">
              <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-web"></i>
                <span><?php echo e(__('file.language')); ?></span> <i class="fa fa-angle-down"></i></a>
              <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                <li>
                  <a href="<?php echo e(url('language_switch/en')); ?>" class="btn btn-link"> English</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/es')); ?>" class="btn btn-link"> Español</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/ar')); ?>" class="btn btn-link"> عربى</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/pt_BR')); ?>" class="btn btn-link"> Portuguese</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/fr')); ?>" class="btn btn-link"> Français</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/de')); ?>" class="btn btn-link"> Deutsche</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/id')); ?>" class="btn btn-link"> Malay</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/hi')); ?>" class="btn btn-link"> हिंदी</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/vi')); ?>" class="btn btn-link"> Tiếng Việt</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/ru')); ?>" class="btn btn-link"> русский</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/tr')); ?>" class="btn btn-link"> Türk</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/it')); ?>" class="btn btn-link"> Italiano</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/nl')); ?>" class="btn btn-link"> Nederlands</a>
                </li>
                <li>
                  <a href="<?php echo e(url('language_switch/lao')); ?>" class="btn btn-link"> Lao</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" href="<?php echo e(route('readme')); ?>" target="_blank"><i class="dripicons-information"></i>
                <?php echo e(trans('file.Help')); ?></a>
            </li>
            <li class="nav-item">
              <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i>
                <span><?php echo e(ucfirst(Auth::user()->name)); ?></span> <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                <li>
                  <a href="<?php echo e(url('my-transactions/'.date('Y').'/'.date('m'))); ?>"><i class="dripicons-swap"></i>
                    <?php echo e(trans('file.My Transaction')); ?></a>
                </li>
                <li>
                  <a href="<?php echo e(url('holidays/my-holiday/'.date('Y').'/'.date('m'))); ?>"><i class="dripicons-vibrate"></i>
                    <?php echo e(trans('file.My Holiday')); ?></a>
                </li>

                <li>
                  <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i
                      class="dripicons-power"></i>
                    <?php echo e(trans('file.logout')); ?>

                  </a>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="page">


    <div style="display:none" id="content" class="animate-bottom">
      <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="main-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <p>&copy; Akeed Groupe | <?php echo e(trans('file.Developed')); ?> <?php echo e(trans('file.By')); ?> DZ-DEV</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <?php echo $__env->yieldContent('scripts'); ?>
  <script type="text/javascript">
    if ($(window).outerWidth() > 1199) {
          $('nav.side-navbar').removeClass('shrink');
      }

      function myFunction() {
          setTimeout(showPage, 150);
      }
      function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
      }

      $("div.alert").delay(3000).slideUp(750);

      function confirmDelete() {
          if (confirm("Are you sure want to delete?")) {
              return true;
          }
          return false;
      }
      
      $("a#add-expense").click(function(e){
        e.preventDefault();
        $('#expense-modal').modal();
      });

      $("a#add-account").click(function(e){
        e.preventDefault();
        $('#account-modal').modal();
      });

      $("a#account-statement").click(function(e){
        e.preventDefault();
        $('#account-statement-modal').modal();
      });

      $("a#profitLoss-link").click(function(e){
        e.preventDefault();
        $("#profitLoss-report-form").submit();
      });

      $("a#report-link").click(function(e){
        e.preventDefault();
        $("#product-report-form").submit();
      });

      $("a#purchase-report-link").click(function(e){
        e.preventDefault();
        $("#purchase-report-form").submit();
      });

      $("a#sale-report-link").click(function(e){
        e.preventDefault();
        $("#sale-report-form").submit();
      });

      $("a#payment-report-link").click(function(e){
        e.preventDefault();
        $("#payment-report-form").submit();
      });

      $("a#warehouse-report-link").click(function(e){
        e.preventDefault();
        $('#warehouse-modal').modal();
      });

      $("a#user-report-link").click(function(e){
        e.preventDefault();
        $('#user-modal').modal();
      });

      $("a#customer-report-link").click(function(e){
        e.preventDefault();
        $('#customer-modal').modal();
      });

      $("a#supplier-report-link").click(function(e){
        e.preventDefault();
        $('#supplier-modal').modal();
      });

      $("a#due-report-link").click(function(e){
        e.preventDefault();
        $("#due-report-form").submit();
      });

      $(".daterangepicker-field").daterangepicker({
          callback: function(startDate, endDate, period){
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = endDate.format('YYYY-MM-DD');
            var title = start_date + ' To ' + end_date;
            $(this).val(title);
            $('#account-statement-modal input[name="start_date"]').val(start_date);
            $('#account-statement-modal input[name="end_date"]').val(end_date);
          }
      });

      $('.selectpicker').selectpicker({
          style: 'btn-link',
      });
  </script>
</body>

</html>