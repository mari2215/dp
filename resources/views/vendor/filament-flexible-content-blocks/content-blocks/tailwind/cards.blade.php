<div class="{{ $getBackgroundColourClass() }}">
    <div class="container">
        @if ($title)
            <h2>{{ $replaceParameters($title) }}</h2>
        @endif
        <div class="row">
            @foreach ($cards as $card)
                <x-flexible-card :data="$card">
                    {!! $getCardImageMedia($card->imageId, $card->title, false, ['class' => '']) !!}
                </x-flexible-card>
            @endforeach
        </div>
    </div>
</div>
