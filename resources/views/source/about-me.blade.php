@extends('layouts.main')

@section('content')
@include('source.partials.blocks.page-header', ['title' => 'About Me', 'page' => 'About Me'])

<section class="section-sm">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
        <div class="image-wrapper">
          <img class="img-fluid w-100" src="theme/theme/images/about-me.jpg">
        </div>
      </div>
      <div class="col-lg-5 col-md-6">
        <div class="content pl-lg-3 pl-0">
          <h2 id="helllo-im-richi-andorn-im-a-biography-based-researcher-and-author">{!! Str::markdown($psychologist->title) !!}</h2>
          <p>{!! Str::markdown($psychologist->subtitle) !!}</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-sm">
  <div class="container">
    <div class="row">

      <div class="col-12 text-center mb-5">
        <h2>Educational Qualification <br> That I Have Gathered</h2>
      </div>

      @foreach ($qualifications as $qualification)
      <div class="col-lg-3 col-sm-6 text-center mb-4">
        <h3 class="border-bottom pb-3 mb-3 mx-2">{{ $qualification->degree }}</h3>
        <p class="mb-2">
          @php
          $startDate = Carbon\Carbon::parse($qualification->start_date);
          $graduationDate = Carbon\Carbon::parse($qualification->graduation_date);

          $formattedStartDate = $startDate->locale('uk')->isoFormat('MMM Y');
          $formattedGraduationDate = $graduationDate->locale('uk')->isoFormat('MMM Y');
          @endphp

          {{ $formattedStartDate }} - {{ $formattedGraduationDate }}
        </p>
        <p>{{ $qualification->institution }}</p>
      </div>
      @endforeach



    </div>
  </div>
</section>

<section class="section wave">
  <img src="theme/theme/images/backgrounds/wave-bg.svg" class="wave-bg">
  <div class="container">
    <div class="row justify-content-around align-items-center">
      <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
        <h2 class="mb-4">What is the main mission of mine and what i wanna do?</h2>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
      </div>
      <div class="col-lg-4 col-md-6">
        <img src="theme/theme/images/mission.png" class="img-fluid">
      </div>
    </div>
  </div>


  <svg class="wave-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306" stroke-miterlimit="10" />
    <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
    <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306" stroke-miterlimit="10" />
  </svg>


  <svg class="wave-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g filter="url(#filter0_d)">
      <path class="path" d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
      <path d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z" stroke="#040306" stroke-miterlimit="10" />
    </g>
    <defs>
      <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix" />
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
        <feOffset dy="4" />
        <feGaussianBlur stdDeviation="2" />
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
      </filter>
    </defs>
  </svg>


  <svg class="wave-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306" stroke-miterlimit="10" />
    <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
    <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306" stroke-miterlimit="10" />
  </svg>


  <svg class="wave-shape-4" width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g filter="url(#filter0_d)">
      <path class="path" d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
      <path d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z" stroke="#040306" stroke-miterlimit="10" />
    </g>
    <defs>
      <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix" />
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
        <feOffset dy="4" />
        <feGaussianBlur stdDeviation="2" />
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
      </filter>
    </defs>
  </svg>
</section>

<section class="section-sm">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-5 col-md-6 order-2 order-md-1 text-center text-md-left">
        <h2 class="mb-4">{!!Str::markdown($psychologist->youtube_title)!!}</h2>

        <a href="{{$psychologist->video_url}}" class="btn btn-primary">Visit Channel</a>
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


<section class="section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2 class="mb-5">My Contents also published <br> on these websites</h2>
        <ul class="list-inline logo-list">
          <li class="list-inline-item">
            <a href="{{ $psychologist->facebook }}" target="_blank">
              <img class="img-fluid" src="theme/theme/images/logos/logo-1.png" alt="Facebook Logo">
            </a>
          </li>
          <li class="list-inline-item">
            <a href="{{ $psychologist->instagram }}" target="_blank">
              <img class="img-fluid" src="theme/theme/images/logos/insta-logo.png" alt="Instagram Logo">
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://t.me/{{ $psychologist->telegram }}" target="_blank"><img class="img-fluid" src="theme/theme/images/logos/telegram-logo.png" alt="Telegram Logo">
            </a>
          </li>
          <li class="list-inline-item">
            <a href="viber://chat?number={{ $psychologist->viber }}" target="_blank">
              <img class="img-fluid" src="theme/theme/images/logos/viber-logo.png" alt="Viber Logo">
            </a>

          </li>
        </ul>

      </div>
    </div>
  </div>
</section>

@endsection