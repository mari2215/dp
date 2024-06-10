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
</style>
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class=" col-lg-9   mb-5 mb-lg-0">
        <article>
          @if(isset($activity->image))
          <div class="post-slider mb-3">
            @if(is_array($activity->image))
            @foreach ($activity->image as $image)
            <div class="card-img {{ $loop->first ? 'active' : '' }}">
              <img src="{{ asset($image) }}" class="img-fluid" alt="Image Description">
            </div>
            @endforeach
            @else
            {{-- Якщо це не масив, обробіть це як одне зображення --}}
            @if(!empty($activity->image))
            <div class="card-img active">
              <img src="{{ asset($activity->image) }}" class="img-fluid" alt="Image Description">
            </div>
            @endif
            @endif

          </div>
          @endif

          <h1 class="h2">{{ $activity->title }}</h1>
          <ul class="card-meta my-3 list-inline">
            <li class="list-inline-item">
              <a href="/about" class="card-meta-author">
                <span>Світлана Савіцька</span>
              </a>
            </li>
            <li class="list-inline-item">
              <ul class="card-meta-tag list-inline">
                @if (isset($activity->category_id) && $activity->category)
                <li class="list-inline-item">
                  <a href="/category/{{ $activity->category->id }}">
                    {{$activity->category->title}}
                  </a>
                </li>
                @endif
              </ul>
            </li>
          </ul>
          <div class="content">
            {!! str_replace('storage/', '', str_replace('storage//', 'storage/', $activity->description)) !!}
          </div>
        </article>
      </div>
    </div>
  </div>
</section>


@php
use App\Models\Activity;
$recommendedActivities = Activity::where('category_id', $activity->category->id)
->where('id', '!=', $activity->id)
->limit(4)
->get();
@endphp

<div class="container">
  <div class="row justify-content-center">
    @if(isset($recommendedActivities) && count($recommendedActivities) > 0)
    <h3 class="text-center">Рекомендації</h3>
    @foreach($recommendedActivities as $activity)
    <article class="card mb-4 col-lg-4 mx-2">
      <div class="card-body d-flex">
        <div class="ml-3">
          <h4><a href="/activity/{{ $activity->id }}" class="post-title">{{ $activity->title }}</a></h4>
          <ul class="card-meta list-inline mb-0">
            <li class="list-inline-item mb-0">
              <i class="ti-timer"></i>2 Min To Read
            </li>
          </ul>
        </div>
      </div>
    </article>
    @endforeach
    @endif
  </div>
</div>
@endsection