@extends('layouts.index')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
@endpush

@section('title','FINDER · Shedules')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <h3>
      <a href=".." type="button" class="btn btn-secondary btn-sm">Back</a>
      <strong>{{$model->name}}</strong>
    </h3>
  </div>
  <div id='calendar'></div></br>
</div>
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
      url: '{{ route('schedule.data', $model->id) }}',
      failure: function(){
        alert('error fetch data')
      }
    },
  });
  calendar.render();
});
</script>

@endpush