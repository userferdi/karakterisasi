@extends('layouts.index')

@section('title','FINDER · Profile')

@section('content')
<h4 style="padding-top:10px;">Management Account</h4>
{!! Form::model($model, [
    'route' => ['settings.update.email'],
    'method' => 'PUT',
    'class' => 'needs-validation form',
    'novalidate'
]) !!}
<div class="row">
  <div class="col-sm-7">
    <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label">E-mail Address</label>
      <div class="col-sm-9">
        {!! Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'required']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-md-3 col-form-label">Current Password</label>
      <div class="col-md-9">
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required']) !!}
      </div>
    </div>
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