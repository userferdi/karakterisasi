@extends('layouts.index')

@section('title', 'FINDER')

@section('content')
<div class="row">
  &ensp;<a href="{{ route('activities.showform') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Lab Baru" style="margin-bottom:15px; margin-top:15px;"><i class="nav-icon fas fa-plus"></i> Registrasi Penggunaan Alat</a>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Cara Registrasi Penggunaan Alat</strong></h4>
        <p>1. Klik tombol Registrasi Penggunaan Alat untuk melakukan booking penggunaan alat.</p>
        <p>2. Pilih Alat yang akan Anda pinjam kemudian isi form yang disediakan.</p>
        <p>3. Booking Penggunaan Alat yang baru diterima akan masuk pada menu <b>Booking Request</b></p>
        <!-- <p>3. Booking Penggunaan Alat yang belum kami terima akan masuk pada menu <strong>Pending Request</strong>.</p> -->
        <p>4. Kami akan melihat ketersediaan jadwal dan menentukan jadwal penggunaan untuk Anda. Anda dapat melihat jadwal yang telah disetujui pada menu <a href="{{ route('status.approved') }}"><b>All Approved Schedule</b></a>. Anda harus melakukan konfirmasi terhadap jadwal telah kami setujui pada laman tersebut.</p>
        <p>5. Apabila jadwal penuh, Anda dapat melakukan booking ulang. Silakan lihat menu <a href="{{ route('status.reschedule') }}"><b>Reschedule Offered List</b></a>.</p>
        <!-- <p>6. Untuk melihat status penggunaan alat secara keseluruhan Anda dapat melihat pada menu <a href=""><strong>Status Penggunaan Alat</strong></a>.</p> -->
      </div>
    </div>
  </div>
</div>
@endsection