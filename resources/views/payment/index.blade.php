@extends('layouts.index')

@section('title','FINDER · Payment Information')

@section('content')
<h3 style="padding-top:20px;"><b>Administrasi Pembayaran dan Penagihan</b></h3>
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tool-tab" data-toggle="tab" href="#tool" role="tab" aria-controls="tool" aria-selected="true">Pembayaran Tunai</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Pembayaran Transfer</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="tool" role="tabpanel" aria-labelledby="tool-tab">
        <h4 class="mb-3">Pembayaran tunai dapat dilakukan dengan cara:</h4>
        <ol>
          <li class="numbering">
            Lakukan pembayaran sesuai dengan jumlah tagihan ke sekretariat FiNder U-CoE
          </li>
          <li class="numbering">
            Staff Administrasi kami akan mengubah status pembayaran Anda setelah pembayaran dilakukan.
          </li>
          <li class="numbering">
            Silakan lihat update status pembayaran Anda pada history penggunaan alat setelah pembayaran selesai dilakukan.
          </li>
        </ol>
      </div>
      <div class="tab-pane" id="status" role="tabpanel" aria-labelledby="status-tab">
        <h4 class="mb-3">Pembayaran transfer dapat dilakukan dengan cara:</h4>
        <ol>
          <li class="numbering">
            Lakukan transfer sesuai dengan jumlah tagihan.
          </li>
          <li class="numbering">
            Silakan Transfer ke No Rekening <b>KST</b>
          </li>
          <li class="numbering">
            Upload Bukti Transfer berupa gambar dalam format jpg/png.
          </li>
          <li class="numbering">
            Tunggu hingga Staff Administrasi kami akan melakukan verifikasi dan mengubah status pembayaran.
          </li>
          <li class="numbering">
            Silakan lihat update status pembayaran Anda pada riwayat penggunaan alat.
          </li>
          <li class="numbering">
            Apabila Status Pembayaran belum berubah dalam waktu 2x24 jam setelah Anda melakukan upload bukti transfer. Silakan hubungi admin kami.
          </li>
        </ol>
        <h6>Silakan Upload Bukti Transfer <a href="{{ route('payment.bill') }}">di sini</a>.</h6>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush