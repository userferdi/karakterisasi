@extends('layouts.index')

@section('title', 'FINDER · Tools List')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
@endpush

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tool-tab" data-toggle="tab" href="#tool" role="tab" aria-controls="tool" aria-selected="true">Tools List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="timeuse-tab" data-toggle="tab" href="#timeuse" role="tab" aria-controls="timeuse" aria-selected="false">Time of Usages</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="tool" role="tabpanel" aria-labelledby="tool-tab">
        <h4 class="panel-title mb-3"><strong>List Alat</strong>
          <a href="{{ route('tool.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a>
        </h4>
        <table id="table_tool" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="status" role="tabpanel" aria-labelledby="status-tab">
        <h4 class="panel-title mb-3"><strong>Status Alat</strong>
          <a href="{{ route('active.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Status Alat Baru"><i class="nav-icon fas fa-plus"></i> Add New</a>
        </h4>
        <table id="table_status" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="timeuse" role="tabpanel" aria-labelledby="timeuse-tab">
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="timeusage-tab" data-toggle="tab" href="#timeusage" role="tab" aria-controls="timeusage" aria-selected="false">Waktu Penggunaan</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="time-tab" data-toggle="tab" href="#time" role="tab" aria-controls="time" aria-selected="false">Waktu</a>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane" id="timeusage" role="tabpanel" aria-labelledby="timeusage-tab">
              <h4 class="panel-title mb-3"><strong>Waktu Penggunaan</strong>
                <a href="{{ route('timeusage.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Waktu Penggunaan Alat Baru"><i class="nav-icon fas fa-plus"></i> Create</a>
              </h4>
              <table id="table_timeusage" class="table table-striped table-bordered text-sm" style="width:100%"></table>
            </div>
            <div class="tab-pane" id="time" role="tabpanel" aria-labelledby="time-tab">
              <h4 class="panel-title mb-3"><strong>Waktu</strong>
                <a href="{{ route('time.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Waktu Penggunaan Alat Baru"><i class="nav-icon fas fa-plus"></i> Create</a>
              </h4>
              <table id="table_time" class="table table-striped table-bordered text-sm" style="width:100%"></table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
  $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
  });
  var detail = $('#table_tool').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('tool.dt.admin') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama Alat', data: 'name', name: 'name', width: '27.5%', className: 'dt-head-center'},
      {title: 'Kode', data: 'code', name: 'code', orderable:false, width: '7.5%', className: 'dt-center'},
      {title: 'Status', data: 'actives_id', name: 'actives_id', width: '10%', className: 'dt-center'},
      {title: 'Laboratorium', data: 'labs_id', name: 'labs_id', width: '22.5%', className: 'dt-center'},
      {title: 'Waktu Penggunaan', data: 'usages_id', name: 'usages_id', width: '17.5%', className: 'dt-center'},
      {title: 'Opsi', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_status').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('active.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Status', data: 'name', name: 'name', width: '85%', className: 'dt-head-center'},
      {title: 'Opsi', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_timeusage').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('timeusage.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Usage', data: 'name', name: 'name', width: '10%', className: 'dt-head-center'},
      {title: 'Time', data: 'time', name: 'time', width: '75%', className: 'dt-head-center'},
      {title: 'Opsi', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_time').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('time.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', width: '35%', className: 'dt-head-center'},
      {title: 'Start', data: 'time_start', name: 'time_start', width: '25%', className: 'dt-head-center'},
      {title: 'End', data: 'time_end', name: 'time_end', width: '25%', className: 'dt-head-center'},
      {title: 'Opsi', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('body').on('click', '.modal-show', function(event){
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('name');

    $.ajax({
      url: url,
      dataType: 'html',
      success: function (response) {
        $('#modal-body').html(response);
        $('#modal-title').text(title);
        $('#modal-close').text(me.hasClass('edit') ? 'Cancel' : 'Close');
        $('#modal-save').text(me.hasClass('edit') ? 'Update' : 'Create');
        $('#modal').modal('show');
      }
    });
  });

  $('body').on('submit','#prepare', function(event){
    event.preventDefault();

    var form = $('#prepare'),
        url = form.attr('action'),
        method = form.attr('method'),
        count = $('input[name=count]').val();
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url : url,
      dataType: 'html',
      data : {'_method' : method, '_token' : csrf_token, 'count': count},
      success: function(response){
        $('#modal-timeusage').html(response);
      },
    });
  });

  $('body').on('submit','#proses', function(event){
    event.preventDefault();

    var form = $('#proses'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    $.ajax({
      url : url,
      method : method,
      data : form.serialize(),

      success: function(response){
        $('#modal').modal('hide');
        $('#table_timeusage').DataTable().ajax.reload();
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
        $('#modal-body').trigger('reset');
      },

      error: function(xhr){
        var res = xhr.responseJSON;
        if ($.isEmptyObject(res) == false) {
          form.find('.invalid-feedback').remove();
          form.find('.is-invalid').removeClass('is-invalid');
          $.each(res.errors, function (key, value) {
            $('#' + key)
              .addClass('is-invalid')
              .after('<div class="invalid-feedback d-block">'+value+'</div>');
          });
        }
      }
    });
  });

  $('body').on('submit','.form', function(event){
    event.preventDefault();

    var form = $('.form'),
        url = form.attr('action'),
        method = form.attr('method');

    $.ajax({
      url : url,
      method : method,
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      processData: false,

      success: function(data){
        $('#modal').modal('hide');
        $('#table_tool').DataTable().ajax.reload();
        $('#table_status').DataTable().ajax.reload();
        $('#table_timeusage').DataTable().ajax.reload();
        $('#table_usage').DataTable().ajax.reload();
        $('#table_time').DataTable().ajax.reload();
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
        $('#modal-body').trigger('reset');
      },

      error: function(xhr){
        var res = xhr.responseJSON;
        if ($.isEmptyObject(res) == false) {
          form.find('.invalid-feedback').remove();
          form.find('.is-invalid').removeClass('is-invalid');
          $.each(res.errors, function (key, value) {
            $('#' + key)
              .addClass('is-invalid')
              .after('<div class="invalid-feedback d-block">'+value+'</div>');
          });
        }
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
      title: "Apa kamu yakin ingin menghapus\n'" + name + "'?",
      text: "Jika dilakukan data ini tidak akan dapat dikembalikan!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok, saya yakin!',
      cancelButtonText: 'Tidak jadi',
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
            $('#table_tool').DataTable().ajax.reload();
            $('#table_status').DataTable().ajax.reload();
            $('#table_timeusage').DataTable().ajax.reload();
            $('#table_usage').DataTable().ajax.reload();
            $('#table_time').DataTable().ajax.reload();
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

  function format (d) {
    return '<table>'+
        '<tr >'+
            '<td>Deskripsi Alat:</td>'+
            '<td>'+d.descrip+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Preparasi Sample:</td>'+
            '<td>'+d.sample+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Image:</td>'+
            '<td>'+d.image+'</td>'+
        '</tr>'+
    '</table>';
  };


  $('#table_tool tbody').on('click', '.details-control', function () {
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