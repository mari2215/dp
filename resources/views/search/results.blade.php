@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="widget col-4">
                    <h4 class="widget-title"><span>Пошук</span></h4>
                    <form action="{{ route('search') }}" method="GET" class="widget-search">
                        <input class="mb-3" id="search-query" name="s" type="search" value="{{ $query }}"
                            placeholder="Введіть і натисніть Enter...">
                        <i class="ti-search"></i>
                        <button type="submit" class="btn btn-primary btn-block">Шукати</button>
                    </form>
                </div>
                <div class="col-lg-10 mb-4">
                    <h2 class="h2 mb-4">Результати пошуку <mark>{{ $query }}</mark></h2>
                </div>
                <div class="col-lg-10">
                    @if ($activities->isEmpty() && $events->isEmpty() && $categories->isEmpty())
                        <p>No results found.</p>
                    @else
                        @if (!$activities->isEmpty())
                            <h2 class="h5 section-title">Активності</h2>
                            @foreach ($activities as $activity)
                                <article class="card mb-4">
                                    <div class="row card-body">
                                        @if (isset($activity->image) && is_array($activity->image) && !empty($activity->image))
                                            <div class="col-md-4 mb-4 mb-md-0">
                                                <div class="post-slider slider-sm">
                                                    <img src="{{ asset($activity->image[0]) }}" class="card-img"
                                                        alt="post-thumb" style="height:200px; object-fit: cover;">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                            @else
                                                <div class="col-md-12">
                                        @endif
                                        <h3 class="h4 mb-3"><a class="post-title"
                                                href="/activity/{{ $activity->id }}">{{ $activity->title }}</a></h3>
                                        <ul class="card-meta list-inline">
                                            <li class="list-inline-item">
                                                <a href="/about" class="card-meta-author">
                                                    <span>Світлана Савіцька</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <ul class="card-meta-tag list-inline">
                                                    <li class="list-inline-item"><a
                                                            href="/category/{{ $activity->category->id }}">{{ $activity->category->title }}</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <p>{!! Str::limit(strip_tags($activity->description), 250) !!}</p>
                                        <a href="/activity/{{ $activity->id }}" class="btn btn-outline-primary">Переглянути
                                            деталі</a>
                                    </div>
                </div>
                </article>
                @endforeach
                @endif

                @if (!$events->isEmpty())
                    <h2 class="h5 section-title">Заходи</h2>
                    @foreach ($events as $event)
                        <article class="card mb-4">
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <h3 class="h4 mb-3"><a class="post-title"
                                            href="/event/{{ $event->id }}">{{ $event->title }}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="/about" class="card-meta-author">
                                                <span>Світлана Савіцька</span>
                                            </a>
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
                                            {{ $event->price }} грн.
                                        </li>
                                    </ul>
                                    <p>{!! Str::limit(strip_tags($event->description), 250) !!}</p>
                                    <a href="/event/{{ $event->id }}" class="btn btn-outline-primary">Переглянути
                                        деталі</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif

                @if (!$categories->isEmpty())
                    <h2 class="h5 section-title">Категорії</h2>
                    @foreach ($categories as $category)
                        <article class="card mb-4">
                            <div class="row card-body">
                                @if (isset($category->image) && is_array($category->image) && !empty($category->image))
                                    <div class="col-md-4 mb-4 mb-md-0">
                                        <div class="post-slider slider-sm">
                                            <img src="{{ asset($category->image[0]) }}" class="card-img" alt="post-thumb"
                                                style="height:200px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                    @else
                                        <div class="col-md-12">
                                @endif
                                <h3 class="h4 mb-3"><a class="post-title"
                                        href="/category/{{ $category->id }}">{{ $category->title }}</a></h3>
                                <p>{!! Str::limit(strip_tags($category->description), 250) !!}</p>
                                <a href="/category/{{ $category->id }}" class="btn btn-outline-primary">Переглянути
                                    деталі</a>
                            </div>
            </div>
            </article>
            @endforeach
            @endif
            @endif
        </div>
        </div>
        </div>
    </section>

@endsection
