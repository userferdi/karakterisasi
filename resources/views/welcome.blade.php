@extends('layouts.welcome')

@section('title', 'FINDER')

@section('content')
<header class="masthead bg-light text-white text-center">
<div class="container d-flex align-items-center flex-column">
  <img class="masthead-avatar" src="finder.png"/>
  <h4 class="masthead-heading text-uppercase text-dark">SISTEM INFORMASI<br>PENGELOLAAN LAYANAN</h4>
  <h4 class="masthead-subheading text-dark">FINDER<br>Functional Nano Powder</h4>
</div>
</header>
<section class="page-section portfolio" id="portfolio">
  <div class="container">
    <h4 class="page-section-heading text-center text-uppercase text-dark">Informasi Layanan</h4>
    <div class="row">
      <ol>
        <li>
          <h4>Layanan Login</h4>
          <h5>Silakan 
            <a href="{{ route('login') }}">Login</a> dengan memasukkan username dan password yang Anda buat untuk melakukan registrasi penggunaan alat. Pilih menu Registrasi Penggunaan Alat setelah Anda Log-in.
          </h5>
        </li><br>
        <li>
          <h4>Daftar Akun</h4>
          <h5>Anda harus memiliki akun terlebih dahulu, sebelum Log-in. Silakan klik menu
            <a href="{{ route('register') }}">Register</a> untuk membuat akun. Akun tersedia untuk :
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
        </li><br>
        <li>
          <h4>Daftar Alat & Harga</h4>
          <ul>
            <li>
              <h5><a href ="{{ route('tool.index') }}">Daftar Alat</a></h5>
            </li>
            <li>
              <h5><a href ="{{ route('price.index') }}">Daftar Harga</a></h5>
            </li>
          </ul>
        </li>
      </ol>
    </div>
  </div>
</section>

@endsection