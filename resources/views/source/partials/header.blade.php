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

<body>
  <!-- navigation -->
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
              <a class="nav-link" href="contact.html">Contact</a>
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
  </header>
  <!-- /navigation -->