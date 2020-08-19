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
  <!-- <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}"> -->
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Admin LTE -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/overlayscrollbars.min.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('main.css') }}">
  <link rel="stylesheet" href="{{ asset('util.css') }}">
</head>
<body>
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30">
      <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="#">
          <img src="{{ asset('printg.png') }}" height="90" width="90" class="logo_img">
        </a>
        Register PRINT-G
      </span>
      @yield('content')
    </div>
  </div>
</div>
    
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

<script src="{{ asset('main.js') }}"></script>
</body>
</html>