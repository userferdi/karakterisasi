<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('printg.png') }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CSRF TOKEN --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <!-- Admin LTE -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/overlayscrollbars.min.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
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
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link" style="background-color: #343a40">
        <img src="{{ asset('printg.png') }}" class="brand-image img-circle elevation-3" style="font-size: 16px;">
        <span class="brand-text" style="color: #fff;"><strong>PRINT-G</strong></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar text-sm">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/home" class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link {{ request()->is('schedule*') ? 'active' : request()->is('lab*') ? 'active' : request()->is('tool*') ? 'active' : request()->is('price*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Input Data
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lab" class="nav-link {{ (request()->is('lab*')) ? 'active' : '' }}">
                    <i class="fas fa-flask nav-icon"></i>
                    <p>Laboratorium</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tool" class="nav-link {{ (request()->is('tool*')) ? 'active' : '' }}">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Tools List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="price" class="nav-link {{ (request()->is('price*')) ? 'active' : '' }}">
                    <i class="fas fa-dollar-sign nav-icon"></i>
                    <p>Service and Price List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="schedule" class="nav-link {{ (request()->is('schedule*')) ? 'active' : '' }}">
                    <i class="fas fa-clock nav-icon"></i>
                    <p>Schedules</p>
                  </a>
                </li>
              </ul>
              </li>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-calendar"></i>
                <p>
                  Client Activities
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
                  Transaction Payment
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
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Settings
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
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content" >
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->

    @yield('content')

          <!-- /.row -->
          <!-- Main row -->


          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer text-sm">
      <strong>Copyright &copy; 2020 <a href="http://padjadjaranlab.com">Padjadjaran Lab</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <!-- <b>Version</b> 3.0.3-pre -->
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

@include('modal')

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<!-- jQuery Data Tables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<!-- Data Tables -->
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- OverlayScrollbars -->
<script src="{{ asset('js/jquery.overlayScrollbars.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- Sweet Alert 2 -->
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>

@stack('scripts')
</body>
</html>
