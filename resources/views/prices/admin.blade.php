@extends('layouts.index')

@section('title','FINDER · Price List')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h3 class="panel-title mb-3"><strong>Price List</strong>
          <a href="{{ route('price.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Harga"><i class="nav-icon fas fa-plus"></i> Create</a>
        </h3>
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
    ajax: "{{ route('price.dt') }}",
    order: [[ 3, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, width: '5%', className: 'dt-center'},
      {title: 'Service', data: 'service', name: 'service', width: '21%', className: 'dt-head-center'},
      {title: 'Satuan', data: 'unit', name: 'unit', width: '15.5%', className: 'dt-head-center'},
      {title: 'Alat', data: 'tool', name: 'tool', width: '21%', className: 'dt-head-center'},
      {title: 'Harga Unpad', data: 'price1', name: 'price1', orderable:false, width: '15%', className: 'dt-center'},
      {title: 'Harga Umum', data: 'price3', name: 'price3', orderable:false, width: '15%', className: 'dt-center'},
      {title: 'Opsi', data: 'action', name: 'action', width: '7.5%', orderable:false, className: 'dt-center'}
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

      error: function(){
        var validation = Array.prototype.filter.call(form, function(form) {
          form.classList.add('was-validated');
        });
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
      title: "Apa Anda yakin ingin menghapus\n'" + name + "'?",
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

</script>
@endpush