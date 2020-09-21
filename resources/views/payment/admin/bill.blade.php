@extends('layouts.index')

@section('title','FINDER · Invoice')

@section('content')
<h3 style="padding-top:20px;"><b>Invoice</b></h3>
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
    // ajax: "{{ route('payment.adminBill') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
      {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-head-center'},
      {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
      {title: 'Buat Tagihan', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
    ],
  });
</script>
@endpush