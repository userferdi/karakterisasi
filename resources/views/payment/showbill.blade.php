@extends('layouts.index')

@section('title', 'FINDER · Show Bill')

@section('content')
<div class="row">
&ensp;<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;">Back</a>&ensp;
<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;"><i class="fa fa-print fa-sm"></i> Convert into pdf</a>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6">
        <h4 class="mb-3">Informasi Tagihan</h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="40%"><b>Tanggal Penagihan</b></td>
                <td width="60%">{{$model->created_at->format('d F Y')}}</td>
            </tr>
            <tr>
                <td><b>Nomor Tagihan</b></td>
                <td>{{$model->no_invoice}}</td>
            </tr>
            <tr>
                <td><b>Nama</b></td>
                <td>{{$model->name}}</td>
            </tr>
            <tr>
                <td><b>Cara Pembayaran</b></td>
                <td>{{$model->approves->orders->plans->name}}</td>
            </tr>
            <tr>
                <td><b>Status Pembayaran</b></td>
                <td>
                  @if($model->status == 1 || $model->status == 2)
                    Belum dibayar
                  @elseif($model->status == 3)
                    Lunas
                  @endif
                </td>
            </tr>
            <tr>
                <td><b>Total Tagihan</b></td>
                <td>Rp {{number_format($model->total, 0, ',', '.')}}</td>
            </tr>
          </tbody>
        </table>
        <br/>
        <br/>
      </div>
      <div class="col-lg-6">
        <h4 class="mb-3">Informasi Penggunaan Alat</h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="40%"><b>Nomor Registrasi</b></td>
                <td width="60%">{{$model->approves->no_regis}}</td>
            </tr>
            <tr>
                <td><b>Nama Peminjam</b></td>
                <td>{{$model->approves->orders->users->name}}</td>
            </tr>
            <tr>
                <td><b>Nama Alat</b></td>
                <td>{{$model->approves->orders->tools->name}}</td>
            </tr>
            <tr>
                <td><b>Tanggal yang disetujui</b></td>
                <td>{{$model->datetime}}</td>
            </tr>
          </tbody>
        </table>
        @if($model->status == 3)
        <h4 class="mb-3">Pembayaran yang telah diterima</h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="40%"><b>Nomor Receipt</b></td>
                <td width="60%"><b>Jumlah Pembayaran</b></td>
            </tr>
            <tr>
                <td>{{$model->no_receipt}}</td>
                <td>Rp {{number_format($model->total, 0, ',', '.')}}</td>
            </tr>
          </tbody>
        </table>
        @endif
        <br/>
        <br/>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush