<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('source.partials.header')

<body>
    <div class="div" style="min-height: 90vh; padding-top: 120px;">
        @yield('content')
    </div>
</body>

@include('source.partials.footer')

</html>