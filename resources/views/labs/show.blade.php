@extends('layouts.index')

@section('title', 'FINDER · Laboratorium')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <a href=".." type="button" class="btn btn-dark btn-sm" style="margin-bottom:15px;">Back</a>
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Informasi Laboratorium</strong></h4>
        <table id="table" class="table table-hover" style="width:50%">
          <tbody>
            <tr>
                <td width="20%">Nama:</td>
                <td width="80%">{{$model->name}}</td>
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
        <br><br>
        <h4 class="mb-3"><strong>List Kategori Alat</strong></h4>
        <table id="table_tool" class="table table-bordered table-hover table-striped text-sm" style="width:50%"></table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  var detail = $('#table_tool').DataTable({
    aLengthMenu: [[-1], ["All"]],
    responsive: true,
    serverSide: true,
    searching: false,
    paging: false,
    info: false,
    ajax: "{{ route('tool.dt.lab',$model->id) }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama Alat', data: 'name', name: 'name', width: '27.5%', className: 'dt-head-center'},
      {title: '', data: 'show', name: 'show', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });
</script>
@endpush