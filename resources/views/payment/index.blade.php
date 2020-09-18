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
        <h4>Anda dapat melakukan pembayaran tunai dengan cara sebagai berikut:</h4>
        <p> 1. Lakukan pembayaran sesuai dengan jumlah tagihan ke sekretariat SIPA FINDER</p>  
        <p> 2. Staff Administrasi kami akan mengubah status pembayaran Anda setelah pembayaran dilakukan.</p>
        <p> 3. Silakan lihat update status pembayaran Anda pada history penggunaan alat setelah pembayaran selesai dilakukan.</p>
      </div>
      <div class="tab-pane" id="status" role="tabpanel" aria-labelledby="status-tab">
        <h4>Anda dapat melakukan pembayaran transfer dengan cara sebagai berikut:</h4>
        <p> 1. Lakukan transfer sesuai dengan jumlah tagihan penggunaan alat Anda.</p>
        <p> 2. Silakan Transfer ke No Rekening <b>Virtual Account</b> : <b>988-00411-07000000 LPPM Kegiatan PP Nanosains dan Nanoteknologi - BNI</b></p>
        <p> 3. Upload Bukti Transfer berupa gambar dalam format jpg/png.</p>
        <p> 4. Anda juga dapat menyerahkan bukti transfer ke sekretariat SIPA FINDER.</p>
        <p> 5. Tunggu hingga Staff Administrasi kami akan melakukan verifikasi dan mengubah status pembayaran.</p>
        <p> 6. Silakan lihat update status pembayaran Anda pada history penggunaan alat.</p>
        <p> 7. Apabila Status Pembayaran belum berubah dalam waktu 2x24 jam setelah Anda melakukan upload bukti transfer. Silakan hubungi kontak admin kami.</p><br/>
        <h6>Silakan Upload Bukti Transfer sesuai dengan tagihan Anda pada menu <strong>Penagihan</strong> atau dengan klik tombol di bawah ini.</h6>
        <p><a href="{{ route('payment.bill') }}" class="btn-sm btn-primary">Upload Bukti Transfer</a></p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush