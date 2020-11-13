@extends('layouts.index')

@section('title','FINDER · Transaction History')

@section('content')
<h3 style="padding-top:15px;"><b>Riwayat Transaksi</b></h3>
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
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('payment.datatableHistory') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Invoice', data: 'no_invoice', name: 'no_invoice', className: 'dt-head-center'},
      {title: 'No Receipt', data: 'no_receipt', name: 'no_receipt', className: 'dt-head-center'},
      {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Nominal', data: 'total', name: 'total', orderable:false, className: 'dt-center'},
      {title: 'Metode Pembayaran', data: 'plan', name: 'plan', orderable:false, className: 'dt-center'}
    ],
  });
</script>
@endpush