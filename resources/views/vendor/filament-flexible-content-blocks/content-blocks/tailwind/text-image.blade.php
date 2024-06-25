<div class="bg-{{ $getBackgroundColourClass() }} mb-3">
    <div class="container">
        <div class="row align-items-center">
            @if ($hasImage())
                @php
                    $imagePosition = $getImagePosition();
                @endphp
                @if ($imagePosition === 'left')
                    <div class="col-md-4 order-md-1">
                        {!! $getImageMedia(attributes: ['class' => 'img-fluid rounded', 'loading' => 'lazy']) !!}
                    </div>
                    <div class="col-md-8 order-md-2">
                        @if ($title)
                            <h3>{{ $replaceParameters($title) }}</h3>
                        @endif
                        @if ($text)
                            <div>
                                {!! $replaceParameters($text) !!}
                            </div>
                        @endif
                    </div>
                @elseif ($imagePosition === 'right')
                    <div class="col-md-4 order-md-2">
                        {!! $getImageMedia(attributes: ['class' => 'img-fluid rounded', 'loading' => 'lazy']) !!}
                    </div>
                    <div class="col-md-8 order-md-1">
                        @if ($title)
                            <h3>{{ $replaceParameters($title) }}</h3>
                        @endif
                        @if ($text)
                            <div>
                                {!! $replaceParameters($text) !!}
                            </div>
                        @endif
                    </div>
                @elseif ($imagePosition === 'center')
                    <div
                        class="col-12 text-center mb-3>
                        {!! $getImageMedia(attributes: ['class' => 'img-fluid rounded', 'loading' => 'lazy']) !!}
                    </div>
                    <div class="col-12">
                        @if ($title)
                            <h3>{{ $replaceParameters($title) }}</h3>
                        @endif
                        @if ($text)
                            <div>
                                {!! $replaceParameters($text) !!}
                            </div>
                        @endif
                    </div>
                @endif
            @else
                <div class="col-12">
                    @if ($title)
                        <h3>{{ $replaceParameters($title) }}</h3>
                    @endif
                    @if ($text)
                        <div>
                            {!! $replaceParameters($text) !!}
                        </div>
                    @endif
                </div>
            @endif
        </div>
        @if ($callToActions)
            <center>
                <div class="row mb-5">
                    @foreach ($callToActions as $callToAction)
                        <x-flexible-call-to-action :data="$callToAction"></x-flexible-call-to-action>
                    @endforeach
                </div>
            </center>
        @endif
    </div>
</div>
