@extends('layouts.account')

@section('title', 'Register | PRINTG')

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group wrap-input100 validate-input" data-validate = "Name required">
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
        <a href="https://sipa.nrcn.itb.ac.id/register_index" class="txt2 hov1">
            Login
        </a>
        <span class="txt1">
            here.
        </span>
    </div>
</form>
@endsection