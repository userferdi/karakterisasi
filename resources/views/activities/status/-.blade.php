@extends('layouts.client')

@section('title', 'PRINTG')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tool-tab" data-toggle="tab" href="#tool" role="tab" aria-controls="tool" aria-selected="true">Booking List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Approved List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="time-tab" data-toggle="tab" href="#time" role="tab" aria-controls="time" aria-selected="false">Rejected List</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="tool" role="tabpanel" aria-labelledby="tool-tab">
        <h4 class="panel-title mb-3"><strong>Booking List</strong>
          <!-- <a href="{{ route('tool.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a> -->
        </h4>
        <table id="table_booking" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="status" role="tabpanel" aria-labelledby="status-tab">
        <h4 class="panel-title mb-3"><strong>Approved List</strong>
          <!-- <a href="{{ route('status.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Status Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a> -->
        </h4>
        <table id="table_approved" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="time" role="tabpanel" aria-labelledby="time-tab">
        <h4 class="panel-title mb-3"><strong>Rejected List</strong>
          <!-- <a href="{{ route('status.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Create Brand"><i class="nav-icon fas fa-plus"></i> Create</a> -->
        </h4>
        <table id="table_rejected" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
  $('#table_booking').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('schedule.booking') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '7.5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '15%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '22.5%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '15%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '25%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
      {title: '', data: 'delete', name: 'delete', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_approved').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('schedule.approved') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '9.5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '17%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '24.5%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '17%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '27%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
    ],
  });

  $('#table_rejected').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('schedule.rejected') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '9.5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '17%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '24.5%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '17%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '27%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
    ],
  });

  $('body').on('click', '.delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to cancel '" + name + "'?",
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result)=>{
      if(result.value){
        $.ajax({
          url: url,
          type: "POST",
          data: {
            '_method': 'PUT',
            '_token': csrf_token
          },
          success: function(response){
            $('#table_all').DataTable().ajax.reload();
            $('#table_booking').DataTable().ajax.reload();
            $('#table_approved').DataTable().ajax.reload();
            $('#table_rejected').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              background: '#BD362F',
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            Toast.fire({
              type: 'success',
              text: 'Data has been deleted'
            })
          },
          error: function(xhr){
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!'
            });
          }
        });
      }
    });
  });



</script>
@endpush