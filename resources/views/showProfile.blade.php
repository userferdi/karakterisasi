@extends('layouts.index')

@section('title', 'FINDER · Settings')

@section('content')
<div class="row">
&ensp;<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;">Back</a>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h3><strong>Profile User</strong></h3>
        <table id="table_tool" class="table table-striped table-bordered text-sm" style="width:100%">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="40%"><b>Nama Lengkap</b></td>
                <td width="60%">{{$model->name}}</td>
            </tr>
            <tr>
              @if($model->roles[0]->name=='Dosen Unpad'||$model->roles[0]->name=='Dosen Non Unpad')
                <td><b>NIDN</b></td>
                <td>{{$model->profiles->no_id}}</td>
              @endif
              @if($model->roles[0]->name=='Mahasiswa Unpad'||$model->roles[0]->name=='Mahasiswa Non Unpad')
                <td><b>NIM</b></td>
                <td>{{$model->profiles->no_id}}</td>
            </tr>
            <tr>
                <td><b>Dosen Pembimbing</b></td>
              @if($model->profiles->email_lecturer!=NULL)
                <td>
                  {{$model->lecturer}} ({{$model->profiles->email_lecturer}})
                </td>
              @endif
              @endif
            </tr>
            @if($model->roles[0]->name=='Dosen Unpad'||$model->roles[0]->name=='Dosen Non Unpad'||$model->roles[0]->name=='Mahasiswa Unpad'||$model->roles[0]->name=='Mahasiswa Non Unpad')
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
            @endif
            <tr>
                <td><b>Email</b></td>
                <td>{{$model->email}}</td>
            </tr>
            <tr>
                <td><b>No Hp</b></td>
                <td>{{$model->profiles->no_hp}}</td>
            </tr>
            <tr>
                <td><b>Role</b></td>
                <td>{{$model->roles[0]->name}}</td>
            </tr>
            @if($model->roles[0]->name=='User Umum')
            <tr>
              <td><b>Lembaga</b></td>
              <td>{{$model->profiles->institution}}</td>
            </tr>
            <tr>
              <td><b>Alamat</b></td>
              <td>{{$model->profiles->address}}</td>
            </tr>
            @endif
          </tbody>
        </table>
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