@extends('layouts.index')

@section('title','FINDER · History')

@section('content')
<h3 style="padding-top:15px;"><b>Histori Penggunaan Alat</b></h3>
<div class="row">
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body">
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
    ajax: "{{ route('activities.history.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-head-center'},
      {title: 'Total Tagihan', data: 'total', name: 'total', orderable:false, className: 'dt-center'},
      {title: 'Status', data: 'status', name: 'status', orderable:false, className: 'dt-center'},
      {title: '', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
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
    // $('#modal-title').text(title);
    // $('#modal-close').text(me.hasClass('edit') ? 'Cancel' : 'Close');
    // $('#modal-save').text(me.hasClass('edit') ? 'Update' : 'Create');

    $.ajax({
      url: url,
      dataType: 'html',
      success: function (response) {
        $('#modal-body').html(response);
        $('#modal-title').text(title);
        $('#modal-close').text('Cancel');
        $('#modal-save').text('Submit');
      }
    });

    $('#modal').modal('show');
  });

  $('body').on('submit','#quantity', function(event){
    event.preventDefault();

    var form = $('.form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    $.ajax({
      url : url,
      method : method,
      data : form.serialize(),
      dataType: 'html',

      success: function(response){
        $('#modal-body').html(response);
        $('#modal-title').text('Banyak Layanan');
        $('#modal-close').text('Cancel');
        $('#modal-save').text('Submit');
      },

      error: function(){
        'use strict';
        var validation = Array.prototype.filter.call(form, function(form) {
          form.classList.add('was-validated');
        });
      }
    });
  });

  $('body').on('submit','#service', function(event){
    event.preventDefault();

    var form = $('.form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    $.ajax({
      url : url,
      method : method,
      data : form.serialize(),

      success: function(response){
        $('#modal').modal('hide');
        $('#table_tool').DataTable().ajax.reload();
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