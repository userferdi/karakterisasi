@extends('layouts.index')

@section('title', 'FINDER · Reschedule Offered List')

@section('content')
<h2 style="padding-top:10px;"><strong>Reschedule Offered List</strong></h2>
<div class="row">
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body">
        <table id="table" class="table table-striped table-bordered text-sm"></table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('status.reschedule.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-center'},
      {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
      {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
      {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
      {title: 'Catatan', data: 'note', name: 'note', orderable:false, className: 'dt-center'},
      {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
      {title: 'Konfirmasi Reschedule', data: 'confirm', name: 'confirm', orderable:false, className: 'dt-center'},
      {title: 'Cancel', data: 'cancel', name: 'cancel', orderable:false, className: 'dt-center'}
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

  $('body').on('click', '.confirm', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to\nconfirm?",
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, resend it!'
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
              title: 'Email has been sent!'
            })
            $('#modal-body').html('reset');
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

  $('body').on('click', '.cancel', function (event) {
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
      confirmButtonText: 'Yes, cancel it!'
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

  $("#datepicker1").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: function() {
            var date = new Date();
            date.setDate(date.getDate()+7);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate()+34);
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
  $("#datepicker2").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: function() {
            var date = new Date();
            date.setDate(date.getDate()+7);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate()+34);
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
  $("#datepicker3").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: function() {
            var date = new Date();
            date.setDate(date.getDate()+7);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate()+34);
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });

</script>
@endpush