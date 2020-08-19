@extends('layout_client')

@section('title','TOOL | PRINTG')

@section('content')
<h1>Tools List</h1>

<div class="card">
  <div class="card-body">
    <table id="table" class="table row-border hover order-column" style="width:100%">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

@endsection

@push('scripts')
<script>
  $('#table').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('tool.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {data: 'DT_RowIndex', name: 'no', orderable:false, width: '10%', className: 'dt-center'},
      {data: 'name', name: 'name', width: '50%', className: 'dt-head-center'},
      {data: 'status', name: 'status', width: '20%', className: 'dt-center'},
      {data: 'action', name: 'action', width: '20%', className: 'dt-center'}
    ],
  });
</script>
@endpush