<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>
  <title>FINDER</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('finder3.png') }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome icons (free version)-->
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
  <!-- <link rel="stylesheet" href="{{ asset('css/util.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('css/freelancer.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
</head>
<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg bg-light text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top">Functional Nano Powder</a> -->
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <!-- Menu -->
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="navbar-brand mx-0 mx-lg-1 "><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger text-dark" href="{{ route('welcome') }}"><img src="{{ asset('finder2.png') }}" width="45"/> FINDER</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger {{ request()->is('tool*') ? 'active' : '' }}" href="{{ request()->is('tool*') ? '#' : route('tool.index') }}">Tools List</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger {{ request()->is('price*') ? 'active' : '' }}" href="{{ request()->is('price*') ? '#' : route('price.index') }}">Price List</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('register') }}">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
  @yield('content')
  </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto mb-3">
                    <div class="row">
                        <img src="/finder.png" height="55"/>
                        <p class="ml-3"><b>FiNder U-CoE<br/>Functional Nano Powder University Centre of Excellence</b></p>
                    </div>
                    <div class="ml-5">
                      <p>Universitas Padjadjaran<br/>Jalan Raya Bandung-Sumedang KM. 21<br/>Jatinangor, Jawa Barat, Indonesia 45363</p>
                      <p>Jam Operasional<br/>Senin - Jumat (08:00 - 17:00 WIB)</p>
                      <p>Contact<br/>Email : <a class="text-dark" href="mailto:admin@finder.ac.id" target="_blank">admin@finder.ac.id</a></p>
                      <a class="btn btn-outline-dark btn-social mx-1" href="#!">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a class="btn btn-outline-dark btn-social mx-1" href="#!">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a class="btn btn-outline-dark btn-social mx-1" href="#!">
                        <i class="fab fa-linkedin-in"></i>
                      </a>
                      <a class="btn btn-outline-dark btn-social mx-1" href="#!">
                        <i class="fab fa-whatsapp"></i>
                      </a>
                    </div>
                </div>
                <div class="col-lg-2 mx-auto mb-4">
                  <ul class="list-reset ml-5">
                    <li class="inline-block">
                      <a class="text-dark" href="{{ route('tool.index') }}">Tools List</a>
                    </li>
                    <li class="mt-3 inline-block">
                      <a class="text-dark" href="{{ route('price.index') }}">Price List</a>
                    </li>
                    <li class="mt-3 inline-block">
                      <a class="text-dark" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="mt-3 inline-block">
                      <a class="text-dark" href="{{ route('register') }}">Register</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-3 mx-auto">
                  <div class="ml-5">
                    <img src="/puipt.png" height="55"/>
                    <img src="/unpad.png" height="55"/>
                  </div>
                </div>
            </div>
        </div>
    </footer>


  <!-- Copyright Section-->
  <div class="copyright py-4 text-center">
      <div class="container"><small>Copyright © 2020 Functional Nano Powder - Universitas Padjadjaran</small></div>
  </div>

<!-- Font Awesome icons -->
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<!-- jQuery Data Tables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<!-- Data Tables -->
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Tidio Live Chat -->
<script src="//code.tidio.co/vxc1ocely84hemzj08gjvedthwszjyap.js" async></script>
@stack('scripts')

</body>
</html>