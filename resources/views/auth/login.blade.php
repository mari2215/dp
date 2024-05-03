@extends('layouts.main')
@section('content')

@if (session('status'))
<div class="alert alert-success mb-4" role="alert">
    {{ session('status') }}
</div>
@endif


<div class="container col-lg-8 my-3">



    <div class="row">
        <div class="col-lg-8 mx-auto">

            <div class="content mb-5">
                <center>
                    <h2 id="we-would-love-to-hear-from-you">Login&hellip;.</h2>
                </center>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Your Email Address (Required)</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3 full-width d-flex justify-content-between">
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>
                </div>

                <center><button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                    <br><br>
                    <a href="{{ route('google.redirect') }}" class="">Login with Google</a>
                </center>

            </form>
        </div>
    </div>

</div>
@endsection