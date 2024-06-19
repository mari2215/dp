@if ($content)
    <div class=" {{ $getBackgroundColourClass() }} mb-3">
        <div class="container">
            <div class="w-full md:w-3/4">
                @if ($title)
                    <h3>{{ $replaceParameters($title) }}</h3>
                @endif
                {!! $replaceParameters($content) !!}
            </div>
        </div>
    </div>
@endif
