@extends('layouts.index')

@push('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
@endpush

@section('title', 'FINDER · Booking Request')

@section('content')
<h2 style="padding-top:10px;"><strong>Booking Request</strong></h2>
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
  @role('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('status.booking.dt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
        {title: 'Status', data: 'status', name: 'status', orderable:false, className: 'dt-center'},
        {title: 'Resend Email', data: 'resend', name: 'resend', orderable:false, className: 'dt-center'},
        {title: '', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
      ],
    });

  $('body').on('click', '.resend', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Apa kamu yakin ingin\nmengirim ulang email?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok, saya yakin!'
      cancelButtonText: 'Gak jadi',
    }).then((result)=>{
      if(result.value){
        $.ajax({
          url: url,
          type: "GET",
          data: {
            '_method': 'GET',
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
      title: "Apa kamu yakin ingin membatalkan '" + name + "'?",
      text: "Jika dilakukan data ini tidak akan dapat dikembalikan!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok, saya yakin!',
      cancelButtonText: 'Gak jadi',
    }).then((result)=>{
      if(result.value){
        $.ajax({
          url: url,
          type: "PUT",
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
  @endrole;

  @role('Admin')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('admin.booking') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
        {title: 'Opsi', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
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
        $('#modal-close').text('Cancel');
        $('#modal-save').text('Submit');
      }
    });

    $('#modal').modal('show');
  });

  $('body').on('submit','.form', function(event){
    event.preventDefault();

    var form = $('.form'),
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
  @endrole;

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

</script>
@endpush