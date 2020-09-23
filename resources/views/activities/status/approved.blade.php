@extends('layouts.index')

@section('title', 'FINDER · Approved Schedule')

@section('content')
<h2 style="padding-top:10px;"><strong>Approved Schedule</strong></h2>
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
  @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non UnpadUser Umum')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      ajax: "{{ route('status.approved.dt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-head-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;

  @role('Admin')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      ajax: "{{ route('admin.approved') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-head-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;

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