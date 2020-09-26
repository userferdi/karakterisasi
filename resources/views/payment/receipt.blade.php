@extends('layouts.index')

@section('title','FINDER · Receipt')

@section('content')
<h3 style="padding-top:10px;"><b>Receipt</b></h3>
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
      ajax: "{{ route('payment.dataReceipt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Receipt', data: 'no_receipt', name: 'no_receipt', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-center'},
        {title: 'Total Pembayaran', data: 'total', name: 'total', className: 'dt-center'},
        {title: 'Lihat Receipt', data: 'show', name: 'show', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;

  @role('Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      ajax: "{{ route('payment.dataReceipt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Receipt', data: 'no_receipt', name: 'no_receipt', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-center'},
        {title: 'Total Pembayaran', data: 'total', name: 'total', className: 'dt-center'},
        {title: 'Lihat Receipt', data: 'show', name: 'show', orderable:false, className: 'dt-center'}
      ],
    });
  @endrole;

  @role('Admin')
    var detail = $('#table').DataTable({
      responsive: true,
      serverSide: true,
      ajax: "{{ route('payment.datatableReceipt') }}",
      order: [[ 1, "asc" ]],
      columns: [
        {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
        {title: 'No Tagihan', data: 'no_invoice', name: 'no_invoice', className: 'dt-head-center'},
        {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
        {title: 'Nama Pengguna', data: 'user', name: 'user', className: 'dt-head-center'},
        {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
        {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-head-center'},
        {title: 'Total Pembayaran', data: 'total', name: 'total', className: 'dt-center'},
        {title: 'Detail', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'},
        {title: 'Buat Tanda Terima', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
      ],
    });

  $('body').on('click', '.receipt', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to\nmake the receipt?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, make it!'
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

  function format (d) {
    return '<div class="row">'+
      '<div class="col-lg-8">'+
        '<table style="width:100%">'+
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
        '</table>'+
      '</div>'+
      '<div class="col-lg-4">'+
        '<div class="text-center">'+'<img src="'+d.image+'" width="150"/>'+'</div>'+
      '</div>'+
    '</div>';
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