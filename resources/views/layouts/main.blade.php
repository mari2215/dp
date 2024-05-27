<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('source.partials.header')

<body>
    <div class="main" style="min-height: 90vh; ">

        @yield('content')
    </div>
</body>

@include('source.partials.footer')

</html>