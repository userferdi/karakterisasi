@extends('layouts.index')

@section('title','FINDER · History')

@section('content')
<div class="row">
&ensp;<a href=".." type="button" class="btn btn-secondary btn-sm" style="margin-bottom:15px; margin-top:15px;">Back</a>
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body">
        <h3><strong>{{$model->name}}</strong></h3>
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
    ajax: "{{ route('history.dataShowUser',$model->id) }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-center'},
      {title: 'Nominal', data: 'total', name: 'total', orderable:false, className: 'dt-center'},
      {title: 'Status', data: 'status', name: 'status', orderable:false, className: 'dt-center'},
      {title: '', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
    ],
  });
</script>
@endpush