@extends('layouts.main')

@section('content')
@include('source.partials.blocks.page-header', ['title' => 'About Me', 'page' => 'About Me'])


<!-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'> -->


<section class="section-sm">
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
      dayMaxEvents: true,
      expandRows: true,
      firstDay: 1,
      events: @json($events), // eslint-disable-line

    });
    calendar.render();
  });
</script>


@endsection