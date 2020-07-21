<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>PRINT-G</title>
  <meta name="description" content="LAB Karakterisasi PRINT-G">
  <meta name="author" content="userferdi">
  <link rel="icon" href="{{ asset('printg.png') }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap core CSS -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <!-- Admin LTE -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/overlayscrollbars.min.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">

  <!-- <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
  <link href="https://getbootstrap.com/docs/4.5/assets/css/docs.min.css" rel="stylesheet">


  <script async src="https://www.google-analytics.com/analytics.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase">
    <div class="container">
        <a style="color:white; margin:4px" href="https://sipa.nrcn.itb.ac.id/pricelist">Laboratorium</a>
        <a style="color:white; margin:4px" href="https://sipa.nrcn.itb.ac.id/listtools">Tools List</a>
        <a style="color:white; margin:4px" href="https://sipa.nrcn.itb.ac.id/pricelist">Price List</a>
      <div style="margin-left:auto">
        <a style="color:white; margin:4px" href="https://sipa.nrcn.itb.ac.id/login">Login</a>
        <a style="color:white; margin:4px" href="https://sipa.nrcn.itb.ac.id/register_index">Register</a>
      </div>
    </div>
  </nav>

<main class="bd-masthead " id="content" role="main">
  <div class="container">
    <br>
    <img class="masthead img-fluid mb-5 d-block mx-auto logo_img" src="{{ asset('printg.png') }}" height="200" width="200">
    <h1 class="text-uppercase mb-0 text-center">SISTEM INFORMASI<br>PENGELOLAAN ALAT</h1>
    <br>
    <h2 class="font-weight-light mb-0 text-center">Pusat Penelitian Nanosains dan Nanoteknologi</h2>
  </div>
</main>

<section class="portfolio" id="portfolio">
    <div class="container">
      <h2 class="text-center text-uppercase mb-0">Informasi Layanan</h2><br>
      <div class="col-lg-12 col-lg-pull-4 tright">
        <ol>
          <li>
            <h4>Layanan Login</h4>
            <h5>Silakan 
              <a href="https://sipa.nrcn.itb.ac.id/login">Login</a> dengan memasukkan username dan password yang Anda buat untuk melakukan registrasi penggunaan alat. Pilih menu Registrasi Penggunaan Alat setelah Anda Log-in.
            </h5>
          </li><br>
          <li>
            <h4>Daftar Akun</h4>
            <h5>Silakan klik <a href="https://drive.google.com/open?id=1pw_FMr_0nes5t2KCVN_KWfg-PGtqKzeI">di sini</a> untuk mengunduh aturan registrasi akun SIPA. Kemudian silakan pilih role dibawah ini untuk melakukan registrasi. </h5>
            <h5>Anda harus memiliki akun terlebih dahulu, sebelum Log-in. Silakan klik menu
              <a href="https://sipa.nrcn.itb.ac.id/register_index">Register</a> untuk membuat akun. Akun SIPA tersedia untuk :
            </h5>
            <ul>
              <li>
                <h5>Dosen Unpad</h5>
              </li>
              <li>
                <h5>Mahasiswa Unpad</h5>
              </li>
              <li>
                <h5>Dosen Non Unpad</h5>
              </li>
              <li>
                <h5>Mahasiswa Non Unpad</h5>
              </li>
              <li>
                <h5>Umum</h5>
              </li>
            </ul>
          </li>
          <li>
            <h4>Daftar Alat & Harga</h4>
            <ul>
              <li>
                <h5><a href ="https://sipa.nrcn.itb.ac.id/listtools">Daftar Alat</a></h5>
              </li>
              <li>
                <h5><a href ="https://sipa.nrcn.itb.ac.id/pricelist">Daftar Harga</a></h5>
              </li>
            </ul>
          </li>

          <p></p>
        </ol>
      </div>
    </div>
  </section>


<footer class="bd-footer text-muted">
  <div class="container-fluid p-3 p-md-5">
<!--     <ul class="bd-footer-links">
      <li><a href="https://github.com/twbs">GitHub</a></li>
      <li><a href="https://twitter.com/getbootstrap">Twitter</a></li>
      <li><a href="/docs/4.5/examples/">Examples</a></li>
      <li><a href="/docs/4.5/about/overview/">About</a></li>
    </ul> -->
    <p>Copyright © 2020 Research Center for Nanosciences and Nanotechnology - Universitas Padjadjaran</p>
  </div>
</footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
  <script src="/docs/4.5/assets/js/docs.min.js"></script>
</body>
</html>
