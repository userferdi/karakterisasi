@extends('layouts.index')

@push('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
@endpush

@section('title', 'FINDER · Booking Request')

@section('content')
<h2 style="padding-top:10px;"><strong>Booking Request</strong></h2>
<div class="row">
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body">
        <table id="table" class="table table-striped table-bordered text-sm"></table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')
    $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('status.booking.dt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-center'},
        {title: 'Akan Hadir', data: 'attend', name: 'attend', orderable:false, className: 'dt-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
        {title: 'Status', data: 'status', name: 'status', orderable:false, className: 'dt-center'},
        {title: 'Resend Email', data: 'resend', name: 'resend', orderable:false, className: 'dt-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
        {title: 'Cancel', data: 'cancel', name: 'cancel', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;
  @role('Admin')
    $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('admin.booking') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
        {title: 'Opsi', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;
</script>
@endpush