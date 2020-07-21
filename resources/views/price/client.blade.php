@extends('layout.client')

@section('title','Price List - PRINTG')

@section('content')
<h2 style="padding-top:10px;"><strong>Daftar Harga</strong></h2>
<div class="row">
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body">
      <h4><strong>SEM SU3500</strong></h4>
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
    lengthChange: false,
    searching: false,
    paging: false, info: false,
    ajax: "{{ route('price.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Service', data: 'service', name: 'service', orderable:false, width: '22.5%', className: 'dt-center'},
      {title: 'Harga Dosen Unpad', data: 'price_1', name: 'price_1', orderable:false, width: '22.5%', className: 'dt-center'},
      {title: 'Harga Dosen Non-Unpad', data: 'price_2', name: 'price_2', orderable:false, width: '22.5%', className: 'dt-center'},
      {title: 'Harga Umum', data: 'price_3', name: 'price_3', orderable:false, width: '22.5%', className: 'dt-center'},
      {title: 'Diskon', data: 'diskon', name: 'diskon', orderable:false, width: '5%', className: 'dt-center'}
    ],
  });
</script>
@endpush