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
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      scrollX: true,
      ajax: "{{ route('student.databooking') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Formulir', data: 'no_form', name: 'no_form', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', orderable:false, className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Pilihan 1', data: 'date1', name: 'date1', className: 'dt-head-center'},
        {title: 'Pilihan 2', data: 'date2', name: 'date2', className: 'dt-head-center'},
        {title: 'Pilihan 3', data: 'date3', name: 'date3', className: 'dt-head-center'},
        // {title: 'Resend Email', data: 'resend', name: 'resend', orderable:false, className: 'dt-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
        {title: '', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
      ],
    });

  $('body').on('click', '.confirm', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to confirm\n'" + name + "'?",
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, confirm it!'
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

  $('body').on('click', '.reject', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to reject\n'" + name + "'?",
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


</script>
@endpush