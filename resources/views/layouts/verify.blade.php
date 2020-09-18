<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('finder.png') }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CSRF TOKEN --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <!-- Admin LTE -->
  <link rel="stylesheet" href="{{ asset('css/adminlteEdit.css') }}">
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
    <nav class="main-header header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
      <a class="brand-link" style="background-color: #343a40;">
        <img src="{{ asset('finder.jpg') }}" class="brand-image img-circle elevation-3" style="font-size: 16px;">
        <span class="brand-text" style="color: #fff;"><strong>FINDER</strong></span>
      </a>
          <!-- <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> -->
        </li>
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <!-- <aside class="main-sidebar sidebar-light-primary elevation-4"> -->
      <!-- Brand Logo -->
    <!-- </aside> -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: none;">
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

<form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
@include('modal')
@stack('scripts')
</body>
</html>
