@extends('layouts.main')
@section('content')


@if (session('status'))
<div class="alert alert-success mb-4" role="alert">
    {{ session('status') }}
</div>
@endif
{{ __("You're logged in!") }}


@endsection