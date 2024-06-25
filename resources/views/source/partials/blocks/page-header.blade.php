<style>
    @media (min-width: 992px) {
        .header {
            padding-top: 120px;
        }
    }

    @media (max-width: 992px) {
        .header {
            padding-top: 80px;
        }
    }
</style>
@if (isset($title))
    <div class="header text-center">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <h1 class="mb-4">{{ $title }}</h1>
                @if (isset($page))
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-default" href="/">Домашня сторінка
                                &nbsp; &nbsp; /</a></li>
                        <li class="list-inline-item text-primary">{{ $page }}</li>
                    </ul>
                @endif

                @if (isset($subtitle))
                    <h4>{{ $subtitle }}</h4>
                @endif
            </div>
        </div>
    </div>
@endif
