@extends('layout_client')

@section('title','LAB | PRINTG')

@section('content')
<h1>Laboratorium</h1>

<div class="card">
  <div class="card-body">
    <table id="table" class="table row-border hover order-column" style="width:100%">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Kepala Lab</th>
          <th>Deskripsi</th>
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
    ajax: "{{ route('lab.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {data: 'DT_RowIndex', name: 'no', orderable:false, width: '10%', className: 'dt-center'},
      {data: 'name', name: 'name', width: '20%', className: 'dt-head-center'},
      {data: 'head', name: 'head', width: '20%', className: 'dt-head-center'},
      {data: 'description', name: 'description', width: '40%', className: 'dt-head-center'},
      {data: 'name', name: 'name', width: '10%', className: 'dt-head-center'}
    ],
  });
</script>
@endpush