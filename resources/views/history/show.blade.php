@extends('layouts.index')

@section('title', 'FINDER · History')

@section('content')
<div class="row">
&ensp;<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;">Back</a>&ensp;
<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;"><i class="fa fa-print fa-sm"></i> Convert into pdf</a>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6" style="padding-right: 1rem;">
        <h4>Detail Informasi Penggunaan Alat</h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="50%"><b>Nomor Registrasi</b></td>
                <td width="50%">{{$model->no_regis}}</td>
            </tr>
            <tr>
                <td><b>Nama Pengguna</b></td>
                <td>{{$model->orders->users->name}}</td>
            </tr>
            <tr>
                <td><b>Nama Alat</b></td>
                <td>{{$model->orders->tools->name}}</td>
            </tr>
            <tr>
                <td><b>Status Penggunaan Alat</b></td>
                <td><b>
                  @if($model->status==2 || $model->status==3)
                    Waiting for payment
                  @elseif($model->status==4)
                    Completed
                  @endif
                </b></td>
            </tr>
            <tr>
                <td><b>Metode Pembayaran</b></td>
                <td>{{$model->orders->plans->name}}</td>
            </tr>
            <tr>
                <td><b>Waktu Pengisian Formulir</b></td>
                <td>{{$model->orders->created_at}}</td>
            </tr>
          </tbody>
        </table>
        <h4>Administrasi Pembayaran</h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="50%"><b>Tanggal Penagihan</b></td>
                <td width="50%">{{$model->payments->date_invoice}}</td>
            </tr>
            <tr>
                <td><b>No Tagihan</b></td>
                <td>
                <a href="{{ route('payment.showBill', $model->payments->id) }}">{{$model->payments->no_invoice}}</a>
                </td>
            </tr>
            <tr>
                <td><b>Tanggal Penagihan</b></td>
                <td>{{$model->payments->date_receipt}}</td>
            </tr>
            <tr>
                <td><b>No Receipt</b></td>
                <td>
                <a href="{{ route('payment.showReceipt', $model->payments->id) }}">                  {{$model->payments->no_receipt}}</a>
                </td>
            </tr>
            <tr>
                <td><b>Nama</b></td>
                <td>{{$model->name}}</td>
            </tr>
            <tr>
                <td><b>Status Pembayaran</b></td>
                <td><b>
                  @if($model->payments->status==1|$model->payments->status==2|$model->payments->status==3|$model->payments->status==4|$model->payments->status==5)
                    Belum dibayar
                  @elseif($model->payments->status==6|$model->payments->status==7|$model->payments->status==8|$model->payments->status==9)
                    Lunas
                  @endif
                </b></td>
            </tr>
            <tr>
                <td><b>Nominal</b></td>
                <td>Rp {{number_format($model->payments->total, 0, ',', '.')}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php if($model->orders->users->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad')){ ?>
      <div class="col-lg-6" style="padding-left: 1rem;">
        <h4>Dosen Penanggung Jawab</h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="40%"><b>Nama</b></td>
                <td width="60%">{{$model->no_regis}}</td>
            </tr>
            <tr>
                <td><b>Program Studi</b></td>
                <td>{{$model->orders->users->name}}</td>
            </tr>
            <tr>
                <td><b>Fakultas</b></td>
                <td>{{$model->orders->tools->name}}</td>
            </tr>
            <tr>
                <td><b>Universitas</b></td>
                <td>{{$model->datetime}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php } ?>
      <br>


    </div>
  </div>
</div>
<br><br>
@endsection