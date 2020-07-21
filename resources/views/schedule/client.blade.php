@extends('layout.client')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/disable.css') }}">
@endpush

@section('title','Shedules - PRINTG')

@section('content')
<h2 style="padding-top:10px;"><strong>Jadwal Penggunaan Alat</strong></h2>
<p> Silakan klik tombol <strong>Lihat Jadwal</strong> pada masing-masing kategori berikut.</p>
<div class="row">
  <div class="col-md-4">
    <div class="card" >
      <div class="card-body">
        <table id="table" class="table table-striped table-hover table-bordered text-sm" style="width:100%"></table>
      </div>
    </div>
  </div>
  <div class="col-md-8">
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
    ajax: "{{ route('tool.dt') }}",
    columns: [
      {title: 'Nama', data: 'name', name: 'name', orderable:false, width: '60%', className: 'dt-head-center'},
      {title: 'Schedule', data: 'schedule', name: 'show', orderable:false, width: '40%', className: 'dt-center'}
    ],
  });
</script>
<script>
  var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listWeek'
    },
  //   defaultDate: '2019-08-12',
  //   editable: true,
    navLinks: true, // can click day/week names to navigate views
    dayMaxEvents: true, // allow "more" link when too many events
    events: {
      url: '{{ route('calendar.data') }}',
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
    loading: function(bool) {
      document.getElementById('loading').style.display =
        bool ? 'block' : 'none';
    }
  });

  calendar.render();

  // var calendarEl = document.getElementById('calendar');

  // var calendar = new FullCalendar.Calendar(calendarEl, {
  //   header: {
  //     left: 'prevYear,prev,next,nextYear today',
  //     center: 'title',
  //     right: 'dayGridMonth,dayGridWeek,dayGridDay'
  //   },
  //   navLinks: true, // can click day/week names to navigate views
  //   editable: true,
    
  // });

  // calendar.render();
</script>

@endpush