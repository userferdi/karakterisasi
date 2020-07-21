@extends('layout.admin')

@section('title', 'Tools List | PRINTG')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tools List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Status</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Time of Use</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <h4 class="panel-title mb-3"><strong>List Alat</strong>
          <a href="{{ route('tool.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a>
        </h4>
        <table id="table_tool" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h4 class="panel-title mb-3"><strong>Status Alat</strong>
          <a href="{{ route('status.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Status Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a>
        </h4>
        <table id="table_status" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
        <h4 class="panel-title mb-3"><strong>Waktu Penggunaan Alat</strong>
          <a href="{{ route('status.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Create Brand"><i class="nav-icon fas fa-plus"></i> Create</a>
        </h4>
        <table id="table_time" class="table table-striped table-bordered text-sm" style="width:100%"></table>
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
  $('#table_tool').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('tool.dt') }}",
    order: [[ 2, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama Alat', data: 'name', name: 'name', width: '26.9%', className: 'dt-head-center'},
      {title: 'Status', data: 'status', name: 'status', width: '11.2%', className: 'dt-center'},
      {title: 'Waktu Penggunaan', data: 'time', name: 'time', width: '20%', className: 'dt-center'},
      {title: 'Lab', data: 'lab', name: 'lab', width: '26.9%', className: 'dt-head-center'},
      {title: 'Opsi', data: 'action', name: 'action', width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_status').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('status.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', width: '85%', className: 'dt-head-center'},
      {title: 'Opsi', data: 'action', name: 'action', width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_time').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('time.dt') }}",
    order: [[ 2, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', width: '45%', className: 'dt-head-center'},
      {title: 'Waktu (jam)', data: 'period', name: 'period', width: '40%', className: 'dt-center'},
      {title: 'Opsi', data: 'action', name: 'action', width: '10%', className: 'dt-center'}
    ],
  });

  $('body').on('click', '.modal-show', function(event){
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('name');

    var form = $('.form')
    var validation = Array.prototype.filter.call(form, function(form) {
      form.classList.remove('was-validated');
    });
    $('#modal-body').find("input,textarea,select")
      .val('')
      .end();
    $('#modal-title').text(title);
    $('#modal-close').text(me.hasClass('edit') ? 'Cancel' : 'Close');
    $('#modal-save').text(me.hasClass('edit') ? 'Update' : 'Create');

    $.ajax({
      url: url,
      dataType: 'html',
      success: function (response) {
        $('#modal-body').html(response);
        $('#modal-title').text(title);
        $('#modal-close').text(me.hasClass('edit') ? 'Cancel' : 'Close');
        $('#modal-save').text(me.hasClass('edit') ? 'Update' : 'Create');
      }
    });

    $('#modal').modal('show');
  });

  $('body').on('submit','.form', function(event){
    event.preventDefault();

    var form = $('form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    $.ajax({
      url : url,
      method : method,
      data : form.serialize(),

      success: function(response){
        $('#modal').modal('hide');
        $('#table').DataTable().ajax.reload();
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#28a745',
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        Toast.fire({
          type: 'success',
          title: 'Data has been saved!'
        })
        $('#modal-body').html('reset');
      },

      error: function(){
        'use strict';
        var validation = Array.prototype.filter.call(form, function(form) {
          form.classList.add('was-validated');
        });
      }
    });
  });

  $('body').on('click', '.delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to delete '" + name + "'?",
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
            '_method': 'DELETE',
            '_token': csrf_token
          },
          success: function(response){
            $('#table').DataTable().ajax.reload();
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