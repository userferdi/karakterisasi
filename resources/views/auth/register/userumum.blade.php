@extends('layouts.account')

@section('title', 'FINDER · Register')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30">
    <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="#">
            <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
        </a>
        Register User Umum
    </span>
    <form class="login100-form validate-form" method="POST" action="{{ route('register.store') }}">
        @csrf
        <input id="user" type="hidden" class="form-control" name="user" value="userumum">

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
            <label for="no_id" class="col-md-4 col-form-label text-md-right">ID Number</label>
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
        <legend>Institution/Company</legend>
        <hr class="formik"/>
        <div class="form-group row">
            <label for="institution" class="col-md-4 col-form-label text-md-right">Institution</label>
            <div class="col-md-8">
                <input id="institution" type="text" class="form-control" name="institution" required>
                @error('institution')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
            <div class="col-md-8">
                <input id="address" type="text" class="form-control" name="address" required>
                @error('address')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Registrasi
                </button>
            </div>
        </div>
        <div class="text-center">
            <span class="txt1">Already have an account?
                <a href="{{ route('login') }}" class="txt2 hov1">
                    Login
                </a>here.
            </span>
        </div>
    </form>
</div>
@endsection