@extends('layout.client')

@section('title','Home - PRINTG')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h4><strong>Schedules</strong></h4>

        <p>Jadwal Peminjaman</p>
      </div>
      <div class="icon">
        <i class="far fa-clock"></i>
      </div>
      <a href="schedule" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h4><strong>Laboratorium</strong></h4>

        <p>Total: 3</p>
      </div>
      <div class="icon">
        <i class="fas fa-flask"></i>
      </div>
      <a href="lab" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h4><strong>Tools List</strong></h4>

        <p>List Alat</p>
      </div>
      <div class="icon">
        <i class="fas fa-cog"></i>
      </div>
      <a href="tool" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h4><strong>Price List</strong></h4>

        <p>List Harga</p>
      </div>
      <div class="icon">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <a href="price" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>

<h2>Selamat Datang, <strong>Ferdian Maulana</strong></h2>
<a href="https://drive.google.com/file/d/1ZZJEDmb_dlf9WHoV8-fpZi52JPtHDWwB/view" class="btn btn-primary btn-sm">Unduh Workflow Booking Alat</a>
<a href="https://drive.google.com/open?id=1gcDbrORgSCctPLyy4Mh-xFXBxkgbkWUu" class="btn btn-success btn-sm">Unduh Deskripsi Alur Booking Alat</a>
<a href="https://drive.google.com/open?id=1pw_FMr_0nes5t2KCVN_KWfg-PGtqKzeI" class="btn btn-warning btn-sm">Unduh Aturan Registrasi Akun</a><br><br>
<h4><strong>Status Penggunaan Alat Anda</strong></h4>
<h6>Tidak ada proses Penggunaan Alat yang tercatat dalam sistem kami.</h6>

@endsection

@push('scripts')
@endpush