@extends('layouts.index')

@section('title','FINDER · Tools List')

@section('content')
<h3 style="padding-top:10px;"><strong>Daftar Alat</strong></h3>
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
    scrollX: true,
    ajax: "{{ route('tool.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', width: '28.15%', className: 'dt-head-center'},
      {title: 'Status', data: 'actives_id', name: 'actives_id', width: '11.2%', className: 'dt-center'},
      {title: 'Detail', data: 'show', name: 'show', orderable:false, width: '7.5%', className: 'dt-center'}
    ],
  });
</script>
@endpush