@extends('layouts.index')

@section('title','FINDER · Home')

@section('content')
<h2 style="padding-top:10px;">Selamat Datang, <strong>{{$user->name}}</strong></h2>
<a href="https://drive.google.com/file/d/1S8rFjQIAtw4VlDuJ0Myl9wV1Li5z2sln/view?usp=sharing" class="btn btn-outline-danger btn-sm">Unduh Workflow Booking Alat</a> &ensp;
<a href="https://drive.google.com/file/d/1fenWsPhHWntsP1_WAfjwq42GCMq4D6ua/view?usp=sharing" class="btn btn-outline-danger btn-sm">Unduh Aturan Registrasi Akun</a><br><br>
<div class="row">
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-light">
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
    <div class="small-box bg-light">
      <div class="inner">
        <h4><strong>Laboratorium</strong></h4>

        <p>List Laboratorium</p>
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
    <div class="small-box bg-light">
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
    <div class="small-box bg-light">
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

<!-- <h4><strong>Status Penggunaan Alat Anda</strong></h4>
<h6>Tidak ada proses Penggunaan Alat yang tercatat dalam sistem kami.</h6> -->

@endsection

@push('scripts')
@endpush
