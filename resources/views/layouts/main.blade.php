<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('source.partials.header')
<style>
    @media (min-width: 992px) {
        .main {
            padding-top: 120px;
        }
    }

    @media (max-width: 992px) {
        .main {
            padding-top: 80px;
        }
    }
</style>

<body>
    <div class="main" style="min-height: 90vh; ">
        @yield('content')
    </div>
</body>

@include('source.partials.footer')

</html>