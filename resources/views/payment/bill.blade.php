@extends('layouts.index')

@section('title','FINDER · Bill')

@section('content')
<h3 style="padding-top:10px;"><b>Daftar Tagihan</b></h3>
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
  @role('Dosen Unpad|Dosen Non Unpad')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('payment.dataBill') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
        {title: 'No Tagihan', data: 'no_invoice', name: 'no_invoice', width: '12.5%', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', width: '12.5%', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', width: '15%', className: 'dt-head-center'},
        {title: 'Tanggal Layanan', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
        {title: 'Total Tagihan', data: 'total', name: 'total', width: '12.5%', className: 'dt-center'},
        {title: 'Metode Pembayaran', data: 'plan', name: 'plan', width: '20%', className: 'dt-center'},
        {title: 'Tagihan', data: 'show', name: 'show', width: '10%', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;
  @role('Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('payment.dataBill') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
        {title: 'No Tagihan', data: 'no_invoice', name: 'no_invoice', width: '15%', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', width: '20%', className: 'dt-head-center'},
        {title: 'Tanggal Layanan', data: 'date', name: 'date', width: '12.5%', className: 'dt-center'},
        {title: 'Total Tagihan', data: 'total', name: 'total', width: '15%', className: 'dt-center'},
        {title: 'Metode Pembayaran', data: 'plan', name: 'plan', width: '22.5%', className: 'dt-center'},
        {title: 'Tagihan', data: 'show', name: 'show', width: '10%', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;

  @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non UnpadUser Umum')
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

    $.ajax({
      url: url,
      dataType: 'html',
      success: function (response) {
        $('#modal-body').html(response);
        $('#modal-title').text(title);
        $('#modal-close').text('Cancel');
        $('#modal-save').text('Save');
      }
    });

    $('#modal').modal('show');
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
        detail.row($(this).closest('tr')).child.hide();
        $(this).closest('tr').removeClass('shown');
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
  @endrole;

  @role('Admin')
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('payment.datatableBill') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
      {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Tanggal Layanan', data: 'date', name: 'date', className: 'dt-center'},
      {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
      {title: 'Tagihan', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
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

    $.ajax({
      url: url,
      dataType: 'html',
      success: function (response) {
        $('#modal-body').html(response);
        $('#modal-title').text(title);
        $('#many-save').text('Input Banyak Layanan');
      }
    });

    $('#modal').modal('show');
  });

  $('body').on('submit','#prepare', function(event){
    event.preventDefault();

    var form = $('#prepare'),
        url = form.attr('action'),
        method = form.attr('method'),
        many = $('input[name=many]').val();
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    var validation = Array.prototype.filter.call(form, function(form) {
      form.classList.remove('was-validated');
    });

    $.ajax({
      url : url,
      dataType: 'html',
      data : {'_method' : method, '_token' : csrf_token, 'many': many},
      success: function(response){
        $('#modal-bill').html(response);
        $('#modal-title').text('Banyak Layanan');
        $('#modal-close').text('Cancel');
        $('#modal-save').text('Submit');
      },
    });
  });

  $('body').on('submit','#bill', function(event){
    event.preventDefault();

    var form = $('#bill'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    $.ajax({
      url : url,
      method : method,
      data : form.serialize(),

      success: function(response){
        $('#modal-body').find("input,textarea,select")
          .val('')
          .end();
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

  function format (d) {
    return '<table>'+
        '<tr>'+
            '<td>Tujuan Pengamatan:</td>'+
            '<td>'+d.purpose+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Deskripsi Sample:</td>'+
            '<td>'+d.sample+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Preparasi Khusus:</td>'+
            '<td>'+d.unique+'</td>'+
        '</tr>'+
        '<tr >'+
            '<td>Pengguna hadir saat penggunaan alat:</td>'+
            '<td>'+d.attend+'</td>'+
        '</tr>'+
        '<tr >'+
            '<td>Rencana Pembayaran:</td>'+
            '<td>'+d.plan+'</td>'+
        '</tr>'+
        @role('Mahasiswa Unpad|Mahasiswa Non Unpad')
        '<tr >'+
            '<td>Dosen Pembimbing:</td>'+
            '<td>'+d.lecturer+'</td>'+
        '</tr>'+
        @endrole
    '</table>';
  };

  $('#table tbody').on('click', '.details-control', function () {
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
  @endrole;

</script>
@endpush