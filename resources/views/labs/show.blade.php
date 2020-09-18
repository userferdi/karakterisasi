@extends('layouts.client')

@section('title', 'FINDER · Laboratorium')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <a href=".." type="button" class="btn btn-dark btn-sm" style="margin-bottom:15px;">Back</a>
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Informasi Laboratorium</strong></h4>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light"></thead>
          <tbody>
            <tr>
                <td width="12.5%">Nama:</td>
                <td width="87.5%">{{$model->name}}</td>
            </tr>
            <tr>
                <td>Lab Code:</td>
                <td>{{$model->code}}</td>
            </tr>
            <tr>
                <td>Kepala Lab:</td>
                <td>{{$model->head}}</td>
            </tr>
            <tr>
                <td>Deskripsi Alat:</td>
                <td>{{$model->descrip}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection