@extends('layouts.index')

@section('title', 'FINDER · Bill')

@section('content')
<div class="row">
&ensp;<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;">Back</a>&ensp;
<a href="{{ route('payment.pdfBill',$model->id) }}" type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;"><i class="fa fa-print fa-sm"></i> Convert into pdf</a>
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
                <td width="60%">{{$model->date_invoice}}</td>
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
                  @if($model->status == 1 || $model->status == 2 || $model->status == 3)
                    Belum dibayar
                  @elseif($model->status == 4 || $model->status == 5)
                    Menunggu verifikasi admin
                  @elseif($model->status == 6 || $model->status == 7 || $model->status == 8 || $model->status == 9)
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
        @if($model->status==6|$model->status==7|$model->status==8|$model->status==9)
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
      </div>
      <br>

<?php
$array = str_split($model->quantity);
$i=0; $j=0; $k=0; $l=0;
  foreach ($array as $char){
    if($char == ' '){
      $quantity[$k] = 0;
      for($j=$l;$j<$i;$j++){
        if(empty($quantity[$k])){
          $quantity[$k] = $array[$j];
        }
        else{
          $quantity[$k] .= $array[$j];
        }
      }
      $l=$i+1;
      $k++;
    }
    $i++;
  }
$array = str_split($model->service);
$i=0; $j=0; $k=0; $l=0;
  foreach ($array as $char){
    if($char == ' '){
      $service[$k] = 0;
      for($j=$l;$j<$i;$j++){
        if(empty($service[$k])){
          $service[$k] = $array[$j];
        }
        else{
          $service[$k] .= $array[$j];
        }
      }
      $l=$i+1;
      $k++;
    }
    $i++;
  }
?>

      <div class="col-lg-12">
        <h4 class="mb-3">Detail Tagihan</h4>
        <table id="table" class="table row-border hover order-column text-sm" width="100%">
          <thead class="thead-light">
            <tr>
              <th> </th>
              <th>Quantity</th>
              <th>Harga</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td><b>Layanan</b></td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <?php $i=0; ?>
            @foreach($service as $s)
            <?php 
              if($model->approves->orders->users->hasRole('Dosen Unpad|Mahasiswa Unpad')){ 
                $harga = $price[$s-1]->price1;
                $diskon = $price[$s-1]->discount;
              }
              if($model->approves->orders->users->hasRole('Dosen Non Unpad|Mahasiswa Non Unpad')){ 
                $harga = $price[$s-1]->price2;
                $diskon = $price[$s-1]->discount;
              }
              if($model->approves->orders->users->hasRole('User Umum')){ 
                $harga = $price[$s-1]->price3;
                $diskon = $price[$s-1]->discount;
              }
              $banyak = $quantity[$i];
              $total = $banyak*$harga*(100-$diskon)/100;
            ?>
            <tr>
                <td>{{$price[$s-1]->service}}</td>
                <td>{{$quantity[$i]}}</td>
                <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
            <?php $i=$i+1; ?>
            @endforeach
            <tr>
                <td><b>Total</b></td>
                <td> </td>
                <td> </td>
                <td>Rp {{ number_format($model->total, 0, ',', '.') }}</td>
            </tr>
          </tbody>
        </table>
        <table class="table row-border hover order-column text-sm" width="100%">
          <thead></thead>
          <tbody>
            <tr>
                <td width="30%"><b>Keterangan Waktu Penggunaan Alat</b></td>
                <td width="20%">{{$model->approves->times->name}}</td>
                <td width="50%"></td>
            </tr>
          </tbody>
        </table>
      </div>
      @if($model->status==2|$model->status==3)
      <div class="col-lg-12">
        <p><b>Silakan Transfer ke No Rekening : 988-00411-07000000 FINDER - BNI.</b></p>
        <p><b>Silakan upload bukti transfer Anda dan tunggu sampai admin kami mengkonfirmasi pembayaran Anda.</b></p>
      </div>
      @endif
    </div>
  </div>
</div>
<br><br>
@endsection