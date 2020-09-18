@extends('layouts.index')

@section('title', 'FINDER · Canceled List')

@section('content')
<h2 style="padding-top:10px;"><strong>Canceled List</strong></h2>
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
  @role('Dosen Unpad|Dosen Non Unpad|User Umum')
    $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('status.canceled.dt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', width: '28.15%', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', width: '11.2%', className: 'dt-center'},
        {title: 'Rencana Pembayaran', data: 'plan', name: 'plan', width: '28.15%', className: 'dt-head-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', width: '28.15%', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', width: '28.15%', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', width: '28.15%', className: 'dt-head-center'},
        {title: 'Status', data: 'status', name: 'status', orderable:false, width: '7.5%', className: 'dt-center'},
        {title: 'Action', data: 'action', name: 'action', orderable:false, width: '7.5%', className: 'dt-center'}
      ],
    });
  @endrole;

  @role('Mahasiswa Unpad|Mahasiswa Non Unpad')
    $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('status.canceled.dt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', width: '28.15%', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', width: '11.2%', className: 'dt-center'},
        {title: 'Dosen Penanggungjawab', data: 'lecturer', name: 'lecturer', width: '20%', className: 'dt-center'},
        {title: 'Rencana Pembayaran', data: 'plan', name: 'plan', width: '28.15%', className: 'dt-head-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', width: '28.15%', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', width: '28.15%', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', width: '28.15%', className: 'dt-head-center'},
        {title: 'Status', data: 'status', name: 'status', orderable:false, width: '7.5%', className: 'dt-center'},
        {title: 'Action', data: 'action', name: 'action', orderable:false, width: '7.5%', className: 'dt-center'}
      ],
    });
  @endrole;
</script>
@endpush