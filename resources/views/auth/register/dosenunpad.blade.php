@extends('layouts.account')

@section('title', 'FINDER · Register')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30">
    <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="#">
            <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
        </a>
        Register Dosen Unpad
    </span>
    <form class="login100-form validate-form" method="POST" action="{{ route('register.store') }}">
        @csrf
        <input id="user" type="hidden" class="form-control" name="user" value="dosenunpad">

        <legend>Email and Password</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
            <div class="col-md-8">
                <input id="email" type="email" class="form-control" name="email" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-8">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
            <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
        <legend>Personal Data</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-8">
                <input id="name" type="text" class="form-control" name="name" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_id" class="col-md-4 col-form-label text-md-right">NIDN</label>
            <div class="col-md-8">
                <input id="no_id" type="text" class="form-control" name="no_id" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_hp" class="col-md-4 col-form-label text-md-right">Phone Number</label>
            <div class="col-md-8">
                <input id="no_hp" type="text" class="form-control" name="no_hp" required>
            </div>
        </div>
        <legend>Faculty and Study Program</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="faculty" class="col-md-4 col-form-label text-md-right">Faculty</label>
            <div class="col-md-8">
                <input id="faculty" type="text" class="form-control" name="faculty" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="study_program" class="col-md-4 col-form-label text-md-right">Study Program</label>
            <div class="col-md-8">
                <input id="study_program" type="text" class="form-control" name="study_program" required>
            </div>
        </div>
        <legend>File Upload</legend>
        <hr class="formik"/>
        <p>Jika Anda menggunakan Email dengan domain Unpad, Anda <strong>TIDAK</strong> perlu melakukan upload file. Jika Anda menggunakan domain lain, silakan Upload file ID yang menunjukan bahwa Anda adalah dosen Unpad.</p>
        <div class="form-group">
            <label>File</label>
            <input type="file" name="image">
            <span class="help-block text-danger"></span>
        </div>

    <!--     <div class="form-group wrap-input100 validate-input" data-validate = "Name required">
            <input class="input100" type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="name">
            <span class="focus-input100" data-placeholder="Nama"></span>
        </div>
        <div class="form-group wrap-input100 validate-input" data-validate = "No ID required">
            <input class="input100" type="text" name="no_id" id="no_id" value="{{ old('no_id') }}" autocomplete="no_id">
            <span class="focus-input100" data-placeholder="No ID"></span>
        </div>
        <div class="form-group wrap-input100 validate-input" data-validate = "No HP required">
            <input class="input100" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" autocomplete="no_hp">
            <span class="focus-input100" data-placeholder="No HP"></span>
        </div>
        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
            <input class="input100" type="text" name="institution" id="institution" value="{{ old('institution') }}" autocomplete="institution">
            <span class="focus-input100" data-placeholder="Lembaga"></span>
        </div>
        <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
            <input class="input100" type="text" name="email" id="email" value="{{ old('email') }}" autocomplete="email">
            <span class="focus-input100" data-placeholder="Email"></span>
        </div>
        <div class="form-group wrap-input100 validate-input" data-validate="Password required">
            <span class="btn-show-pass">
                <i class="fa fa-eye nav-icon validates"></i>
            </span>
            <input class="input100" type="password" name="password" id="password" autocomplete="new-password">
            <span class="focus-input100" data-placeholder="Password"></span>
        </div>
        <div class="form-group wrap-input100 validate-input" data-validate="Password required">
            <span class="btn-show-pass">
                <i class="fa fa-eye nav-icon validates"></i>
            </span>
            <input class="input100" type="password" name="password_confirmation" id="password-confirm" autocomplete="new-password">
            <span class="focus-input100" data-placeholder="Confirm Password"></span>
        </div> -->
        <div class="form-group container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Registrasi
                </button>
            </div>
        </div>
        <div class="text-center p-t-15">
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
    </form>
</div>
@endsection