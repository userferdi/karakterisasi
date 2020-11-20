@extends('layouts.account')

@section('title', 'FINDER · Register')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30" style="width: 608px;">
    <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
        </a>
        Register Mahasiswa Non Unpad
    </span>
    <form class="login100-form validate-form" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
        @csrf
        <input id="user" type="hidden" class="form-control" name="user" value="mahasiswanonunpad">

        <legend>Email and Password</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
            <div class="col-md-8">
                <input id="email" type="email" class="form-control" name="email" value="" required>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-8">
                <input id="password" type="password" class="form-control" name="password" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
            <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                @error('password-confirm')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <legend>Personal Data</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-8">
                <input id="name" type="text" class="form-control" name="name" required>
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="no_id" class="col-md-4 col-form-label text-md-right">NIM</label>
            <div class="col-md-8">
                <input id="no_id" type="text" class="form-control" name="no_id" required>
                @error('no_id')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="no_hp" class="col-md-4 col-form-label text-md-right">Phone Number</label>
            <div class="col-md-8">
                <input id="no_hp" type="text" class="form-control" name="no_hp" required>
                @error('no_hp')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <legend>Faculty and Study Program</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="university" class="col-md-4 col-form-label text-md-right">University</label>
            <div class="col-md-8">
                <input id="university" type="text" class="form-control" name="university" required>
                @error('university')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="faculty" class="col-md-4 col-form-label text-md-right">Faculty</label>
            <div class="col-md-8">
                <input id="faculty" type="text" class="form-control" name="faculty" required>
                @error('faculty')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="study_program" class="col-md-4 col-form-label text-md-right">Study Program</label>
            <div class="col-md-8">
                <input id="study_program" type="text" class="form-control" name="study_program" required>
                @error('study_program')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <legend>Lecturer</legend>
        <hr class="formik"/>
        <p>Masukan alamat email dosen penanggung jawab Anda. Jika dosen Anda tidak memiliki account, Anda tidak dapat melanjutkan proses booking alat.</p>
        <div class="form-group row">
            <label for="email_lecturer" class="col-md-4 text-md-right p-l-25">E-Mail Address Your Lecturer</label>
            <div class="col-md-8">
                <input id="email_lecturer" type="email" class="form-control" name="email_lecturer" value="" required>
                @error('email_lecturer')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <legend>File Upload</legend>
        <hr class="formik"/>
        <div class="form-group">
            <label>File</label>
            <input type="file" name="image">
            <span class="help-block text-danger"></span>
        </div>
        <div class="form-group container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Registrasi
                </button>
            </div>
        </div>
        <div class="text-center p-t-25">
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