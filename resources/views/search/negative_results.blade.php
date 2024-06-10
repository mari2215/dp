@extends('layouts.main')

@section('content')
<div class="py-3"></div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 mb-4">
                <h2 class="h2 mb-4">Результати пошуку
                    <mark>{{ $query }}</mark>
                </h2>
            </div>
            <div class="col-lg-10 text-center">
                <img class="mb-5 img-fluid" src="theme/theme/images/no-search-found.svg" alt="">
                <h3>Результатів не знайдено</h3>
            </div>
        </div>
    </div>
</section>

@endsection