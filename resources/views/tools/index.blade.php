@extends('layouts.welcome')

@section('title', 'FINDER · Tools List')

@section('content')
<section class="page-section tool" id="tool" style="padding:40px; margin-top:100px">
  <h3><strong>Daftar Alat</strong></h3>
  <table id="table" class="table table-striped table-bordered text-sm tool" style="width:100%"></table>
</section>
@endsection

@push('scripts')
<script>
  $('#table').DataTable({
    aLengthMenu: [[-1], ["All"]],
    responsive: true,
    // processing: true,
    serverSide: true,
    searching: false,
    paging: false,
    info: false,
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