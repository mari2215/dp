@extends('layouts.main')
@section('content')
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
</style>

<div class="container my-3 mb-5">
    <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6 col-sm-6">
            <center><img src="{{ asset('theme/theme/images/logos/Charm.png')}}" class="img-fluid" style="max-width: 80%; height: auto;" alt="Phone image">
                <center>
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 col-sm-6">
            <h2>Зареєструватись</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Email input -->
                <div data-mdb-input-init class="form-group">
                    <input id="name" class="block mt-1 w-full form-control @error('name') is-invalid @enderror" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ім'я" />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div data-mdb-input-init class="form-group">
                    <input type="email" id="form1Example13" name="email" class="block mt-1 w-full form-control @error('email') is-invalid @enderror" placeholder="Пошта" />

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-group">
                    <input type="password" id="form1Example23" name="password" class="block mt-1 w-full form-control @error('password') is-invalid @enderror" placeholder="Пароль" />
                    <input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Повторіть пароль" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <!-- Submit button -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Зареєструватись</button>

                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">АБО</p>
                </div>

                <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="{{ route('google.redirect') }}" role="button">
                    <i class="ti-google"></i> Продовжити через Google</a>
            </form>


        </div>
    </div>

</div>


@endsection