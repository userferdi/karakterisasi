@extends('layouts.welcome')

@section('title', 'FINDER')

@section('content')
<header class="masthead bg-light">
<div class="container">
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-6">
      <h4 class="masthead-heading">SISTEM INFORMASI<br>PENGELOLAAN LAYANAN</h4>
      <p>Ingin melakukan sintesis? Tapi ga bisa ke Lab?<br/>Booking aja di sini. Tinggal kirim sampelnya,<br/>hasilnya akan dikirim ke email kamu.</p>
      <a href="{{ route('login') }}"><button>Login</button></a>
      <a href="{{ route('register') }}"><button>Register</button></a>
    </div>
    <div class="col-sm-4 text-center">
      <br/>
      <!-- <img height="200" src="finder_banner.png"/> -->
      <img class="masthead-avatar" src="finder.png"/>
      <!-- <h4>FINDER<br>Functional NanoPowder</h4> -->
    </div>
  </div>
</div>
</header>
<section class="page-section portfolio" id="portfolio">
  <div class="container">
    <h4 class="page-section-heading text-center text-uppercase text-dark">Informasi Layanan</h4>
    <div class="row">
      <ol>
        <li>
          <h4>Layanan Registrasi</h4>
          <h5>Sebelum melakukan Log-in, pastikan Anda memiliki akun. Silakan klik menu  
            <a href="{{ route('register') }}">Register</a> 
          untuk membuat akun.<br/>Pastikan Anda sudah membaca aturan registrasi Akun SILA yang dapat diunduh 
            <a href="{{ route('register') }}">di sini</a>. 
          Akun SILA tersedia untuk :
          </h5>
          <ul>
            <li>
              <h5>Dosen Unpad</h5>
            </li>
            <li>
              <h5>Mahasiswa Unpad</h5>
            </li>
            <li>
              <h5>Umum</h5>
            </li>
          </ul>
        </li><br>
        <li>
          <h4>Layanan Login</h4>
          <h5>Bagi Anda yang sudah memiliki Akun, silakan klik menu 
            <a href="{{ route('login') }}">Login</a>
          dengan memasukkan email dan password yang Anda buat. Untuk melakukan booking alat, pilih menu Registrasi Penggunaan Alat setelah Anda Log-in.
          </h5>
        </li><br>
        <li>
          <h4>Informasi Daftar Alat & Harga</h4>
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