@php
    /* @var \Statikbe\FilamentFlexibleContentBlocks\Filament\Form\Fields\Blocks\Data\CardData $card */
@endphp

<div
    class="widget-card relative transition duration-300 ease-out bg-white group @if ($isFullyClickable()) hover:shadow-md @endif">
    @if (!$slot->isEmpty())
        {{-- Image slot --}}
        {{ $slot }}
    @elseif($card->hasImage())
        @if ($card->imageHtml)
            {!! $card->imageHtml !!}
        @elseif($card->imageUrl)
            <img src="{{ $card->imageUrl }}" class="card-img-top" alt="{{ $card->title }}">
        @endif
    @endif

    <div class="widget-card card-body p-4 sm:p-6">
        @if ($card->title)
            <h3 class="card-title">
                @if ($getTitleUrl())
                    <a href="{{ $getTitleUrl() }}">
                @endif
                {{ $card->title }}
                @if ($getTitleUrl())
                    </a>
                @endif
            </h3>
        @endif

        @if ($card->text)
            <div class="card-text">{!! Statikbe\FilamentFlexibleContentBlocks\FilamentFlexibleContentBlocks::replaceParameters($card->text) !!}</div>
        @endif

        @if ($card->callToActions)
            <div class="card-call-to-actions flex flex-wrap gap-4 mt-4">
                @foreach ($card->callToActions as $callToAction)
                    <x-flexible-call-to-action :data="$callToAction" :isFullyClickable="$isFullyClickable()"></x-flexible-call-to-action>
                @endforeach
            </div>
        @endif
    </div>
</div>
