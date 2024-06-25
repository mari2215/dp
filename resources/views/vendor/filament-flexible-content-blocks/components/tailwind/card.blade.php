@php
    /* @var \Statikbe\FilamentFlexibleContentBlocks\Filament\Form\Fields\Blocks\Data\CardData $card */
@endphp

<div class="col-md-4 col-sm-6">
    <article class="card mb-4" style="min-height: 300px;">
        @if (!$slot->isEmpty())
            <div class="post-slider slider-sm">
                {{ $slot }}
            </div>
        @elseif($card->hasImage())
            <div class="post-slider">
                @if ($card->imageHtml)
                    {!! $card->imageHtml !!}
                @elseif($card->imageUrl)
                    <img src="{{ $card->imageUrl }}" class="card-img-top col-md-12" alt="{{ $card->title }}">
                @endif
            </div>
        @endif

        <div class="card-body">
            @if ($card->title)
                <h3 class="h4 mb-3">
                    @if ($getTitleUrl())
                        <a class="post-title" href="{{ $getTitleUrl() }}">
                    @endif
                    {{ $card->title }}
                    @if ($getTitleUrl())
                        </a>
                    @endif
                </h3>
            @endif

            @if ($card->text)
                <p class="card-text">{!! Statikbe\FilamentFlexibleContentBlocks\FilamentFlexibleContentBlocks::replaceParameters($card->text) !!}</p>
            @endif

            @if ($card->callToActions)
                <div class="card-call-to-actions flex flex-wrap gap-4 mt-4">
                    @foreach ($card->callToActions as $callToAction)
                        <x-flexible-call-to-action :data="$callToAction" :isFullyClickable="$isFullyClickable()"></x-flexible-call-to-action>
                    @endforeach
                </div>
            @endif
        </div>
    </article>
</div>
