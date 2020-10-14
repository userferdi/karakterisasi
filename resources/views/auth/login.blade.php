@extends('layouts.account')

@section('title', 'FINDER · Login')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30" style="width: 482px;">
    <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="#">
            <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
        </a>
        Login FINDER
    </span>
    <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group wrap-input100 validate-input email @error('email') alert-validate @enderror" data-validate="@error('email') {{ $message }} @enderror">
            <input class="input100 @error('email', 'password') has-val @enderror" type="text" name="email" id="email" value="{{ old('email') }}" autocomplete="email">
            <span class="focus-input100" data-placeholder="Email"></span>
        </div>
        <div class="form-group wrap-input100 validate-input password @error('password') alert-validate @enderror" data-validate="@error('password') {{ $message }} @enderror">
            <span class="btn-show-pass">
                <i class="fa fa-eye nav-icon"></i>
            </span>
            <input class="input100 @error('email', 'password') has-val @enderror" type="password" name="password" id="password" value="{{ old('password') }}" autocomplete="current-password">
            <span class="focus-input100" data-placeholder="Password"></span>
        </div>
        <div class="checkbox">
            <label class="txt1" style="font-size: 17.5px;">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div>
        <div class="form-group container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>
        </div>
        <div class="text-center txt1 p-t-25">
            <a href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
        <div class="text-center txt1">
            <span>
                Don't have an account?
            </span>
            <a href="{{ route('register') }}" class="txt2 hov1">
                Register
            </a>
            <span>
                here.
            </span>
        </div>
    </form>
</div>
@endsection