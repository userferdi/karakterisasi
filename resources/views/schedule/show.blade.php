@extends('layout.client')

@push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('calendar/main.css') }}">
@endpush

@section('title','Shedules - PRINTG')

@section('content')
<strong><h2 style="padding-top:10px;" id="title"></h2></strong>
<p> Silakan klik tombol <strong>Lihat Jadwal</strong> pada masing-masing kategori berikut.</p>
<div class="card" >
  <div class="card-body text-sm">
    <div id='calendar'></div></br>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    views: {
      timeGridWeek: {
        buttonText: 'Back',
      }
    },
    headerToolbar: {
      left: 'timeGridWeek prev,next',
      center: '', //title
      right: '',
    },

    initialView: 'timeGridWeek',
    allDaySlot: false,
    height: 'auto', //contentHeight: 'auto',
    locale: 'ind',
    firstDay: 1,
    slotDuration: '01:00:00',
    slotMinTime: '08:00',
    slotMaxTime: '16:00',
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

    // eventClick: function(event) {
    //   if (event.url) {
    //     return false;
    //   }
    // },
    // titleFormat: { // will produce something like "Tuesday, September 18, 2018"
    //     month: 'long',
    //     year: 'numeric',
    //     day: 'numeric',
    //     weekday: 'long',
    // },

      events: [
        {
          title: 'All Day Event',
          start: '2020-06-01',
        },
        {
          title: 'Long Event',
          start: '2020-07-20',
          end: '2020-07-21'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-06-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-06-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2020-07-20T10:30:00',
          end: '2020-07-21T12:30:00'
        },
        {
          title: 'Meeting',
          start: '2020-07-20T10:30:00',
          end: '2020-07-21T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2020-06-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2020-06-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2020-06-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2020-06-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2020-06-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2020-06-28'
        }
      ]
    });

    calendar.render();
});
</script>

@endpush