<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('finder2.png') }}">

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
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
  <!-- DatePicker -->
  <link rel="stylesheet" href="{{ asset('css/gijgo.min.css') }}">
  @stack('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-danger elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link">
        <img src="{{ asset('finder.jpg') }}" class="brand-image img-circle elevation-3" style="font-size: 16px;">
        <span class="brand-text"><strong>FINDER</strong></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar text-sm">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>

            @role('Admin')
            <li class="nav-item has-treeview">
              <a href="/#" class="nav-link {{ request()->is('lab*') ? 'active' : request()->is('tool*') ? 'active' : request()->is('price*') ? 'active' : request()->is('schedule*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Input Data
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('lab.index') }}" class="nav-link {{ (request()->is('lab*')) ? 'active' : '' }}">
                    <i class="fas fa-flask nav-icon"></i>
                    <p>Laboratorium</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('tool.index') }}" class="nav-link {{ (request()->is('tool*')) ? 'active' : '' }}">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Tools List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('price.index') }}" class="nav-link {{ (request()->is('price*')) ? 'active' : '' }}">
                    <i class="fas fa-dollar-sign nav-icon"></i>
                    <p>Price List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('schedule.index') }}" class="nav-link {{ (request()->is('schedule*')) ? 'active' : '' }}">
                    <i class="fas fa-clock nav-icon"></i>
                    <p>Schedules</p>
                  </a>
                </li>
              </ul>
              </li>
            </li>
            <li class="nav-item has-treeview">
              <a href="/#" class="nav-link {{ (request()->is('activities*')) ? 'active' : '' }}">
                <i class="nav-icon far fa-calendar"></i>
                <p>
                  Client Activities
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('status.booking') }}" class="nav-link {{ (request()->is('activities/status/booking*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Booking Request</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.approved') }}" class="nav-link {{ (request()->is('activities/status/approved*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Approved List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.rejected') }}" class="nav-link {{ (request()->is('activities/status/rejected*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Rejected List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link {{ (request()->is('payment*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Transaction Payment
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('payment.bill') }}" class="nav-link {{ (request()->is('payment/bill*')) ? 'active' : '' }}">
                    <i class="fas fa-money-check-alt nav-icon"></i>
                    <p>Invoice</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment.receipt') }}" class="nav-link {{ (request()->is('payment/receipt*')) ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                    <p>Receipt</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment.history') }}" class="nav-link {{ (request()->is('payment/history*')) ? 'active' : '' }}">
                    <i class="fas fa-calculator nav-icon"></i>
                    <p>Transaction History</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('status.completed') }}" class="nav-link {{ (request()->is('complete*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                  Complete Activities
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('activities.history') }}" class="nav-link {{ (request()->is('history*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  History
                </p>
              </a>
            </li>
            @endrole

            @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')
            <li class="nav-item has-treeview">
              <a href="/#" class="nav-link {{ request()->is('schedule*') ? 'active' : request()->is('lab*') ? 'active' : request()->is('tool*') ? 'active' : request()->is('price*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  General Information
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('lab.index') }}" class="nav-link {{ (request()->is('lab*')) ? 'active' : '' }}">
                    <i class="fas fa-flask nav-icon"></i>
                    <p>Laboratorium</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('tool.index') }}" class="nav-link {{ (request()->is('tool*')) ? 'active' : '' }}">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Tools List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('price.index') }}" class="nav-link {{ (request()->is('price*')) ? 'active' : '' }}">
                    <i class="fas fa-dollar-sign nav-icon"></i>
                    <p>Price List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('schedule.index') }}" class="nav-link {{ (request()->is('schedule*')) ? 'active' : '' }}">
                    <i class="fas fa-clock nav-icon"></i>
                    <p>Schedules</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="/#" class="nav-link {{ (request()->is('activities*')) ? 'active' : '' }}">
                <i class="nav-icon far fa-calendar"></i>
                <p>
                  My Activities
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('activities.index') }}" class="nav-link {{ (request()->is('activities/register*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Registration of Tool Usage</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.booking') }}" class="nav-link {{ (request()->is('activities/status/booking*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Booking Request</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.confirmation') }}" class="nav-link {{ (request()->is('activities/status/confirmation*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Confirmation Schedule</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.reschedule') }}" class="nav-link {{ (request()->is('activities/status/reschedule*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Reschedule Offered List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.approved') }}" class="nav-link {{ (request()->is('activities/status/approved*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Approved Schedule</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.rejected') }}" class="nav-link {{ (request()->is('activities/status/rejected*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Rejected List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('status.canceled') }}" class="nav-link {{ (request()->is('activities/status/canceled*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Canceled List</p>
                  </a>
                </li>
              </ul>
            </li>
            @role('Dosen Unpad|Dosen Non Unpad')
            <li class="nav-item has-treeview">
              <a href="/#" class="nav-link {{ request()->is('student*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  My Students
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('student.index') }}" class="nav-link {{ (request()->is('student/list*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Students List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('student.booking') }}" class="nav-link {{ (request()->is('student/booking*')) ? 'active' : '' }}">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Booking Request</p>
                  </a>
                </li>
<!--                 <li class="nav-item">
                  <a href="{{ route('price.index') }}" class="nav-link {{ (request()->is('price*')) ? 'active' : '' }}">
                    <i class="fas fa-dollar-sign nav-icon"></i>
                    <p>Price List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('schedule.index') }}" class="nav-link {{ (request()->is('schedule*')) ? 'active' : '' }}">
                    <i class="fas fa-clock nav-icon"></i>
                    <p>Schedules</p>
                  </a>
                </li> -->
              </ul>
            </li>
            @endrole
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link {{ (request()->is('payment*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Financial
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('payment.info') }}" class="nav-link {{ (request()->is('payment/information*')) ? 'active' : '' }}">
                    <i class="far fa-credit-card nav-icon"></i>
                    <p>Payment Information</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment.bill') }}" class="nav-link {{ (request()->is('payment/bill*')) ? 'active' : '' }}">
                    <i class="fas fa-money-check-alt nav-icon"></i>
                    <p>Bill</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment.receipt') }}" class="nav-link {{ (request()->is('payment/receipt*')) ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                    <p>Receipt</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment.history') }}" class="nav-link {{ (request()->is('payment/history*')) ? 'active' : '' }}">
                    <i class="fas fa-calculator nav-icon"></i>
                    <p>Transaction History</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('activities.history') }}" class="nav-link {{ (request()->is('history*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  History
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('settings') }}" class="nav-link {{ (request()->is('setting*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('contact') }}" class="nav-link {{ (request()->is('contact*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-phone"></i>
                <p>
                  Contact
                </p>
              </a>
            </li>

            @endrole
<!--             <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Settings
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout').submit();">
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
    <div class="content-wrapper text-sm">
      <!-- Main content -->
      <section class="content" >
        <div class="container-fluid" id="content">
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
<!-- FullCalendar -->
<script src="{{ asset('calendar/main.js') }}"></script>
<!-- DatePicker -->
<script src="{{ asset('js/gijgo.min.js') }}"></script>

@include('modal')
@stack('scripts')

<form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
</body>
</html>
