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
            <div class="row">
                <div class="col-md-8">
                    <!-- Календар активних подій -->
                    <div id='calendar'></div>
                </div>
                <div class="col-md-4">
                    <!-- Список завершених подій -->
                    <div class="card">
                        <div class="card-header">Завершені події</div>
                        <div class="card-body">
                            @foreach ($finishedEvents as $event)
                                <div class="mb-4">
                                    <h1 class="h4">{{ $event->name }}</h4>
                                        <ul class="card-meta my-3 list-inline">
                                            <li class="list-inline-item">
                                                <a href="/about" class="card-meta-author">
                                                    <span>Світлана Савіцька</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                @php
                                                    $durationInSeconds = Carbon\Carbon::parse(
                                                        $event->end,
                                                    )->diffInSeconds(Carbon\Carbon::parse($event->start));

                                                    $durationInDays = floor($durationInSeconds / 86400);
                                                    $durationInHours = ceil($durationInSeconds / 3600);
                                                @endphp
                                                <i class="ti-timer"></i>
                                                @if ($durationInDays > 0)
                                                    {{ $durationInDays }} Дн. {{ $durationInHours % 24 }} Год.
                                                @else
                                                    {{ $durationInHours }} Год.
                                                @endif
                                            </li>
                                            <li class="list-inline-item">
                                                @php
                                                    $startDate = Carbon\Carbon::parse($event->start);
                                                    $formattedStartDate = $startDate
                                                        ->locale('uk')
                                                        ->isoFormat('D MMMM YYYY [о] H:mm');
                                                @endphp
                                                <i class="ti-calendar"></i>{{ $formattedStartDate }}
                                            </li>
                                            <li class="list-inline-item">
                                                <ul class="card-meta-tag list-inline">
                                                    @if (isset($event->category_id) && $event->category)
                                                        <li class="list-inline-item">
                                                            <a href="/category/{{ $event->category->id }}">
                                                                {{ $event->category->title }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                        <a href="/event/{{ $event->id }}" class="btn btn-primary">Детальніше</a>
                                </div>
                            @endforeach
                            <ul class="pagination justify-content-center">
                                {{ $finishedEvents->links('vendor.pagination') }}
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
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
                events: @json($activeEvents), // eslint-disable-line

            });
            calendar.render();
        });
    </script>
@endsection
