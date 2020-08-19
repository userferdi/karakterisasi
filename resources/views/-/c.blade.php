<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Register</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('printg.png') }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <!-- Admin LTE -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/overlayscrollbars.min.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('util.css') }}">
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30">
            <form class="login100-form validate-form" method="POST" action="https://sipa.nrcn.itb.ac.id/login">
                <span class="login100-form-title p-b-30" style="font-size: 30px;">
                    <a href="#">
                        <img src="{{ asset('printg.png') }}" height="90" width="90" class="logo_img">
                    </a>
                    Register PRINT-G
                </span>
                <div class="row">
                    <!-- <div class="col-lg-6"> -->
                        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
                            <input class="input100" type="text" name="email" id="email">
                            <span class="focus-input100" data-placeholder="Email"></span>
                        </div>
                        <div class="form-group wrap-input100 validate-input" data-validate="Password required">
                            <span class="btn-show-pass">
                                <i class="fa fa-eye nav-icon"></i>
                            </span>
                            <input class="input100" type="password" name="password" id="password">
                            <span class="focus-input100" data-placeholder="Password"></span>
                        </div>
                        <div class="form-group wrap-input100 validate-input" data-validate="Password required">
                            <span class="btn-show-pass">
                                <i class="fa fa-eye nav-icon"></i>
                            </span>
                            <input class="input100" type="password" name="password_confirm" id="password_confirm">
                            <span class="focus-input100" data-placeholder="Confirm Password"></span>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-lg-6"> -->
                        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
                            <input class="input100" type="text" name="name" id="name">
                            <span class="focus-input100" data-placeholder="Nama"></span>
                        </div>
                        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
                            <input class="input100" type="text" name="id_number" id="id_number">
                            <span class="focus-input100" data-placeholder="No ID"></span>
                        </div>
                        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
                            <input class="input100" type="text" name="phone_number" id="phone_number">
                            <span class="focus-input100" data-placeholder="No HP"></span>
                        </div>
                        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
                            <input class="input100" type="text" name="institution" id="institution">
                            <span class="focus-input100" data-placeholder="Lembaga"></span>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="form-group container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Registrasi
                        </button>
                    </div>
                </div>
                <div class="text-center p-t-25">
                    <span class="txt1">
                        Already have an account?
                    </span>
                    <a href="https://sipa.nrcn.itb.ac.id/register_index" class="txt2 hov1">
                        Login
                    </a>
                    <span class="txt1">
                        here.
                    </span>
                </div>
            </form>
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