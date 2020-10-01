@extends('layouts.index')

@section('title','FINDER · Laboratorium')

@section('content')
<h3 style="padding-top:10px;"><strong>Laboratorium</strong></h3>
<div class="row">
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body">
        <table id="table" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $('#table').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('lab.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', width: '20%', className: 'dt-head-center'},
      {title: 'Kode Lab', data: 'code', name: 'code', width: '12.5%', className: 'dt-head-center'},
      {title: 'Kepala Lab', data: 'head', name: 'head', width: '22.5%', className: 'dt-head-center'},
      {title: 'Deskripsi', data: 'descrip', name: 'descrip', width: '32.5%', className: 'dt-head-center'},
      {title: '', data: 'show', name: 'show', orderable:false, width: '7.5%', className: 'dt-center'}
    ],
  });
</script>
@endpush