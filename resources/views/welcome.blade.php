@extends('layouts.main')
@section('content')

    <style>
        .card-img img {
            object-fit: none;
            object-position: center;
            width: 100%;
            max-height: 250px;
            margin-bottom: 1rem;
        }

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
    </style>

    <div style="min-height: 50vh; margin-bottom: 30px;">
        <section class="section-sm ">
            <?php
            $pageInfo = App\Models\MainPage::where(function ($query) {
                $query
                    ->where('publishing_ends_at', '>=', now())
                    ->orWhere(function ($query) {
                        $query->whereNull('publishing_ends_at')->where('publishing_begins_at', '<=', now());
                    })
                    ->orWhereNull('publishing_begins_at');
            })->first(); // Використовуємо first() замість get() для отримання одного запису
            ?>

            @if ($pageInfo)
                <div class="container div">
                    <x-flexible-hero :page="$pageInfo" />
                    <x-flexible-content-blocks :page="$pageInfo" />
                </div>
            @else
                @include('source.partials.blocks.page-header', [
                    'title' => 'Головна',
                    'page' => 'Головна',
                ])
            @endif
            <div class="container">
                <div class="row justify-content-center">
                    <div class="row justify-content-center">
                        <aside class="col-lg-4 @@sidebar">
                            <!-- Search -->
                            <div class="widget">
                                <h4 class="widget-title"><span>Пошук</span></h4>
                                <form action="{{ route('search') }}" method="GET" class="widget-search">
                                    <input class="mb-3" id="search-query" name="s" type="search"
                                        placeholder="Введіть і натисніть Enter...">
                                    <i class="ti-search"></i>
                                    <button type="submit" class="btn btn-primary btn-block">Шукати</button>
                                </form>
                            </div>

                            <!-- categories -->
                            @if (isset($categories))
                                <div class="widget widget-categories">
                                    <h4 class="widget-title"><span>Категорії</span></h4>
                                    <ul class="list-unstyled widget-list">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="/category/{{ $category->id }}" class="d-flex">
                                                    {{ $category->title }}
                                                    <small class="ml-auto">({{ $category->activities_count }})</small>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (isset($categories))
                                <div class="widget">
                                    <h4 class="widget-title">Заплановані заходи</h4>
                                    @foreach ($events as $event)
                                        @if ($event->end >= now())
                                            <article class="card mb-4">
                                                <div class="card-body d-flex">
                                                    <div class="ml-3">
                                                        <h4><a href="/event/{{ $event->id }}"
                                                                class="post-title">{{ $event->name }}</a></h4>
                                                        <ul class="card-meta list-inline mb-0">
                                                            <li class="list-inline-item mb-0">
                                                                @php
                                                                    $startDate = Carbon\Carbon::parse($event->start);
                                                                    $formattedStartDate = $startDate
                                                                        ->locale('uk')
                                                                        ->isoFormat('D MMMM YYYY [о] H:mm');
                                                                @endphp
                                                                <i class="ti-calendar"></i>{{ $formattedStartDate }}
                                                            </li>
                                                            <li class="list-inline-item mb-0">
                                                                {{ $event->price }} грн.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </article>
                                        @endif
                                    @endforeach
                                </div>
                            @endif


                            @if (isset($psychologist->instagram) ||
                                    isset($psychologist->telegram) ||
                                    isset($psychologist->viber) ||
                                    isset($psychologist->facebook))
                                <div class="widget">
                                    <h4 class="widget-title"><span>Контакти</span></h4>
                                    <ul class="list-inline widget-social">
                                        @if (isset($psychologist->facebook))
                                            <li class="list-inline-item"><a href="{{ $psychologist->facebook }}"><i
                                                        class="ti-facebook"></i></a></li>
                                        @endif
                                        @if (isset($psychologist->instagram))
                                            <li class="list-inline-item"><a href="{{ $psychologist->instagram }}"><i
                                                        class="ti-instagram"></i></a></li>
                                        @endif
                                        @if (isset($psychologist->viber))
                                            <li class="list-inline-item"><a href="{{ $psychologist->viber }}"><i
                                                        class="bi bi-whatsapp"></i></a></li>
                                        @endif
                                        @if (isset($psychologist->facebook))
                                            <li class="list-inline-item"><a href="{{ $psychologist->telegram }}"><i
                                                        class="bi bi-telegram"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </aside>

                        @if (isset($activities))
                            <div class="col-lg-8 mb-5 mb-lg-0">
                                <h2 class="h5 section-title">Нещодавно додані</h2>
                                @foreach ($activities as $activity)
                                    <article class="card mb-4">
                                        @if (isset($activity->image))
                                            <div class="post-slider">
                                                @if (is_array($activity->image))
                                                    @foreach ($activity->image as $image)
                                                        <div class="card-img {{ $loop->first ? 'active' : '' }}">
                                                            <img src="{{ asset($image) }}" class="img-fluid"
                                                                alt="Image Description">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @if (!empty($activity->image))
                                                        <div class="card-img active">
                                                            <img src="{{ asset($activity->image) }}" class="img-fluid"
                                                                alt="Image Description">
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <h3 class="mb-3">
                                                <a class="post-title"
                                                    href="/activity/{{ $activity->id }}">{{ $activity->title }}</a>
                                            </h3>
                                            <ul class="card-meta list-inline">
                                                <li class="list-inline-item">
                                                    <a href="/about" class="card-meta-author">
                                                        <span>Світлана Савіцька</span>
                                                    </a>
                                                </li>
                                                @if (isset($activity->category))
                                                    <li class="list-inline-item">
                                                        <ul class="card-meta-tag list-inline">
                                                            <li class="list-inline-item"><a
                                                                    href="/category/{{ $category->id }}">{{ $activity->category->title }}</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                @endif
                                            </ul>
                                            <p>{!! Str::limit($activity->description, 150) !!}</p>
                                            <a href="/activity/{{ $activity->id }}"
                                                class="btn btn-outline-primary">Переглянути
                                                деталі</a>
                                        </div>
                                    </article>
                                @endforeach

                                <ul class="pagination justify-content-center">
                                    {{ $activities->links('vendor.pagination') }}
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </section>
    </div>
@endsection
