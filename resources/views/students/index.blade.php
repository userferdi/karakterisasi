@extends('layouts.index')

@section('title', 'FINDER · My Students')

@section('content')
<h2 style="padding-top:10px;padding-bottom:5px;"><strong>My Students</strong></h2>
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
    ajax: "{{ route('student.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Nama', data: 'name', name: 'name', width: '22.5%', className: 'dt-head-center'},
      {title: 'Jurusan', data: 'study_program', name: 'study_program', width: '15%', className: 'dt-center'},
      {title: 'Fakultas', data: 'faculty', name: 'faculty', width: '17.5%', className: 'dt-center'},
      {title: 'Universitas', data: 'university', name: 'university', width: '25%', className: 'dt-center'},
      {title: 'Action', data: 'action', name: 'action', orderable:false, width: '15%', className: 'dt-center'}
    ],
  });

  $('body').on('click', '.delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
      title: "Are you sure want to remove\n'" + name + "'?",
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Remove it!'
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
              background: '#BD362F',
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            Toast.fire({
              type: 'success',
              text: 'Data has been removed'
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
    return '<table class="table-striped table-bordered text-sm">'+
        '<tr>'+
            '<td>NIM:</td>'+
            '<td>'+d.no_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Phone Number:</td>'+
            '<td>'+d.no_hp+'</td>'+
        '</tr>'+
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