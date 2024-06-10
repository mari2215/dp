@extends('layouts.main')

@section('content')
@include('source.partials.blocks.page-header', ['title' => 'Про мене', 'page' => 'Про мене'])

<div class="container">
  <div class="row align-items-center justify-content-center">

    <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
      <div class="post-slider">
        @foreach ($psychologist->image as $image)
        <div class="card-img {{ $loop->index == 0 ? 'active' : '' }}">
          <img src="{{ asset($image) }}" class="img-fluid" alt="Image Description">
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-lg-5 col-md-6">
      <div class="content pl-lg-3 pl-0">
        <h2 id="helllo-im-richi-andorn-im-a-biography-based-researcher-and-author">{!! ($psychologist->title) !!}</h2>
      </div>
    </div>
    <div class="container m-auto">
      <p>{!! ($psychologist->subtitle) !!}</p>
    </div>
  </div>
</div>
@if (isset($qualifications))
<div class="container">
  <div class="row">
    <div class="col-12 text-center mb-5">
      <h2>Освіта та сертифікати</h2>
    </div>
    @foreach ($qualifications as $qualification)
    <div class="col-lg-3 col-sm-6 text-center mb-4">

      <li class="list-inline-item">
        <img class="img-fluid" src="{{ asset($qualification->image) }}" alt="Image Description">
      </li>

      <h3 class="border-bottom pb-3 mb-3 mx-2">{{ $qualification->degree }}</h3>
      <p class="mb-2">
        @php
        $startDate = Carbon\Carbon::parse($qualification->start_date);
        $graduationDate = Carbon\Carbon::parse($qualification->graduation_date);
        $formattedStartDate = $startDate->locale('uk')->isoFormat('MMMM YYYY');
        $formattedGraduationDate = $graduationDate->locale('uk')->isoFormat('MMMM YYYY');
        @endphp
        {{ $formattedStartDate }} - {{ $formattedGraduationDate }}
      </p>
      <p>{{ $qualification->institution }}</p>
    </div>
    @endforeach
  </div>
</div>
@endif
@if (isset($$psychologist->video_url))
<section class="section-sm">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-5 col-md-6 order-2 order-md-1 text-center text-md-left">
        <h2 class="mb-4">{!!Str::markdown($psychologist->youtube_title)!!}</h2>
        <a href="{{$psychologist->video_url}}" class="btn btn-primary">Перегляньте на ютубі</a>
      </div>
      <div class="col-lg-5 col-md-6 mb-4 mb-md-0 order-1 order-md-2">
        <div class="video-wrapper">
          <img src="{{'https://img.youtube.com/vi/' . explode('?', explode('/', $psychologist->video_url)[3])[0] . '/maxresdefault.jpg'}}" class="img-fluid">
          <a class="play-btn video-btn" data-toggle="modal" data-src="{{'https://youtube.com/embed/' . explode('/', $psychologist->video_url)[3]}}" data-target="#myModal" href="{{$psychologist->youtube_url}}"><i class="ti-control-play"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content border-0 bg-transparent">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="{{'https://youtube.com/embed/' . explode('/', $psychologist->video_url)[3]}}" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

@if (isset($psychologist))
<div class="container my-3">
  <div class="row">
    <div class="col-lg-10 mx-auto text-center">
      <h3 class="mb-5">Підтримуйте зв'язок <br> з допомогою наступних сервісів</h3>
      <ul class="list-inline logo-list">
        @if (isset($psychologist->facebook))
        <li class="list-inline-item">
          <a href="{{ $psychologist->facebook }}" target="_blank">
            <img class="img-fluid" src="theme/theme/images/logos/logo-1.png" alt="Facebook Logo">
          </a>
        </li>
        @endif
        @if (isset($psychologist->instagram))
        <li class="list-inline-item">
          <a href="{{ $psychologist->instagram }}" target="_blank">
            <img class="img-fluid" src="theme/theme/images/logos/insta-logo.png" alt="Instagram Logo">
          </a>
        </li>
        @endif
        @if (isset($psychologist->telegram))
        <li class="list-inline-item">
          <a href="https://t.me/{{ $psychologist->telegram }}" target="_blank"><img class="img-fluid" src="theme/theme/images/logos/telegram-logo.png" alt="Telegram Logo">
          </a>
        </li>
        @endif
        @if (isset($psychologist->viber))
        <li class="list-inline-item">
          <a href="viber://chat?number={{ $psychologist->viber }}" target="_blank">
            <img class="img-fluid" src="theme/theme/images/logos/viber-logo.png" alt="Viber Logo">
          </a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</div>
@endif
@endsection