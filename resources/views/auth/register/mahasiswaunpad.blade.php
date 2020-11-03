@extends('layouts.account')

@section('title', 'FINDER · Register')

@section('content')
<div class="wrap-login100 p-l-45 p-r-45 p-t-45 p-b-30">
    <span class="login100-form-title p-b-30" style="font-size: 30px;">
        <a href="#">
            <img src="{{ asset('finder.png') }}" height="90" width="90" class="logo_img">
        </a>
        Register Mahasiswa Unpad
    </span>
    <form class="login100-form validate-form" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
        @csrf
        <input id="user" type="hidden" class="form-control" name="user" value="mahasiswaunpad">

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
            <label for="no_id" class="col-md-4 col-form-label text-md-right">NPM</label>
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
            <label for="faculty" class="col-md-4 col-form-label text-md-right">Faculty</label>
            <div class="col-md-8">
                <select id="faculty" type="text" class="form-control" name="faculty" value="" onchange="onSelectFaculty(this.value,'#study_program')">
                    <option value="0" disabled selected>Choose Faculty</option>
                    @foreach($faculty as $f)
                    <option value="{{$f->id}}">{{$f->name}}</option>
                    @endforeach
                </select>
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
                <select id="study_program" type="text" class="form-control" name="study_program" value=""><option></option></select>
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
            <label for="email_lecturer" class="col-md-4 text-md-right">E-Mail Address Your Lecturer</label>
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

@push('scripts')
<script>
    $(document).ready(function() {
      $("#faculty").val('0');
    });

    function onSelectFaculty(value,childEl) {
        $('#study_program').empty();
        $('#study_program').append('<option value="0" disabled selected>Choose Study Program</option>');
        $.ajax({
            type: 'GET',
            url: '/register/datatable/studyprogram/' + value,
            success: function (response) {
                $('#study_program').append(response);
            }
        });
    }
</script>
@endpush