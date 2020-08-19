@extends('layouts.client')

@section('title','PRINTG')

@push('css')
@endpush

@section('content')
<h2 style="padding-top:10px;">Formulir Penggunaan Alat</h2>
<!-- <p> Silakan klik tombol <strong>Registrasi</strong> untuk melakukan registrasi penggunaan alat.</p> -->
@include('schedules.form')


@endsection

@push('scripts')
<script>
  $('#table').DataTable({
    responsive: true,
    serverSide: true,
    searching: false,
    paging: false,
    info: false,
    ajax: "{{ route('tool.dt') }}",
    columns: [
      {title: 'Nama', data: 'name', name: 'name', orderable:false, width: '75%', className: 'dt-head-center'},
      {title: 'Action', data: 'booking', name: 'booking', orderable:false, width: '25%', className: 'dt-center'}
    ],
  });


  $("#datepicker").datepicker({
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

  function agree(){
    if(document.getElementById('btnSubmit').disabled == true ){
      document.getElementById('btnSubmit').disabled = false;
    }
    else{
      document.getElementById('btnSubmit').disabled = true;
    }
  };

</script>
@endpush