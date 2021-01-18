<html>
<head>
	<style type="text/css">
		@font-face {
		  font-family: 'Montserrat';
		  font-weight: 400;
		  src: url({{ storage_path('fonts/Montserrat-Regular.ttf') }}) format("truetype");
		}
		@font-face {
		  font-family: 'Montserrat';
		  font-weight: 500;
		  src: url({{ storage_path('fonts/Montserrat-Medium.ttf') }}) format("truetype");
		}
		@font-face {
		  font-family: 'Montserrat';
		  font-weight: 600;
		  src: url({{ storage_path('fonts/Montserrat-SemiBold.ttf') }}) format("truetype");
		}
		@font-face {
		  font-family: 'Montserrat';
		  font-weight: 700;
		  src: url({{ storage_path('fonts/Montserrat-Bold.ttf') }}) format("truetype");
		}
		@font-face {
		  font-family: 'Montserrat';
		  font-weight: 800;
		  src: url({{ storage_path('fonts/Montserrat-ExtraBold.ttf') }}) format("truetype");
		}
		@font-face {
		  font-family: 'Montserrat';
		  font-weight: 900;
		  src: url({{ storage_path('fonts/Montserrat-Black.ttf') }}) format("truetype");
		}
		body {
		  font-family: Montserrat, sans-serif;
		  font-weight: 400;
		  background: white;
		  /*border: 1px solid black;*/
		  padding: 1cm;
		  padding-bottom: 0;
		}
		page {
		  background: white;
		  display: block;
		  margin: 0;
		  /*box-shadow: 0 0 0 rgba(0,0,0,0.5);*/
		}
		page[size="A4"]{
		  width: 21cm;
		  height: 29.7cm; 
		}
		page[size="A4"][layout="landscape"] {
		  width: 29.7cm;
		  height: 21cm;  
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
		a {
		  color: #000;
		  text-decoration: none;
		}
		h5 {
		  font-size: 24px;
		  color: #FF0000;
	    letter-spacing: 1.75px;
	    text-decoration: none; 
	    position: relative; 
	  }
		h5:after {
			position: absolute;
			content: '';
			margin: 0;
			height: 6px;
			bottom: 49rem; 
			left: 0.25cm;
			right: 0;
			width: 12rem;
			background: #5E5E5E;
    }
		h5 {
		  font-size: 24px;
		  color: #FF0000;
	    letter-spacing: 1.75px;
	    text-decoration: none; 
	    position: relative; 
	  }
		h6:after {
			position: absolute;
			content: '';
			margin: 0;
			height: 6px;
			bottom: 10rem; 
			left: 0.25cm;
			right: 0;
			width: 11rem;
			background: #5E5E5E;
    }
		th {
		  font-size: 12px;
		  font-weight: 600;
		  color: #FF0000;
		  padding-top: 29px;
		  padding-bottom: 18px;
		  line-height: 0;
		  margin: 0;
		}
		td {
		  font-size: 12px;
		  line-height: 9px;
		  padding-top: 11px;
		  padding-bottom: 18px;
		  padding-left: 5px;
		  padding-right: 5px;
		  margin: 0;
		}
		.row {
		  display: -ms-flexbox;
		  display: flex;
		}
		.kop {
			font-size: 8px;
			line-height: 3px;
	    letter-spacing: 1.5px;
			padding-left: 12cm;
	    margin-right: -1cm;
		}
		.header-1{
			font-size: 14px;
			line-height: 4px;
			letter-spacing: 1.5px;
		}
		.header-2{
			font-size: 12px;
			line-height: 4px;
			letter-spacing: 1px;
		}
		.footer-1{
			font-weight: 600;
		  color: #FF0000;
		}
		.footer-2{
			font-size: 12px;
			line-height: 3px;
		}
		.pt{
			padding-top: 29px;
		}
		.red{
			color: #f00;
		}
		.table {
			border-collapse: collapse;
		}
		.border {
		  border-top: 3.5px solid #5E5E5E;
		  border-bottom: 3.5px solid #5E5E5E;
		}
		.border-bottom{
		  border-bottom: 3.5px solid #5E5E5E;
		}
	</style>

</head>
<body size="A4">
	<div class="row">
		<img src="finder.png" width="110" height="110" style="margin-top: -1px; padding-left: 9.25cm;"/>
		<div class="kop">
			<p style="font-weight: 800;">FINDER U-COE</p>
			<p style="font-weight: 600;">FUNCTIONAL NANO POWDER</p>
			<p style="font-weight: 600;">UNIVERSITY CENTER OF EXCELLENCE</p><br>
			<p style="font-weight: 500;">Jl. Raya Bandung Sumedang KM. 21</p>
			<p style="font-weight: 500;">Jatinangor, Sumedang</p>
			<p style="font-weight: 500;">Website: <a href="https://finder.ac.id">https://finder.ac.id</a></p>
		</div>
	</div>
	<h5 style="margin-top: -5rem; padding-left: 1cm">KUITANSI</h5>
	<br>
	<div class="row" style="margin-bottom: -1rem;">
		<div class="header-1">
			<p style="font-weight: 600;">KEPADA</p>
			<p style="font-weight: 600;">{{ $model->name }}</p>
			<p style="font-size: 10px; font-weight: 500;">DI TEMPAT</p>
		</div>
		<div class="header-2" style="padding-left: 8cm; margin-right: -1cm">
			<p style="font-weight: 600;">No. Invoice &nbsp; : {{$model->no_invoice}}</p>
			<p style="font-weight: 600; letter-spacing: 1.1px;">No. Kuitansi : {{ $model->no_receipt }}</p>
			<p style="font-weight: 600;">Tanggal &nbsp; &nbsp; &nbsp; &nbsp;: {{ date('d F Y', strtotime("$model->date_invoice")) }}</p>
		</div>
	</div>
	<table id="table" class="table" width="100%">
	  <thead class="thead-light border">
	    <tr>
	      <th class="center" width="32.5%">DESKRIPSI</th>
	      <th class="center" width="17.5%">KUANTITAS</th>
	      <th class="center" width="25%">HARGA (RP)</th>
	      <th class="center" width="25%">TOTAL (RP)</th>
	    </tr>
	  </thead>
	  <tbody class="border-bottom">
	  	<?php $i=0; ?>
	    @foreach($model->costs as $cost)
	    <tr>
	        <td @if($i==0)class="pt"@endif>{{$cost->service}}</td>
	        <td class="center @if($i==0) pt @endif">{{$cost->quantity}}</td>
	        <td class="center @if($i==0) pt @endif">{{ number_format($cost->price, 0, ',', '.') }}</td>
	        <td class="center @if($i==0) pt @endif" style="font-weight: 600;">{{ number_format($cost->quantity*$cost->price, 0, ',', '.') }}</td>
	    </tr>
	    <?php $i++; ?>
	    @endforeach
	    @for(;$i<8;$i++)
	    <tr>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td></td>
	    </tr>
	    @endfor
	  </tbody>
	  <tbody class="">
	</table>
	<table class="table footer-1" width="100%">
	    <tr>
	        <td class="pt" width="50%"></td>
	        <td class="pt border-bottom" width="25%">TOTAL (RP)</td>
	        <td class="pt center border-bottom" width="25%">{{ number_format($model->total, 0, ',', '.') }}</td>
	    </tr>
	  </tbody>
	</table>
	<br><br><br><br><br><br>
	<p class="footer-2" style="padding-left: 13.75cm; font-weight: 600;">ADMIN FiNder</p>
	<br><br><br>
	<div class="border-bottom"></div>
	<p class="center" style="font-size: 8px; padding-top: 4px;"><a class="red" href="https://finder.ac.id">https://finder.ac.id</a> · <a class="red" href="mailto:support.finder@unpad.ac.id">cloud.finder@unpad.ac.id</a></p>
	<div style="padding-top: 1.6cm; margin-bottom: -2.55cm;">
		<p style="border-bottom: 25px solid #f00; margin-left: -2.2cm; margin-right: -2.2cm"></p>
	</div>
</body>
</html>