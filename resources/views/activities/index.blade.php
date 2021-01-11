@extends('layouts.index')

@section('title', 'FINDER')

@section('content')
<div class="row">
  &ensp;<a href="{{ route('activities.showform') }}" class="btn btn-danger float-right btn-sm" name="Tambah Daftar Lab Baru" style="margin-bottom:15px; margin-top:15px;"><i class="nav-icon fas fa-plus"></i> Registrasi Penggunaan Alat</a>
  &ensp;<a href="#" class="btn btn-danger float-right btn-sm" style="margin-bottom:15px; margin-top:15px;"><i class="nav-icon fas fa-plus"></i> Request Penggunaan Bahan</a>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Cara Registrasi Penggunaan Alat</strong></h4>
        <ol>
          <li class="numbering">
            Klik tombol Registrasi Penggunaan Alat untuk melakukan reservasi.
          </li>
          <li class="numbering">
            Pilih Alat yang akan Anda gunakan.
          </li>
          <li class="numbering">
            Pada menu <a href="{{ route('status.approved') }}"><b>Confirmation Schedule</b></a>, silahkan konfirmasi jadwal yang telah kami setujui.
            <!-- Kami akan melihat ketersediaan jadwal dan menentukan jadwal penggunaan untuk Anda. Anda dapat melihat jadwal yang telah disetujui pada menu <a href="{{ route('status.approved') }}"><b>All Approved Schedule</b></a>. Anda harus melakukan konfirmasi terhadap jadwal telah kami setujui pada laman tersebut. -->
          </li>
          <li class="numbering">
            Apabila jadwal penuh, silahkan reservasi ulang.
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection