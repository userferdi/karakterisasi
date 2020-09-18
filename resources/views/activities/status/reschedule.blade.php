@extends('layouts.index')

@section('title', 'FINDER · Reschedule Offered List')

@section('content')
<h2 style="padding-top:10px;"><strong>Reschedule Offered List</strong></h2>
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
  $('#table').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('status.reschedule.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-center'},
      {title: 'Akan Hadir', data: 'attend', name: 'attend', orderable:false, className: 'dt-center'},
      {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
      {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
      {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
      {title: 'Catatan', data: 'note', name: 'note', orderable:false, className: 'dt-center'},
      {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
      {title: 'Konfirmasi Reschedule', data: 'confirm', name: 'confirm', orderable:false, className: 'dt-center'},
      {title: 'Cancel', data: 'cancel', name: 'cancel', orderable:false, className: 'dt-center'}
    ],
  });

</script>
@endpush