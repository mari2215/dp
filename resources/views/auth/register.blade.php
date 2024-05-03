@extends('layouts.main')
@section('content')
<div class="container col-lg-8 my-3">

    <div class="row">
        <div class="col-lg-8 mx-auto">

            <center> <a href="{{ route('google.redirect') }}" class="btn btn-primary my-3">Register with Google</a></center>

            <div class="content mb-5">
                <center>
                    <br>
                    <h2 id="we-would-love-to-hear-from-you">OR <br></h2>
                </center>
            </div>


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <center>
                    <h4>Register</h4>
                </center>
                <div class="form-group">
                    <input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                    @if ($errors->has('name'))
                    <div class="alert alert-danger mt-2" role="alert">
                        @foreach ($errors->get('name') as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                    @if ($errors->has('email'))
                    <div class="alert alert-danger mt-2" role="alert">
                        @foreach ($errors->get('email') as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" placeholder="password" />

                    <error :messages="$errors->get('password')" class="invalid-feedback" role="alert" />

                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="new password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback" role="alert" />

                </div>

                <center><button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    <br><br>

                </center>

            </form>
        </div>
    </div>
</div>

@endsection