<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>FINDER</title>
  <meta name=description content="Functional Nano Powder University Center of Excellence (FiNder U CoE) is a Research Centre at Universitas Padjadajaran. FiNder U CoE is actively engaged in Nano Science and Technology Research & Business Development (RBD) aims to promote innovative technology for Indonesian industries enabling globally competitive scope and to contribute novel alternatives to address the present and future key social challenges. Enabling Nanotechnology to solve real world problems is expected to provide new opportunities with broad perspective of applications. The significant contributions for FiNder U CoE are in the field of biomaterial, pharmacy, sustainable energy, sustainable agro & food, added values of natural resources and clean water for a growing population.">
  <link rel="icon" href="{{ asset('finder3.png') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet" type="text/css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

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
            <div class="row ml-auto">
                <div class="col-lg-7 mx-auto mb-3">
                    <div class="row">
                        <img src="finder.png" height="55"/>
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
                    <img src="puipt.png" height="55"/>
                    <img src="unpad.png" height="55"/>
                  </div>
                </div>
            </div>
        </div>
    </footer>


<!-- Copyright Section -->
<div class="copyright py-4 text-center">
    <div class="container">
      <!-- <small><strong>Copyright &copy; 2020 <a href="#">FiNder U-CoE</a>.</strong> All rights reserved.</small> -->
      <small>Copyright &copy; 2020 Functional Nano Powder - Universitas Padjadjaran</small>
    </div>
</div>

<!-- Font Awesome icons -->
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<!-- jQuery Data Tables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<!-- Data Tables -->
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Core theme JS -->
<script src="{{ asset('js/scripts.js') }}"></script>
<!-- Tidio Live Chat -->
<script src="//code.tidio.co/vxc1ocely84hemzj08gjvedthwszjyap.js" async></script>
@stack('scripts')

</body>
</html>
