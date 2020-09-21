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
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('status.canceled.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Formulir', data: 'no_form', name: 'no_form', width: '28.15%', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', width: '11.2%', className: 'dt-center'},
      {title: 'Pilihan 1', data: 'date1', name: 'date1', width: '28.15%', className: 'dt-head-center'},
      {title: 'Pilihan 2', data: 'date2', name: 'date2', width: '28.15%', className: 'dt-head-center'},
      {title: 'Pilihan 3', data: 'date3', name: 'date3', width: '28.15%', className: 'dt-head-center'},
      {title: 'Status', data: 'status', name: 'status', orderable:false, width: '7.5%', className: 'dt-center'},
      {title: 'Detail', data: 'detail', name: 'detail', orderable:false, width: '7.5%', className: 'dt-center'}
    ],
  });

  function format (d) {
    return '<table>'+
        '<tr>'+
            '<td>Tujuan Pengamatan:</td>'+
            '<td>'+d.purpose+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Deskripsi Sample:</td>'+
            '<td>'+d.sample+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Preparasi Khusus:</td>'+
            '<td>'+d.unique+'</td>'+
        '</tr>'+
        '<tr >'+
            '<td>Pengguna hadir saat penggunaan alat:</td>'+
            '<td>'+d.attend+'</td>'+
        '</tr>'+
        '<tr >'+
            '<td>Rencana Pembayaran:</td>'+
            '<td>'+d.plan+'</td>'+
        '</tr>'+
        @role('Mahasiswa Unpad|Mahasiswa Non Unpad')
        '<tr >'+
            '<td>Dosen Pembimbing:</td>'+
            '<td>'+d.lecturer+'</td>'+
        '</tr>'+
        @endrole
    '</table>';
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