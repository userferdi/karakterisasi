@extends('layouts.index')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/disable.css') }}">
@endpush

@section('title','FINDER · Schedule')

@section('content')
<h3 style="padding-top:10px;"><strong>Jadwal Penggunaan Alat</strong></h3>
<p> Silakan klik tombol <strong>Lihat Jadwal</strong> pada masing-masing kategori berikut.</p>
<div class="row">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <table id="table" class="table table-striped table-hover table-bordered text-sm" style="width:100%"></table>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card" >
      <div class="card-body text-sm">
        <div id='calendar'></div></br>
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
    searching: false,
    paging: false,
    info: false,
    scrollX: true,
    ajax: "{{ route('tool.dt.schedule') }}",
    columns: [
      {title: 'Nama', data: 'name', name: 'name', orderable:false, className: 'dt-head-center'},
      {title: 'Jadwal', data: 'show', name: 'show', orderable:false, className: 'dt-center'}
    ],
  });

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    // editable: true,
    firstDay: 1,
    navLinks: true, // can click day/week names to navigate views
    dayMaxEvents: true, // allow "more" link when too many events
    events: {
      url: '{{ route('schedule.dataindex') }}',
      failure: function(){
        alert('error fetch data')
      }
    },
    // events: {
    //   url: 'https://sipa.nrcn.itb.ac.id/schedules',
    //   failure: function() {
    //     alert('error fetch data')
    //   }
    // },
    // loading: function(bool) {
    //   document.getElementById('loading').style.display =
    //     bool ? 'block' : 'none';
    // }
  });
  calendar.render();
});

</script>
@endpush