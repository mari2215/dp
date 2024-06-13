<style>
    @media (min-width: 992px) {
        .div {
            padding-top: 120px;
        }
    }

    @media (max-width: 992px) {
        .div {
            padding-top: 80px;
        }
    }

    .nav-tabs {
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        border: 1px solid #ddd;
        border-radius: 0;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    @media(max-width:991px) {
        .widget {
            display: none;
        }
    }
</style>
@extends('layouts.main')
@section('content')

    @php
        $unreadBookings = $bookings->filter(function ($booking) {
            return $booking->user_id == auth()->id();
        });
        $unreadCount = $unreadBookings->count();
    @endphp

    <div class="container div">
        <div class="row">
            <aside class="col-lg-4">


                <div class="widget widget-about">
                    <h4 class="widget-title">{{ Auth::user()->name }}</h4>
                </div>
                <ul class="nav nav-tabs nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link active btn btn-outline-primary mb-2 btn-block" href="#"
                            data-target="#profile-settings">Налаштування профілю</a>
                    </li>
                </ul>
                <div class="widget">
                    <h4 class="widget-title"><span>Останні бронювання</span></h4>
                    @if ($unreadCount > 0)
                        @foreach ($unreadBookings->take(2) as $booking)
                            <article class="widget-card">
                                <div class="d-flex">
                                    <div class="ml-3">
                                        <h5><a class="post-title"
                                                href="/event/{{ $booking->event->id }}">{{ $booking->event->name }}</a></h5>
                                        <ul class="card-meta list-inline mb-0">
                                            <li class="list-inline-item mb-0">
                                                @php
                                                    $startDate = Carbon\Carbon::parse($booking->event->start);
                                                    $formattedStartDate = $startDate
                                                        ->locale('uk')
                                                        ->isoFormat('D MMMM YYYY [о] H:mm');
                                                @endphp
                                                <i class="ti-calendar"></i>{{ $formattedStartDate }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p>Немає записів</p>
                    @endif

                </div>
                <ul class="nav nav-tabs nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link btn mb-2  btn btn-outline-primary btn-block" href="#"
                            data-target="#all-bookings">Бронювання</a>
                    </li>
                </ul>
                <div class="widget">
                    <h4 class="widget-title">Останні коментарі</h4>
                    @if (!isset($comments) || $comments->isEmpty())
                        <p>Коментарі відсутні 🤖</p>
                    @else
                        @foreach ($comments->take(2) as $comment)
                            <article class="widget-card">
                                <div class="d-flex"
                                    style="min-width: 250px; word-wrap: break-word; overflow-wrap: break-word;">
                                    <div class="ml-3">
                                        <h5><a class="post-title"
                                                href="/event/{{ $comment->event->id }}">{{ $comment->event->name }}</a></h5>
                                        <p>{{ Str::limit($comment->comment, 60) }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>

                <ul class="nav nav-tabs nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link btn mb-2  btn btn-outline-primary btn-block" href="#"
                            data-target="#all-comments">Коментарі</a>
                    </li>
                </ul>
            </aside>
            <!-- Main Content Area -->
            <div class="col-lg-8 mb-5 mb-lg-3">
                <h1 class="h2 mb-4">Профіль користувача <mark>{{ Auth::user()->name }}</mark></h1>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profile-settings">
                        @include('profile.partials.update-profile-information-form')

                        @if (Auth::check() && !Auth::user()->is_google_user)
                            @include('profile.partials.update-password-form')
                        @endif
                    </div>
                    <div class="tab-pane fade" id="all-bookings">

                        @if ($unreadCount > 0)
                            @foreach ($unreadBookings as $booking)
                                <article class="mb-4">
                                    <div class="row card">
                                        <div class="col-md-12 card-body">
                                            <a class="post-title"
                                                href="/event/{{ $booking->event->id }}">{{ $booking->event->name }}</a>
                                            <ul class="card-meta list-inline">
                                                <li class="list-inline-item">
                                                    <ul class="card-meta-tag list-inline">
                                                        <li class="list-inline-item">
                                                            <a class="payment-status"
                                                                style="color: {{ $booking->payment_status ? '#28a745' : '#dc3545' }};">
                                                                {{ $booking->payment_status ? 'оплачено' : 'не оплачено' }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="list-inline-item">
                                                    @php
                                                        $startDate = Carbon\Carbon::parse($booking->event->start);
                                                        $formattedStartDate = $startDate
                                                            ->locale('uk')
                                                            ->isoFormat('D MMMM YYYY [о] H:mm');
                                                    @endphp
                                                    <i class="ti-calendar"></i>{{ $formattedStartDate }}
                                                </li>
                                                <li class="list-inline-item">
                                                    <ul class="card-meta-tag list-inline">
                                                        @if (isset($booking->event->category_id) && $booking->event->category)
                                                            <li class="list-inline-item">
                                                                <a href="/category/{{ $booking->event->category->id }}">
                                                                    {{ $booking->event->category->title }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </li>
                                                <li class="list-inline-item">
                                                    <ul class="card-meta-tag list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="">{{ $booking->status }}</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <p>{{ $booking->notes }}</p>
                                            @if ($booking->status == 'відхилено')
                                                <button class="btn btn-outline-primary btn-sm mt-2" disabled>
                                                    Бронювання {{ $booking->status }}
                                                </button>
                                            @else
                                                <a href="#" class="btn btn-outline-primary reject-booking"
                                                    data-booking-id="{{ $booking->id }}">Відхилити бронювання</a>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <p>Немає записів</p>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="all-comments">
                        @if (!isset($comments) || $comments->isEmpty())
                            <p>Коментарі відсутні 🤖</p>
                        @else
                            @foreach ($comments as $comment)
                                <div class="w-100 py-2 px-2"
                                    style="background-color: #f1f1f1; border-bottom: 1px solid #ccc;">
                                    <a class="d-inline-block mr-2" style="text-decoration: none;" href="#">
                                        <div class="user-icon rounded-circle"
                                            style="min-width:30px; min-height:30px; background-color: {{ 'hsl(' . hexdec(substr(md5($comment->username), 0, 2)) . ', 60%, 50%)' }};">
                                            <center>
                                                <span class="initial"
                                                    style="line-height:30px;color: white; text-transform: uppercase;">
                                                    {{ mb_substr($comment->username, 0, 1) }}
                                                </span>
                                            </center>
                                        </div>
                                    </a>
                                    <span><strong>{{ $comment->username }}</strong> коментар під записом <a
                                            href="/event/{{ $comment->event->id }}"
                                            class="alert-link">"{{ $comment->event->name }}"</a></span>
                                </div>


                                <div class="d-sm-flex my-3 form mr-2 px-2" style="margin-left: 20px; min-width: 300px;">
                                    <div class="media-body pr-3"
                                        style="min-width: 250px; word-wrap: break-word; overflow-wrap: break-word;">
                                        <div class="d-flex justify-content-between align-items-center">

                                            {{ \Carbon\Carbon::parse($comment->created_at)->locale('uk')->isoFormat('H:mm DD/MM/YY') }}
                                            <form id="delete-comment-form-{{ $comment->id }}"
                                                action="{{ route('comments.destroy', ['id' => $comment->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <a type="" class="delete-comment-btn"
                                                    data-comment-id="{{ $comment->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </form>
                                        </div>
                                        <div>{{ $comment->comment }}</div>
                                        <div class="d-flex justify-content-between align-items-center mb-lg-3">
                                            <div class="d-flex justify-content-between">
                                                <p></p>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.reject-booking').on('click', function(e) {
                e.preventDefault();

                var bookingId = $(this).data('booking-id');
                var button = $(this);
                var url = '/reject-booking'; // URL до вашого маршруту для відхилення бронювання

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Додаємо CSRF-токен
                        booking_id: bookingId
                    },
                    success: function(response) {
                        if (response.success) {
                            button.text('Бронювання відхилено');
                            button.addClass('disabled');
                            button.attr('disabled', true);
                        } else {
                            alert('Сталася помилка: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Сталася помилка: ' + error);
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (!$._data(document, 'events') || !$._data(document, 'events')['click'] || !$._data(document,
                    'events')['click'].some(event => event.selector === '.delete-comment-btn')) {
                $(document).on('click', '.delete-comment-btn', function(e) {
                    e.preventDefault();
                    var commentId = $(this).data('comment-id');
                    if (confirm("Ви впевнені, що хочете видалити цей коментар?")) {
                        $('#delete-comment-form-' + commentId).submit();
                    } else {
                        return false;
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const tabPanes = document.querySelectorAll('.tab-pane');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('data-target');

                    navLinks.forEach(nav => nav.classList.remove('active'));
                    tabPanes.forEach(tab => tab.classList.remove('show', 'active'));

                    this.classList.add('active');
                    document.querySelector(target).classList.add('show', 'active');
                });
            });
        });
    </script>
@stop
