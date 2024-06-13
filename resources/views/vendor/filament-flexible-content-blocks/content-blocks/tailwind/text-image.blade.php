<div class="bg-{{ $getBackgroundColourClass() }}">
    <div class="container">
        <div class="row">
            @if ($hasImage())
                <div class="col-md-6 mb-md-0 order-md-2">
                    {{ $getImageMedia(attributes: ['class' => 'img-fluid', 'loading' => 'lazy']) }}
                </div>
            @endif

            <div class="col-md-{{ $hasImage() ? '6' : '12' }}">
                @if ($title)
                    <h2>{{ $replaceParameters($title) }}</h2>
                @endif
                @if ($text)
                    <div>
                        {!! $replaceParameters($text) !!}
                    </div>
                @endif
            </div>
        </div>
        @if ($callToActions)
            <center>
                <div class="row mb-5">
                    @foreach ($callToActions as $callToAction)
                        <x-flexible-call-to-action :data="$callToAction"></x-flexible-call-to-action>
                    @endforeach
                </div>
                <center>
        @endif
    </div>
</div>
