@extends('layouts.index')

@section('title', 'FINDER · My Students')

@section('content')

<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <a href=".." type="button" class="btn btn-dark btn-sm" style="margin-bottom:15px;">Back</a>
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Informasi Mahasiswa</strong></h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light"></thead>
          <tbody>
            <tr>
                <td width="10%">Nama:</td>
                <td width="85%">{{$model->users->name}}</td>
            </tr>
            <tr>
                <td>NIM:</td>
                <td>{{$model->no_id}}</td>
            </tr>
            <tr>
                <td>No HP:</td>
                <td>{{$model->no_hp}}</td>
            </tr>
            <tr>
                <td>Jurusan:</td>
                <td>{{$model->study_program}}</td>
            </tr>
            <tr>
                <td>Fakultas:</td>
                <td>{{$model->faculty}}</td>
            </tr>
            <tr>
                <td>Universitas:</td>
                <td>{{$model->university}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush