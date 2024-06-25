@extends('layouts.main')

@section('content')
    {{-- @include('source.partials.blocks.page-header', ['title' => 'About Me', 'page' => 'About Me']) --}}

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-9   mb-5 mb-lg-0">
                    <article>
                        <div class="post-slider mb-4">
                            <img src="https://picsum.photos/600/150" class="card-img" alt="post-thumb">
                        </div>

                        <h1 class="h2">{{ $event->name }}</h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="/about" class="card-meta-author">
                                    <span>Світлана Савіцька</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                @php
                                    $durationInSeconds = Carbon\Carbon::parse($event->end)->diffInSeconds(
                                        Carbon\Carbon::parse($event->start),
                                    );

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
                                    $formattedStartDate = $startDate->locale('uk')->isoFormat('D MMMM YYYY [о] H:mm');
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
                        <div class="content">
                            {!! str_replace('storage/', '', str_replace('storage//', 'storage/', $event->description)) !!}
                        </div>
                    </article>
                    <center>
                        @if (Auth::check() && Auth::user()->hasRegistrationForEvent($event->id))
                            <button class="btn btn-outline-primary btn-sm mt-2" disabled>
                                Бронь {{ Auth::user()->bookings()->where('event_id', $event->id)->first()->status }}
                            </button>
                        @elseif($event->end < now())
                            <button class="btn btn-outline-secondary btn-sm mt-2" disabled>
                                Подія завершена
                            </button>
                        @else
                            @auth
                                <button class="btn btn-outline-primary btn-sm mt-2" data-toggle="modal" data-target="#myModal"
                                    href="">
                                    Подати заявку
                                </button>
                            @endauth
                            @guest
                                <a class="btn btn-outline-primary btn-sm mt-2" href="{{ route('login') }}">
                                    Подати заявку
                                </a>
                            @endguest
                        @endif

                    </center>
                </div>


                <div class="col-lg-9 col-md-12">
                    <div class="mb-5 border-top mt-4 pt-5">
                        <h3 class="mb-4">Коментарі</h3>

                        @if (!isset($comments) || $comments->isEmpty())
                            <p>Коментарі відсутні 🤖</p>
                        @else
                            @include('comments.comments', ['comments' => $comments, 'level' => 0])
                        @endif

                    </div>

                    <div>
                        <h3 class="mb-4">Залиште коментар</h3>
                        <form method="POST" action="{{ url('comment/' . $event->id) }}" id="comment-form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <input type="hidden" name="parent_id">
                                    @guest
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-group">
                                                <input class="form-control shadow-none" type="text" name="username"
                                                    placeholder="Ім'я" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control shadow-none" type="email" name="email"
                                                    placeholder="Електронна адреса" required>
                                            </div>
                                        </div>
                                    @endguest
                                    <textarea class="form-control shadow-none" name="comment" rows="7" placeholder="Сочиніть коментар..." required></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Надіслати</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
            <div class="modal-content border-0 bg-white">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title" id="exampleModalGridTitle">Заповніть заявку</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (isset($psychologist->instagram) ||
                            isset($psychologist->telegram) ||
                            isset($psychologist->viber) ||
                            isset($psychologist->facebook))
                        <div class="widget">
                            <h5 class="widget-title"><span>Для підтвердження бронювання установіть контакт з
                                    психологом</span></h5>
                            <ul class="list-inline widget-social">
                                @if (isset($psychologist->facebook))
                                    <li class="list-inline-item"><a href="{{ $facebook }}"><i
                                                class="ti-facebook"></i></a></li>
                                @endif
                                @if (isset($psychologist->instagram))
                                    <li class="list-inline-item"><a href="{{ $instagram }}"><i
                                                class="ti-instagram"></i></a></li>
                                @endif
                                @if (isset($psychologist->viber))
                                    <li class="list-inline-item"><a href="{{ $viber }}"><i
                                                class="bi bi-whatsapp"></i></a></li>
                                @endif
                                @if (isset($psychologist->facebook))
                                    <li class="list-inline-item"><a href="{{ $telegram }}"><i
                                                class="bi bi-telegram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ url('book/' . $event->id) }}" id="comment-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <p>Підтвердіть реєстрацію заявки на участь в заході "{{ $event->name }}"</p>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Надіслати</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var replyButtons = document.querySelectorAll('.reply-btn');
            var form = document.querySelector('#comment-form');

            replyButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var parentId = this.getAttribute('data-parent-id');
                    var userId = document.getElementById('data-user-id').getAttribute(
                        'data-user-id');
                    console.log('Parent ID:', parentId);
                    console.log('User ID:', userId);
                    var parentIdInput = form.querySelector('input[name="parent_id"]');
                    parentIdInput.value = parentId;
                    var commentInput = form.querySelector('textarea[name="comment"]');
                    commentInput.value = '@' + userId + ', ';
                });
            });
        });
    </script>
@endsection
