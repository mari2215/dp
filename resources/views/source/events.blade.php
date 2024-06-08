@extends('layouts.main')

@section('content')
<style>
  .fc .fc-button-primary {
    color: black;
    background-color: #00d97d !important;
    border-color: #FFFFFF !important;
  }

  .div {
    padding-top: 120px;
  }
</style>
<section class="section-sm div">
  <div class="container">
    <div id='calendar'></div>
  </div>
</section>


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
  var initialLocaleCode = 'uk';
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next',
        center: '',
        right: 'title,dayGridMonth,listMonth',
      },
      buttonText: {
        today: 'Сьогодні',
        month: 'Місяць',
        week: 'Тиждень',
        day: 'День',
        list: 'Порядок денний',
      },
      themeSystem: 'bootstrap5',
      locale: initialLocaleCode,
      height: 600,
      contentHeight: 780,
      dayMaxEvents: 2,
      expandRows: true,
      firstDay: 1,
      events: @json($events), // eslint-disable-line

    });
    calendar.render();
  });
</script>


@endsection