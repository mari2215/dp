@extends('layouts.main')
@section('content')
    <div class="container div">
        <x-flexible-hero :page="$page" />

        <x-flexible-content-blocks :page="$page" />
    </div>
@endsection
