@extends('layouts.index')

@section('title','FINDER · Transaction History')

@section('content')
<h3 style="padding-top:15px;"><b>Histori Transaksi</b></h3>
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
  @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
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
  @endrole;

  @role('Admin')
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('payment.datatableHistory') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Invoice', data: 'no_invoice', name: 'no_invoice', className: 'dt-head-center'},
      {title: 'No Receipt', data: 'no_receipt', name: 'no_receipt', className: 'dt-head-center'},
      {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Nominal', data: 'total', name: 'total', orderable:false, className: 'dt-center'},
      {title: 'Metode Pembayaran', data: 'plan', name: 'plan', orderable:false, className: 'dt-center'},
      {title: 'Show', data: 'show', name: 'show', orderable:false, className: 'dt-center'}
    ],
  });
  @endrole;

  function format (d) {
    return  '<div class="text-center">'+'<img src="'+d.image+'" width="150"/>'+'</div>';
  };

  $('#table tbody').on('click', '.details-control', function () {
    event.preventDefault();
    var tr = $(this).closest('tr');
    var row = detail.row( tr );

    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
  });
</script>
@endpush