<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>FINDER</title>
  <link rel="icon" href="{{ asset('finder2.png') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,600,700" rel="stylesheet" type="text/css"/>

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/freelancer.css') }}">
</head>
<body id="page-top">
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top">Functional Nano Powder</a> -->
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <!-- Menu -->
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

<!-- Footer-->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    Jl. Raya Bandung-Sumedang KM. 21 Universitas Padjadjaran<br/>
                    Jawa Barat, Indonesia 45363
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Around the Web</h4>
                <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About FINDER</h4>
                <p class="lead mb-0">
                    Research Center for Functional Nano Powder is .
                </p>
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