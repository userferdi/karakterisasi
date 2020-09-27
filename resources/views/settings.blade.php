@extends('layouts.index')

@section('title', 'FINDER · Settings')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change Password</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <a href="" class="btn btn-primary btn-sm modal-show" name="Tambah Daftar Alat Baru">Edit Profile</a>
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
            <tr>
                <td><b>Email</b></td>
                <td>{{$model->email}} @if($model->email_verified_at!=NULL)<i class="fa fa-check">verified</i>@endif <a href="" class="btn-sm btn-primary">Change email</a></td>
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
      <div class="tab-pane" id="password" role="tabpanel" aria-labelledby="password-tab">
        <form class="form-horizontal" method="POST" action="https://sipa.nrcn.itb.ac.id/account_administration/passwd">
          <div class="form-group row">
            <label for="password" class="col-md-2 col-form-label text-md-right">Current Password</label>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <input id="password" type="password" class="form-control" name="password" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="new-password" class="col-md-2 col-form-label text-md-right">New Password</label>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <input id="new-password" type="password" class="form-control" name="new_password" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">Repeat New Password</label>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush