@extends('layouts.account')

@section('title', 'FINDER · Register')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30" style="width: 520px;">
  <span class="login100-form-title p-b-30" style="font-size: 30px;">
    <a href="{{ route('welcome') }}">
      <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
    </a>
	Register
	</span>
	<p>Silakan klik <a href="https://drive.google.com/file/d/1E_BrpwhQE12ToEpAF-VQr0Qokimc8owo/view?usp=sharing"
	>di sini</a> untuk mengunduh aturan registrasi akun FINDER. </br>Kemudian silakan pilih role dibawah ini untuk melakukan registrasi.</p>
	<hr class="formik"/>
	<p><a href="{{ route('register') }}/form/dosenunpad">Registrasi Dosen Unpad</a></p>
	<!-- <p><a href="{{ route('register') }}/form/dosennonunpad">Registrasi Dosen non Unpad</a></p> -->
	<p><a href="{{ route('register') }}/form/mahasiswaunpad">Registrasi Mahasiswa Unpad</a></p>
	<!-- <p><a href="{{ route('register') }}/form/mahasiswanonunpad">Registrasi Mahasiswa non Unpad</a></p> -->
	<p><a href="{{ route('register') }}/form/userumum">Registrasi Umum</a></p> 
	<hr class="formik"/>
	<div class="text-center">
	    <span class="txt1">
	        Already have an account?
	    </span>
	    <a href="{{ route('login') }}" class="txt2 hov1">
	        Login
	    </a>
	    <span class="txt1">
	        here.
	    </span>
	</div>
</div>
@endsection