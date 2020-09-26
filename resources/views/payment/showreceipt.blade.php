@extends('layouts.index')

@section('title', 'FINDER · Receipt')

@section('content')
<div class="row">
&ensp;<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;">Back</a>&ensp;
<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;"><i class="fa fa-print fa-sm"></i> Convert into pdf</a>
</div>
<div class="card">
  <div class="card-body">
    <h2 class="text-center">OFFICIAL RECEIPT</h2>
    <div class="row">
      <div class="col-lg-12">
        <table id="table" class="table row-border hover order-column text-sm" style="width:50%">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="25%"><b>Date</b></td>
                <td width="25%">{{$model->updated_at->format('d F Y')}}</td>
            </tr>
            <tr>
                <td><b>Receipt No</b></td>
                <td>{{$model->no_receipt}}</td>
            </tr>
            <tr>
                <td><b>Invoice No</b></td>
                <td>{{$model->no_invoice}}</td>
            </tr>
            <tr>
                <td><b>Receipt with thanks from</b></td>
                <td>{{$model->name}}</td>
            </tr>
            <tr>
                <td><b>Payment Method</b></td>
                <td>{{$model->approves->orders->plans->name}}</td>
            </tr>
            <tr>
                <td><b>The sum of</b></td>
                <td><b>Rp {{number_format($model->total, 0, ',', '.')}}</b></td>
            </tr>
          </tbody>
        </table>
        <br/>
        <br/>
      </div>

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
        <table id="table" class="table row-border hover order-column text-sm" style="width:100%">
          <thead class="thead-light">
            <tr>
              <th> </th>
              <th>Quantity</th>
              <!-- <th>Waktu Penggunaan Layanan</th> -->
              <th>Harga</th>
              <th>Diskon</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td><b>Layanan</b></td>
                <td> </td>
                <!-- <td> </td> -->
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <?php $i=0; ?>
            @foreach($service as $s)
            <?php
              $banyak = $quantity[$i];
              $harga = $price[$s-1]->price1;
              $total = $banyak*$harga;
            ?>
            <tr>
                <td>{{$price[$s-1]->service}}</td>
                <td>{{$quantity[$i]}}</td>
                <!-- <td></td> -->
                <td>Rp {{ number_format($price[$s-1]->price1, 0, ',', '.') }}</td>
                <td>-</td>
                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
            <?php $i=$i+1; ?>
            @endforeach
            <tr>
                <td><b>Total</b></td>
                <td> </td>
                <!-- <td> </td> -->
                <td> </td>
                <td> </td>
                <td>Rp {{ number_format($model->total, 0, ',', '.') }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br><br>
@endsection