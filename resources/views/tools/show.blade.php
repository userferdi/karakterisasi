@extends('layouts.client')

@section('title', 'FINDER · Tools List')

@section('content')
<div class="row" style="padding-top:15px;">
  <!-- <a href="{{ route('tool.create') }}" class="btn btn-primary btn-sm" name="Tambah Daftar Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a> -->
  <div class="col-lg-12">
    <a href=".." type="button" class="btn btn-dark btn-sm" style="margin-bottom:15px;">Back</a>
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Informasi Alat</strong>
          <!-- <a href="{{ route('lab.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Lab Baru"><i class="nav-icon fas fa-plus"></i> Add New</a> -->
        </h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light">
          </thead>
          <tbody>
            <tr>
                <td width="15%">Nama Alat:</td>
                <td width="85%">{{$model->name}}</td>
            </tr>
            <tr>
                <td>Deskripsi Alat:</td>
                <td>{{$model->descrip}}</td>
            </tr>
            <tr>
                <td>Preparasi Sample:</td>
                <td>{{$model->sample}}</td>
            </tr>
            <tr>
                <td>Laboratorium</td>
                <td>{{$model->labs->name}}</td>
            </tr>
            <tr>
                <td>Kepala Laboratorium</td>
                <td>{{$model->labs->head}}</td>
            </tr>
            <tr>
                <td>Status Alat</td>
                <td>{{$model->statuses->name}}</td>
            </tr>
            <tr>
                <td>Waktu Penggunaan</td>
                <td>{{$model->periods->name}}</td>
            </tr>
          </tbody>
        </table>
        </br>
        </br>
        <h4>Photos</h4>
        <img src="{{ asset($model->image) }}" width="150"/>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush