@extends('layouts.index')

@section('title','FINDER · Profile')

@section('content')
<h4 style="padding-top:10px;">Management Account</h4>
{!! Form::model($model, [
    'route' => ['settings.update'],
    'method' => 'PUT',
    'class' => 'needs-validation form',
    'novalidate'
]) !!}
<div class="row">
  <div class="col-sm-7">
    <div class="form-group row">
      <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
      <div class="col-sm-9">
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'required']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="no_id" class="col-sm-3 col-form-label">
        @role('Dosen Unpad|Dosen Non Unpad')NIDN @endrole
        @role('Mahasiswa Unpad|Mahasiswa Non Unpad')NIM @endrole
        @role('User Umum')No ID @endrole
      </label>
      <div class="col-sm-9">
        {!! Form::text('no_id', old('no_id'), ['class' => 'form-control', 'id' => 'no_id', 'required']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="no_hp" class="col-sm-3 col-form-label">Nomor Ponsel</label>
      <div class="col-sm-9">
        {!! Form::text('no_hp', old('no_hp'), ['class' => 'form-control', 'id' => 'no_hp', 'required']) !!}
      </div>
    </div>
    @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad')
    <div class="form-group row">
      <label for="university" class="col-sm-3 col-form-label">Universitas</label>
      <div class="col-sm-9">
        {!! Form::text('university', old('university'), ['class' => 'form-control', 'id' => 'university', 'required']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="faculty" class="col-sm-3 col-form-label">Fakultas</label>
      <div class="col-sm-9">
        {!! Form::text('faculty', old('faculty'), ['class' => 'form-control', 'id' => 'faculty', 'required']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="study_program" class="col-sm-3 col-form-label">Program Studi</label>
      <div class="col-sm-9">
        {!! Form::text('study_program', old('study_program'), ['class' => 'form-control', 'id' => 'study_program', 'required']) !!}
      </div>
    </div>
    @endrole
    @role('User Umum')
    <div class="form-group row">
      <label for="institution" class="col-sm-3 col-form-label">Lembaga</label>
      <div class="col-sm-9">
        {!! Form::text('institution', old('institution'), ['class' => 'form-control', 'id' => 'institution', 'required']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-3 col-form-label">Alamat</label>
      <div class="col-sm-9">
        {!! Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'address', 'required']) !!}
      </div>
    </div>
    @endrole
    <button type="submit" class="btn btn-primary float-right">Save</button>
  </div>
</div>
{!! Form::close() !!}
@endsection

@push('scripts')
<script>
  $('body').on('submit','.form', function(event){

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
            $('#' + key).addClass('is-invalid');
            $('<div class="invalid-feedback d-block">'+value+'</div>').insertAfter($('#' + key));
          });
        }
      }
    });
  });
</script>
@endpush