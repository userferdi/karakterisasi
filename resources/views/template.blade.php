<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>HOME | PRINT-G</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('dist/img/printg.png') }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- <link rel="stylesheet" href="{{ asset('css/tempusdominus.min.css') }}"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="{{ asset('css/icheck.min.css') }}"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{ asset('css/jqvmap.min.css') }}"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">


  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/overlayscrollbars.min.css') }}">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="{{ asset('css/summernote.min.css') }}"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link active">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <!-- <a href="#" class="nav-link">Contact</a> -->
        </li>
      </ul>

      <!-- SEARCH FORM -->
<!--       <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link" style="background-color: #343a40">
        <img src="dist/img/printg.png" class="brand-image img-circle elevation-3" style="font-size: 16px;">
        <span class="brand-text" style="color: #fff;"><strong>PRINT-G</strong></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar text-sm">
        <!-- Sidebar user panel (optional) -->
<!--         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  General Information
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <i class="fas fa-clock nav-icon"></i>
                    <p>Schedules</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index2.html" class="nav-link">
                    <i class="fas fa-flask nav-icon"></i>
                    <p>Laboratorium</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Tools List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-dollar-sign nav-icon"></i>
                    <p>Price List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-calendar"></i>
                <p>
                  My Activities
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Registration of Tool Usage</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index2.html" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Approved Schedule</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Reschedule Offered List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>All Status Booking</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Rejected List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Canceled List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Financial
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <i class="fas fa-credit-card nav-icon"></i>
                    <p>Bill</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index2.html" class="nav-link">
                    <i class="far fa-credit-card nav-icon"></i>
                    <p>Payment</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-print nav-icon"></i>
                    <p>Print Receipt</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.html" class="nav-link">
                    <i class="fas fa-calculator nav-icon"></i>
                    <p>Transaction History</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  History
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-phone"></i>
                <p>
                  Contact
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
<!--       <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><strong>Home</strong></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div>
          </div>
        </div>
      </div> -->
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content" >
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row" style="padding-top:15px;">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h4><strong>Schedules</strong></h4>

                  <p>Jadwal Peminjaman</p>
                </div>
                <div class="icon">
                  <i class="far fa-clock"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4><strong>Laboratorium</strong></h4>

                  <p>Total: 3</p>
                </div>
                <div class="icon">
                  <i class="fas fa-flask"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h4><strong>Tools List</strong></h4>

                  <p>List Alat</p>
                </div>
                <div class="icon">
                  <i class="fas fa-cog"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4><strong>Price List</strong></h4>

                  <p>List Harga</p>
                </div>
                <div class="icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <h2>Selamat Datang, <strong>Ferdian Maulana</strong></h2>
          <a href="https://drive.google.com/file/d/1ZZJEDmb_dlf9WHoV8-fpZi52JPtHDWwB/view" class="btn btn-primary btn-sm">Unduh Workflow Booking Alat</a>
          <a href="https://drive.google.com/open?id=1gcDbrORgSCctPLyy4Mh-xFXBxkgbkWUu" class="btn btn-success btn-sm">Unduh Deskripsi Alur Booking Alat</a>
          <a href="https://drive.google.com/open?id=1pw_FMr_0nes5t2KCVN_KWfg-PGtqKzeI" class="btn btn-warning btn-sm">Unduh Aturan Registrasi Akun</a><br><br>

          <h4><strong>Status Penggunaan Alat Anda</strong></h4>
          <h6>Tidak ada proses Penggunaan Alat yang tercatat dalam sistem kami.</h6>

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="http://padjadjaranlab.com">Padjadjaran Lab</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <!-- <b>Version</b> 3.0.3-pre -->
      </div>
    </footer>

    <!-- Control Sidebar -->
    <!-- <aside class="control-sidebar control-sidebar-dark"> -->
      <!-- Control sidebar content goes here -->
    <!-- </aside> -->
    <!-- /.control-sidebar -->

  </div>
  <!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<!-- <script src="{{ asset('chart.js/Chart.min.js') }}"></script> -->
<!-- Sparkline -->
<!-- <script src="{{ asset('sparklines/sparkline.js') }}"></script> -->
<!-- JQVMap -->
<!-- <script src="{{ asset('jqvmap/jquery.vmap.min.js') }}"></script> -->
<!-- <script src="{{ asset('jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{{ asset('jquery-knob/jquery.knob.min.js') }}"></script> -->
<!-- daterangepicker -->
<!-- <script src="{{ asset('moment/moment.min.js') }}"></script> -->
<!-- <script src="{{ asset('daterangepicker/daterangepicker.js') }}"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="{{ asset('tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> -->
<!-- Summernote -->
<!-- <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script> -->
<!-- overlayScrollbars -->
<script src="{{ asset('overlayScrollbars/js/jquery.overlayScrollbars.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

</body>
</html>
