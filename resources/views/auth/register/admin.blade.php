@extends('layouts.account')

@section('title', 'FINDER · Register')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30">
    <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="#">
            <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
        </a>
        Register Admin
    </span>
    <form class="login100-form validate-form" method="POST" action="{{ route('register.store') }}">
        @csrf
        <input id="user" type="hidden" class="form-control" name="user" value="admin">

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