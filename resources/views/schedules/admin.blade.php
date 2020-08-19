@extends('layouts.admin')

@section('title', 'FINDER · Status List')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-top:15px;">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All Status</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="true">Booking List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rejected List</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancel List</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="card">
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
        <h4 class="panel-title mb-3"><strong>All Status</strong></h4>
        <table id="table_all" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="booking" role="tabpanel" aria-labelledby="booking-tab">
        <h4 class="panel-title mb-3"><strong>Booking List</strong></h4>
        <table id="table_booking" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="approved" role="tabpanel" aria-labelledby="approved-tab">
        <h4 class="panel-title mb-3"><strong>Approved List</strong></h4>
        <table id="table_approved" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
        <h4 class="panel-title mb-3"><strong>Rejected List</strong></h4>
        <table id="table_rejected" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
      <div class="tab-pane" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
        <h4 class="panel-title mb-3"><strong>Cancel List</strong></h4>
        <table id="table_cancel" class="table table-striped table-bordered text-sm" style="width:100%"></table>
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

  $('#table_all').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('all') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '15%', className: 'dt-head-center'},
      {title: 'Nama', data: 'user', name: 'user', width: '20%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '20%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '12.5%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Status', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_booking').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('booking') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '15%', className: 'dt-head-center'},
      {title: 'Nama', data: 'user', name: 'user', width: '20%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '20%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '12.5%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Status', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_approved').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('approved') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '15%', className: 'dt-head-center'},
      {title: 'Nama', data: 'user', name: 'user', width: '20%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '20%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '12.5%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Status', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_rejected').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('rejected') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '15%', className: 'dt-head-center'},
      {title: 'Nama', data: 'user', name: 'user', width: '20%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '20%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '12.5%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Status', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
    ],
  });

  $('#table_cancel').DataTable({
    responsive: true,
    serverSide: true,
    ajax: "{{ route('cancel') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'No Registrasi', data: 'no_regis', name: 'no_regis', width: '15%', className: 'dt-head-center'},
      {title: 'Nama', data: 'user', name: 'user', width: '20%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '20%', className: 'dt-head-center'},
      {title: 'Tanggal', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
      {title: 'Waktu', data: 'time', name: 'time', width: '12.5%', className: 'dt-center'},
      {title: 'Hadir', data: 'hadir', name: 'hadir', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Status', data: 'action', name: 'action', orderable:false, width: '10%', className: 'dt-center'}
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
        $('#table_all').DataTable().ajax.reload();
        $('#table_booking').DataTable().ajax.reload();
        $('#table_approved').DataTable().ajax.reload();
        $('#table_rejected').DataTable().ajax.reload();
        $('#table_cancel').DataTable().ajax.reload();
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


</script>
@endpush