<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>FINDER</title>
  <link rel="icon" href="{{ asset('finder3.png') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css"/>

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/freelancer.css') }}">
</head>
<body id="page-top">
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ request()->is('tool*') ? '#tool' : route('tool.index') }}">Tools List</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ request()->is('price*') ? '#price' : route('price.index') }}">Price List</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('register') }}">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
          <div class="col-sm-2 text-right">
            <img src="finder.png" height="40"/>
          </div>
          <div class="col-sm-6">
            <p class="footer-title">FINDER</p>
            <p class="footer-title mb-5">Functional Nano Powder</p>
            <p class="footer-subject">Admin FINDER</p>
            <p class="footer-subject">Hp : 0812xxxxxxxxx</p>
            <p class="footer-subject mb-5">Email : admin@finder.ac.id</p>
            <p class="footer-subject">Jam Operasional</p>
            <p class="footer-subject mb-5">Hari Senin - Minggu, Pukul 08:00 - 20:00 WIB</p>
            <a class="btn btn-outline-dark btn-social mx-1" href="#!">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="btn btn-outline-dark btn-social mx-1" href="#!">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="btn btn-outline-dark btn-social mx-1" href="#!">
              <i class="fab fa-linkedin-in"></i>
            </a><br/><br/>
            <p class="footer-subject">Contact Us</p>
          </div>
          <div class="col-sm-4">
            <p><a class="text-dark" href="{{ route('tool.index') }}">Tools List</a></p>
            <p><a class="text-dark" href="{{ route('price.index') }}">Price List</a></p>
            <p><a class="text-dark" href="{{ route('login') }}">Login</a></p>
            <p><a class="text-dark" href="{{ route('register') }}">Register</a></p>
          </div>
        </div>
    </div>
</footer>


<!-- Copyright Section -->
<div class="copyright py-4 text-center">
    <div class="container"><small>Copyright © 2020 Functional Nano Powder - Universitas Padjadjaran</small></div>
</div>

<!-- Font Awesome icons -->
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

<!-- Bootstrap core JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Core theme JS -->
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