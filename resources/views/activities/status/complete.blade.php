@extends('layouts.index')

@section('title','FINDER · Complete')

@section('content')
<h3 style="padding-top:15px;"><b>Complete</b></h3>
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
    scrollX: true,
    ajax: "{{ route('status.completed.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'No Registration', data: 'no_regis', name: 'no_regis', className: 'dt-head-center'},
      {title: 'Nama Pengguna', data: 'user', name: 'user', width: '12.5%', className: 'dt-head-center'},
      {title: 'Nama Alat', data: 'tool', name: 'tool', className: 'dt-head-center'},
      {title: 'Tanggal Penggunaan', data: 'date', name: 'date', className: 'dt-head-center'},
      {title: 'Total Tagihan', data: 'total', name: 'total', orderable:false, className: 'dt-center'},
      {title: '', data: 'confirm', name: 'confirm', orderable:false, className: 'dt-center'}
    ],
  });

  $('body').on('click', '.confirm', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Apa Anda yakin ingin menyelesaikan status\n'" + name + "'?",
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
              title: 'Data has been saved!'
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