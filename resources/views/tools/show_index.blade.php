@extends('layouts.list')

@section('title', 'FINDER · Tools List')

@section('content')
<section class="page-section tool" id="tool" style="padding:40px; margin-top:100px">
<div class="row">
  <div class="col-lg-12">
    <a href=".." type="button" class="btn btn-dark btn-sm" style="margin-bottom:15px;">< Back</a>
    <h4 class="mb-3"><strong>Informasi Alat</strong></h4>
    <table id="table" class="table table-striped table-hover text-sm">
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
            <td>{{$model->actives->name}}</td>
        </tr>
        <tr>
            <td>Waktu Penggunaan</td>
            <td>{{$model->usages->name}}</td>
        </tr>
      </tbody>
    </table>
    </br>
    </br>
    <h4>Photos</h4>
    <img src="{{ asset($model->image) }}" width="150"/>
  </div>
</div>
</section>
@endsection

@push('scripts')
<script>
</script>
@endpush