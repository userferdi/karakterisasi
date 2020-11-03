@extends('layouts.list')

@section('title', 'FINDER · Tools List')

@section('content')
<div style="padding:40px; margin-top:135px">
  <h3><strong>Daftar Alat</strong></h3>
  <table id="table" class="table table-striped table-bordered table-hover" ></table>
</div>
@endsection

@push('scripts')
<script>
  $('#table').DataTable({
    aLengthMenu: [[-1], ["All"]],
    responsive: true,
    serverSide: true,
    searching: false,
    paging: false,
    info: false,
    scrollX: true,
    ajax: "{{ route('tool.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', className: 'dt-head-center'},
      {title: 'Status', data: 'actives_id', name: 'actives_id', className: 'dt-center'},
      {title: 'Detail', data: 'show', name: 'show', orderable:false, className: 'dt-center'}
    ],
  });
</script>
@endpush