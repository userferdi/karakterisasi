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

<html>
	<head>
	<style type="text/css">
		body {
		  background: white;
		  /*border: 1px solid black;*/
		  padding: 1.8cm;
		  padding-left: 1.68cm;
		}
		page {
		  background: white;
		  display: block;
		  margin: 0 auto;
		  margin-bottom: 0.5cm;
		  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
		}
		page[size="A4"] {  
		  width: 21cm;
		  height: 29.7cm; 
		}
		page[size="A4"][layout="landscape"] {
		  width: 29.7cm;
		  height: 21cm;  
		}
		page[size="A3"] {
		  width: 29.7cm;
		  height: 42cm;
		}
		page[size="A3"][layout="landscape"] {
		  width: 42cm;
		  height: 29.7cm;  
		}
		page[size="A5"] {
		  width: 14.8cm;
		  height: 21cm;
		}
		page[size="A5"][layout="landscape"] {
		  width: 21cm;
		  height: 14.8cm;  
		}
		@media print {
		  body, page {
		    margin: 0;
		    box-shadow: 0;
		  }
		}
		.text {
			padding-left: 0.075cm;
		}
		.text-md {
		  font-size: 12px;
		  line-height: 24px;
		}
		.right {
		  text-align: right;
		}
		.center {
		  text-align: center;
		}
		.justify {
		  text-align: justify;
		}
		h5 {
		  font-size: 16px;
		  line-height: 16px;
		  margin-top: 0;
		  margin-bottom: 8px;
		}
		p{
		  font-size: 13px;
		  line-height: 19.5px;
		  margin-top: 0;
		  margin-bottom: 0;
		}
		th {
		  font-size: 16px;
		  line-height: 30px;
		  margin-top: 0;
		  margin-bottom: 0;
		}
		td {
		  font-size: 13px;
		  line-height: 19.5px;
		  margin-top: 0;
		  margin-bottom: 0;
		}
		.table td {
		  font-size: 13px;
		  line-height: 26px;
		  margin-top: 0;
		  margin-bottom: 0;
		}
		.border {
		  border-top: 1px solid #aaa;
		  border-bottom: 1px solid #aaa;
		}
		.border-bottom{
		  border-bottom: 1px solid #aaa;
		}
	</style>
	</head>
	<body size="A4">
    <img src="" width="612" height="792"/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <table width="100%">
      <thead></thead>
      <tbody>
        <tr>
          <td width="30%"><b>Date</b></td>
          <td width="70%">{{ date('l, d F Y', strtotime("$model->date_receipt")) }}</td>
        </tr>
        <tr>
          <td><b>Receipt No</b></td>
          <td>{{ $model->no_receipt }}</td>
        </tr>
        <tr>
          <td><b>Invoice No</b></td>
          <td>{{ $model->no_invoice }}</td>
        </tr>
        <tr>
          <td><b>Receipt with thanks from</b></td>
          <td>{{ $model->name }}</td>
        </tr>
        <tr>
          <td><b>Payment Method</b></td>
          <td>{{ $model->approves->orders->plans->name }}</td>
        </tr>
        <tr>
          <td><b>The sum of</b></td>
          <td><b>Rp {{ number_format($model->total, 0, ',', '.') }}</b></td>
        </tr>
<!--         <tr>
          <td><b>Rest of the bill</b></td>
          <td>-</td>
        </tr> -->
      </tbody>
    </table>
    <br/>
		<br/>
    <h5 class="text"><b>Description</b></h5>
    <table id="table" class="text-md table row-border" width="100%">
      <thead class="thead-light border">
        <tr>
          <th><b> </b></th>
          <th class="center"><b>Quantity</b></th>
          <th class="center"><b>Harga</b></th>
          <th class="center"><b>Diskon</b></th>
          <th class="center"><b>Total</b></th>
        </tr>
      </thead>
      <tbody class="border-bottom">
        <tr>
            <td><b>Layanan</b></td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <?php $i=0; ?>
        @foreach($service as $s)
        <?php 
          if($model->approves->orders->users->hasRole('Dosen Unpad|Mahasiswa Unpad')){ 
            $harga = $price[$s-1]->price1;
          }
          if($model->approves->orders->users->hasRole('Dosen Non Unpad|Mahasiswa Non Unpad')){ 
            $harga = $price[$s-1]->price2;
          }
          if($model->approves->orders->users->hasRole('User Umum')){ 
            $harga = $price[$s-1]->price3;
          }
          $banyak = $quantity[$i];
          $total = $banyak*$harga;
        ?>
        <tr>
            <td>{{$price[$s-1]->service}}</td>
            <td class="center">{{$quantity[$i]}}</td>
            <td class="center">Rp {{ number_format($harga, 0, ',', '.') }}</td>
            <td class="center">-</td>
            <td class="center">Rp {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
        <?php $i=$i+1; ?>
        @endforeach
        <tr>
            <td><b>Total</b></td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td class="center">Rp {{ number_format($model->total, 0, ',', '.') }}</td>
        </tr>
      </tbody>
    </table>
    <br/>
    <br/>
    <img class="right" src="" width="612" height="792"/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <p class="text right">Admin FINDER</p>
	</body>
</html>