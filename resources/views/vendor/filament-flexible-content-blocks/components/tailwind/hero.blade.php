<div @class([
    'hero' => $hasHeroImage(),
    'section' => !$hasHeroImage(),
    'relative sm:py-20 before:bg-black/25 before:z-10 before:absolute before:inset-0' => $hasHeroImage(),
])>
    <div class="container my-4 mb-5">
        <div class="row justify-content-between relative z-10">
            @if ($title || $intro)
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        @if ($title)
                            <h1 @if ($hasHeroImage()) class="text-black" @endif>
                                {{ Statikbe\FilamentFlexibleContentBlocks\FilamentFlexibleContentBlocks::replaceParameters($title) }}
                            </h1>
                        @endif

                        @if ($intro)
                            <p class="mb-4 text-lg md:text-xl @if ($hasHeroImage()) text-black @endif">
                                {!! Statikbe\FilamentFlexibleContentBlocks\FilamentFlexibleContentBlocks::replaceParameters($intro) !!}
                            </p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($hasHeroImage())
                <div class="col-lg-7">
                    <div class="hero-img-wrap image-wrapper">
                        {{ $getHeroImageMedia(null, [
                            'class' => 'img-fluid w-full h-full object-cover object-center',
                            'loading' => 'lazy',
                        ]) }}
                        @if ($heroImageCopyright)
                            <small class="absolute bottom-0 right-0 px-2 py-1 text-black bg-black/30 z-10">&copy;
                                {{ Statikbe\FilamentFlexibleContentBlocks\FilamentFlexibleContentBlocks::replaceParameters($heroImageCopyright) }}</small>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
