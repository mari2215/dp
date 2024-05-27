<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title>Proj</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="This is meta description">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Hugo 0.74.3" />

  <!-- theme meta -->
  <meta name="theme-name" content="reader" />

  <!-- plugins -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="{{ asset('theme/theme/plugins/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="{{ asset('theme/theme/plugins/themify-icons/themify-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('theme/theme/plugins/slick/slick.css')}}" rel="stylesheet">

  <!-- Main Stylesheet -->
  <link href="{{ asset('theme/theme/css/style.css')}}" media="screen" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="{{ asset('theme/theme/images/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('theme/theme/images/favicon.png')}}" type="image/x-icon">

</head>
<style>
  /* @keyframes slideOutRight {
    0% {
      transform: translateX(0);
      opacity: 1;
    }

    100% {
      transform: translateX(100%);
      opacity: 0;
      height: 0;
      margin: 0;
      padding: 0;
    }
  }

  .slide-out-right {
    animation: slideOutRight 0.3s forwards;
    position: relative;
  }
   */
  .card {
    transition: height 0.3s ease, opacity 0.3s ease;
  }

  /* .card {
    transition: height 0.3s ease, margin 0.3s ease, padding 0.3s ease;
  } */
</style>


<body>
  <header class="navigation fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="/">
          <img class="img-fluid" width="50px" src="{{ asset('theme/theme/images/logo.png')}}" alt="Reader | Hugo Personal Blog Template">
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                homepage <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="index-full.html">Homepage Full Width</a>

                <a class="dropdown-item" href="index-full-left.html">Homepage Full With Left Sidebar</a>

                <a class="dropdown-item" href="index-full-right.html">Homepage Full With Right Sidebar</a>

                <a class="dropdown-item" href="index-list.html">Homepage List Style</a>

                <a class="dropdown-item" href="index-list-left.html">Homepage List With Left Sidebar</a>

                <a class="dropdown-item" href="index-list-right.html">Homepage List With Right Sidebar</a>

                <a class="dropdown-item" href="index-grid.html">Homepage Grid Style</a>

                <a class="dropdown-item" href="index-grid-left.html">Homepage Grid With Left Sidebar</a>

                <a class="dropdown-item" href="index-grid-right.html">Homepage Grid With Right Sidebar</a>

              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                About <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">

                <a class="dropdown-item" href="/about">About Me</a>
                <a class="dropdown-item" href="about-us.html">About Us</a>

              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/events">Розклад подій</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">
                @if (isset($categories))
                @foreach ($categories as $category)
                <a class="dropdown-item" href="/category/{{ $category->id }}">
                  {{ $category->title }}
                </a>
                @endforeach
                @endif
              </div>

            </li>


            <li class="nav-item dropdown d-lg-none">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @auth{{ Auth::user()->name }}@endauth
                @guest Profile @endguest
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                @auth
                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                <a class="dropdown-item" href="/profile">Edit Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </a>
                </form>
                @endauth
                @guest
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="dropdown-item">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                @endif
                @endif
                @endguest
              </div>
            </li>
            <li class="nav-item d-lg-none">

              <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="bi bi-bell text-dark"></i>
              </button>
            </li>

          </ul>

        </div>


        <div class="order-2 order-lg-3 d-flex align-items-center">
          <!-- search -->
          <form class="search-bar">
            <input id="search-query" name="s" type="search" placeholder="Type &amp; Hit Enter...">
          </form>

          <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse" data-target="#navigation">
            <i class="ti-menu"></i>
          </button>



          <div class="collapse navbar-collapse" id="navbar-list-4">
            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
              <i class="bi bi-bell text-dark"></i>
            </button>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @auth{{ Auth::user()->name }}@endauth
                  @guest Profile @endguest
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                  @auth
                  <a class="dropdown-item" href="/dashboard">Dashboard</a>
                  <a class="dropdown-item" href="/profile">Edit Profile</a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                      {{ __('Log Out') }}
                    </a>
                  </form>
                  @endauth
                  @guest
                  @if (Route::has('login'))
                  <a href="{{ route('login') }}" class="dropdown-item">Log in</a>
                  @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                  @endif
                  @endif
                  @endguest
                </div>
              </li>
            </ul>
          </div>

        </div>


      </nav>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Сповіщення</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        @php
        $unreadBookings = $bookings->filter(function($booking) {
        return $booking->user_id == auth()->id() && !$booking->read;
        });
        $unreadCount = $unreadBookings->count();
        @endphp

        @if ($unreadCount>0)
        @foreach ($unreadBookings as $booking)
        <article class="card">
          <div class="row card-body">
            <div class="">
              <h3 class="h4 mb-3">
                <a class="post-title" href="post-elements.html">{{ $booking->event->name }}</a>
              </h3>
              <ul class="card-meta list-inline">
                <li class="list-inline-item">
                  @php
                  $startDate = Carbon\Carbon::parse($booking->event->start);
                  $formattedStartDate = $startDate->locale('uk')->isoFormat('D MMMM YYYY [о] H:mm');
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
              </ul>
              <p>{{ $booking->notes }}</p>
              <a href="#!" class="btn btn-outline-primary mark-as-read" data-id="{{ $booking->id }}">
                Позначити прочитаним
              </a>
            </div>
          </div>
        </article>
        @endforeach
        @else
        <p>Немає непрочитаних записів</p>
        @endif



      </div>
    </div>
  </header>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.mark-as-read').on('click', function(e) {
        e.preventDefault();
        var button = $(this);
        var bookingId = button.data('id');
        var card = button.closest('.card');

        // Плавно зменшуємо висоту та зникаємо елемент
        card.css({
          'overflow': 'hidden',
          'height': card.outerHeight()
        }).animate({
          height: 0,
          opacity: 0
        }, 300, function() {
          $.ajax({
            url: '/booking/' + bookingId + '/read',
            type: 'PATCH',
            data: {
              _token: '{{ csrf_token() }}',
            },
            success: function(response) {
              if (response.success) {
                card.remove();
              } else {
                // Скасувати анімацію у разі помилки
                card.css({
                  'height': '',
                  'opacity': '',
                  'overflow': ''
                });
                alert('Failed to mark as read.');
              }
            },
            error: function(xhr) {
              // Скасувати анімацію у разі помилки
              card.css({
                'height': '',
                'opacity': '',
                'overflow': ''
              });
              console.log(xhr.responseText);
            }
          });
        });
      });
    });
  </script>







  <!-- /navigation -->