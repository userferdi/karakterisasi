@extends('layouts.account')

@section('title','Login | PRINTG')

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group wrap-input100 validate-input" data-validate = "Email required">
        <input class="input100 {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" autocomplete="email">
        <span class="focus-input100" data-placeholder="Email"></span>
    </div>
    <div class="form-group wrap-input100 validate-input" data-validate="Password required">
        <span class="btn-show-pass">
            <i class="fa fa-eye nav-icon"></i>
        </span>
        <input class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" id="password" autocomplete="current-password">
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
    <div class="text-center p-t-25">
        <a href="https://sipa.nrcn.itb.ac.id/password/reset" class="txt2 hov1">
            Forgot Your Password?
        </a>
    </div>
    <div class="text-center">
        <span class="txt1">
            Don't have an account?
        </span>
        <a href="https://sipa.nrcn.itb.ac.id/register_index" class="txt2 hov1">
            Register
        </a>
        <span class="txt1">
            here.
        </span>
    </div>
</form>
@endsection