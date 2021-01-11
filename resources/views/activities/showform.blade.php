@extends('layouts.index')

@section('title', 'FINDER')

@section('content')
<h2 style="padding-top:10px;">Registrasi Penggunaan Alat</h2>
<div class="row">
  <div class="col-lg-6 mb-3">
    <p>Silakan klik tombol <strong>Registrasi</strong> untuk melakukan registrasi penggunaan alat.</p>
    <table id="table" class="table table-striped table-hover table-bordered text-sm" style="width:100%"></table>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $('#table').DataTable({
    responsive: true,
    serverSide: true,
    searching: false,
    paging: false,
    info: false,
    scrollX: true,
    ajax: "{{ route('activities.dataform') }}",
    columns: [
      {title: 'Nama', data: 'name', name: 'name', className: 'dt-head-center'},
      {title: 'Action', data: 'register', name: 'register', orderable:false, className: 'dt-center'}
    ],
  });
</script>
@endpush