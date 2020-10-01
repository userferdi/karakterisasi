@extends('layouts.index')

@section('title', 'FINDER · Settings')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pass-tab" data-toggle="tab" href="#pass" role="tab" aria-controls="pass" aria-selected="false">Change Password</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <a href="{{ route('settings.edit') }}" class="btn btn-primary btn-sm modal-show" name="Tambah Daftar Alat Baru">Edit Profile</a>
        <table id="table_tool" class="table table-striped table-bordered text-sm" style="width:100%">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="40%"><b>Nama Lengkap</b></td>
                <td width="60%">{{$model->name}}</td>
            </tr>
            <tr>
              @role('Dosen Unpad|Dosen Non Unpad')
                <td><b>NIDN</b></td>
                <td>{{$model->profiles->no_id}}</td>
              @endrole
              @role('Mahasiswa Unpad|Mahasiswa Non Unpad')
                <td><b>NIM</b></td>
                <td>{{$model->profiles->no_id}}</td>
            </tr>
            <tr>
                <td><b>Dosen Penanggung Jawab</b></td>
                <td>{{$model->profiles->email_lecturer}}</td>
              @endrole
            </tr>
            @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad')
            <tr>
                <td><b>Universitas</b></td>
                <td>{{$model->profiles->university}}</td>
            </tr>
            <tr>
                <td><b>Fakultas</b></td>
                <td>{{$model->profiles->faculty}}</td>
            </tr>
            <tr>
                <td><b>Program Studi</b></td>
                <td>{{$model->profiles->study_program}}</td>
            </tr>
            @endrole
            <tr>
                <td><b>Email</b></td>
                <td>{{$model->email}} @if($model->email_verified_at!=NULL)<i class="fa fa-check">verified</i>@endif <a href="{{ route('settings.edit.email') }}" class="btn-sm btn-primary">Change email</a></td>
            </tr>
            <tr>
                <td><b>No Hp</b></td>
                <td>{{$model->profiles->no_hp}}</td>
            </tr>
            <tr>
                <td><b>Role</b></td>
                <td>{{$model->roles[0]->name}}</td>
            </tr>
            @role('User Umum')
              <td><b>NIM</b></td>
              <td>{{$model->profiles->no_id}}</td>
            @endrole
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="pass" role="tabpanel" aria-labelledby="pass-tab">
        <div class="col-sm-8">
{!! Form::model($model, [
    'route' => ['settings.password'],
    'method' => 'PUT',
    'class' => 'needs-validation form',
    'novalidate'
]) !!}
          <div class="form-group row">
            <label for="password" class="col-md-3 col-form-label text-md-right">Current Password</label>
            <div class="col-md-9">
              {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required']) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="newpassword" class="col-md-3 col-form-label text-md-right">New Password</label>
            <div class="col-md-9">
              {!! Form::password('newpassword', ['class' => 'form-control', 'id' => 'newpassword', 'required']) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="newpassword_confirmation" class="col-md-3 col-form-label text-md-right">Repeat New Password</label>
            <div class="col-md-9">
              {!! Form::password('newpassword_confirmation', ['class' => 'form-control', 'id' => 'newpassword_confirmation', 'required']) !!}
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $('body').on('submit','.form', function(event){
    event.preventDefault();

    var form = $('.form'),
        url = form.attr('action'),
        method = form.attr('method');

    $.ajax({
      url : url,
      method : method,
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      processData: false,

      success: function(data){
        form.find('.invalid-feedback').remove();
        form.find('.is-invalid').removeClass('is-invalid');
        $('#password').val('');
        $('#newpassword').val('');
        $('#newpassword_confirmation').val('');
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#28a745',
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        Toast.fire({
          type: 'success',
          title: 'Data has been saved!'
        })
      },
      error: function(xhr){
        var res = xhr.responseJSON;
        if ($.isEmptyObject(res) == false) {
          form.find('.invalid-feedback').remove();
          form.find('.is-invalid').removeClass('is-invalid');
          $.each(res.errors, function (key, value) {
            $('#' + key)
              .addClass('is-invalid')
              .after('<div class="invalid-feedback d-block">'+value+'</div>');
          });
        }
      }
    });
  });
</script>
@endpush