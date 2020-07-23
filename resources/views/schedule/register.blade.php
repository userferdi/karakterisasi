@extends('layout.client')

@section('title','PRINTG')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3"><strong>Cara Registrasi Penggunaan Alat</strong>
          <a href="{{ route('lab.create') }}" class="btn btn-primary float-right btn-sm modal-show" name="Tambah Daftar Lab Baru"><i class="nav-icon fas fa-plus"></i> Registrasi Penggunaan Alat</a>
        </h4>
        1. Klik tombol Registrasi Penggunaan Alat untuk melakukan booking penggunaan alat.</br>
        2. Pilih Alat yang akan Anda pinjam kemudian isi form yang disediakan.</br>
        3. Booking Penggunaan Alat yang belum kami terima akan masuk pada menu <strong>Pending Request</strong>.</br>
        4. Kami akan melihat ketersediaan jadwal dan menentukan jadwal penggunaan untuk Anda. Anda dapat melihat jadwal yang telah disetujui pada menu <a href="https://sipa.nrcn.itb.ac.id/booking/user/approved_schedule"><strong>Approved Schedule</strong></a>. Anda diharuskan melakukan konfirmasi terhadap jadwal telah kami setujui pada laman tersebut.</br>
        5. Apabila jadwal penuh, Anda dapat melakukan booking ulang. Silakan lihat menu <a href="https://sipa.nrcn.itb.ac.id/booking/user/rescheduled"><strong>Reschedule Offered List</strong></a>.</br>
        6. Untuk melihat status penggunaan alat secara keseluruhan Anda dapat melihat pada menu <a href="https://sipa.nrcn.itb.ac.id/booking/user/status"><strong>Status Penggunaan Alat</strong></a>.</br>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
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

</script>
@endpush