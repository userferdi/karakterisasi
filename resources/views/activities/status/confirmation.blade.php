@extends('layouts.index')

@section('title', 'FINDER · Confirmation Schedule')

@section('content')
<h2 style="padding-top:10px;"><strong>Confirmation Schedule</strong></h2>
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
    ajax: "{{ route('status.confirmation.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Formulir', data: 'no_form', name: 'no_form', width: '10%', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', width: '10%', className: 'dt-center'},
      {title: 'Akan Hadir', data: 'attend', name: 'attend', orderable:false, width: '10%', className: 'dt-center'},
      {title: 'Jadwal yang disetujui', data: 'date', name: 'date', width: '20%', className: 'dt-head-center'},
      {title: 'Detail', data: 'detail', name: 'detail', orderable:false, width: '7.5%', className: 'dt-center'},
      {title: 'Confirm', data: 'confirm', name: 'confirm', orderable:false, width: '7.5%', className: 'dt-center'},
      {title: 'Cancel', data: 'cancel', name: 'cancel', orderable:false, width: '7.5%', className: 'dt-center'}
    ],
  });
</script>
@endpush