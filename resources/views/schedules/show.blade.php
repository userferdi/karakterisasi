@extends('layouts.index')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
@endpush

@section('title','FINDER · Shedules')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <h3>
      <a href=".." type="button" class="btn btn-primary btn-sm">Back</a>
      <strong>{{$model->name}}</strong>
    <!-- <h3 class="panel-title mb-3 mx-auto" style="width: 70px;"></h3> -->
    </h3>
  </div>
  <div id='calendar'></div></br>
</div>

  <!-- <div class="col-md-12">   -->
  <!-- </div> -->
<!-- </div> -->
  <!-- </div> -->
<!-- </div> -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    views: {
      timeGridWeek: {
        // buttonText: '',
      }
    },
    headerToolbar: {
      // left: 'prev,next today',
      // center: 'title',
      // right: 'dayGridMonth,timeGridWeek,listWeek'
      left: 'prev,next',
      center: 'title',
      right: '',
    },

    initialView: 'timeGridWeek',
    allDaySlot: false,
    height: 'auto', //contentHeight: 'auto',
    locale: 'ind',
    firstDay: 1,
    slotDuration: '01:00:00',
    slotMinTime: '08:00',
    slotMaxTime: '16:01',
    slotEventOverlap: false,
    // navLinks: true, // can click day/week names to navigate views
    dayMaxEvents: true, // allow "more" link when too many events

    dayHeaderFormat: {
      weekday: 'long',
      day: 'numeric',
      month: 'long',
      // omitCommas: true,
    },
    slotLabelFormat: {
      hour: '2-digit',
      minute: '2-digit',
      // omitZeroMinute: false,
      meridiem: false,
      hour12: false,
    },
    titleFormat: { // will produce something like "Tuesday, September 18, 2018"
        month: 'long',
        year: 'numeric',
        day: 'numeric',
        // weekday: 'long',
    },

    // eventClick: function(event) {
    //   if (event.url) {
    //     return false;
    //   }
    // },
    events: {
      // url: $event,
      url: '{{ route('schedule.data', $model->id) }}',
      failure: function(){
        alert('error fetch data')
      }
    },

      // events: [
      //   {
      //     title: 'Conference',
      //     start: '2020-07-20T10:30:00',
      //     end: '2020-07-21T12:30:00'
      //   },
      //   {
      //     title: 'Meeting',
      //     start: '2020-07-20T10:30:00',
      //     end: '2020-07-21T12:30:00'
      //   },
      // ]
    });
    calendar.render();
});

// document.addEventListener('DOMContentLoaded', function() {
//   var me = document.getElementById('title'),
//       // url = title.attr('href'),
//       title = me.attr('name');
//   me.text(title);
// $.ajax({
//       // url: url,
//       dataType: 'html',
//         $('#title').text(title);
//     });

// });
  // var title = new FullCalendar.Calendar(titleEl, {

</script>

@endpush