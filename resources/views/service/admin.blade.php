@extends('layout.admin')

@section('title','LAB | PRINTG')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h3 class="panel-title mb-3"><strong>Service</strong>
          <a href="{{ route('status.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Create Brand"><i class="nav-icon fas fa-plus"></i> Create</a>
        </h3>
        <table id="table" class="table row-border hover order-column" style="width:100%">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Service</th>
              <th>Alat</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
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
    ajax: "{{ route('service.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {data: 'DT_RowIndex', name: 'no', orderable:false, width: '7.5%', className: 'dt-center'},
      {data: 'name', name: 'name', width: '50%', className: 'dt-head-center'},
      {data: 'tool', name: 'tool', width: '30%', className: 'dt-head-center'},
      {data: 'action', name: 'action', width: '12.5%', className: 'dt-center'}
    ],
  });
</script>
@endpush