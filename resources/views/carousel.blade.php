@php
    // Cache method calls for performance
    $hasArrows = $hasArrows();
    $hasIndicators = $hasIndicators();
    $isAutoplay = $isAutoplay();
    $containerClasses = $getContainerClasses();
    $slideContainerClasses = $getSlideContainerClasses();
    $carouselConfig = $getCarouselConfig();
@endphp

<div x-data="{
    slides: @js($carouselConfig['slides']),
    withoutIndicators: @json($carouselConfig['withoutIndicators']),
    autoplay: @json($carouselConfig['autoplay']),
    interval: @json($carouselConfig['interval']),
    currentSlideIndex: 1,
    touchStartX: null,
    touchEndX: null,
    swipeThreshold: 50,
    previous() {
        this.currentSlideIndex = (this.currentSlideIndex > 1) ?
            --this.currentSlideIndex :
            this.slides.length
    },
    next() {
        this.currentSlideIndex = (this.currentSlideIndex < this.slides.length) ?
            ++this.currentSlideIndex :
            1
    },
    handleTouchStart(event) {
        this.touchStartX = event.touches[0].clientX
    },
    handleTouchMove(event) {
        this.touchEndX = event.touches[0].clientX
    },
    handleTouchEnd() {
        if (this.touchEndX) {
            if (this.touchStartX - this.touchEndX > this.swipeThreshold) {
                this.next()
            }
            if (this.touchStartX - this.touchEndX < -this.swipeThreshold) {
                this.previous()
            }
            this.touchStartX = null
            this.touchEndX = null
        }
    },
    init() {
        if (this.autoplay)
            setInterval(() => { this.next(); }, this.interval);
    }
}"
    wire:key="{{ $uuid }}"
    {{ $attributes->class($containerClasses) }}>

    @if ($hasArrows)
        <!-- previous button -->
        <x-dynamic-component :component="$jenPrefix . '::button'"
            icon="o-chevron-left"
            @click="previous()"
            class="btn-circle btn-sm absolute left-5 top-1/2 z-[2] cursor-pointer" />

        <!-- next button -->
        <x-dynamic-component :component="$jenPrefix . '::button'"
            icon="o-chevron-right"
            @click="next()"
            class="btn-circle btn-sm absolute right-5 top-1/2 z-[2] cursor-pointer" />
    @endif

    <!-- slides -->
    <div @touchstart="handleTouchStart($event)"
        @touchmove="handleTouchMove($event)"
        @touchend="handleTouchEnd()"
        class="{{ $slideContainerClasses }}">
        <!-- Slides content -->
        @foreach ($slides as $index => $slide)
            @php
                $slideUrl = data_get($slide, 'url');
                $slideTitle = data_get($slide, 'title');
                $slideDescription = data_get($slide, 'description');
                $slideUrlText = data_get($slide, 'urlText');
                $slideImage = data_get($slide, 'image');
                $hasContent = $slideUrlText || $slideTitle || $slideDescription;
            @endphp

            <div x-cloak
                x-show="currentSlideIndex == {{ $index + 1 }}"
                x-transition.opacity.duration.500ms
                @class(['absolute inset-0', 'cursor-pointer' => $slideUrl])
                @if ($slideUrl) @click="window.location = '{{ $slideUrl }}'" @endif>
                <!-- Custom content -->
                @if ($content)
                    <div class="absolute inset-0 z-[1]">
                        {{ $content($slide) }}
                    </div>
                    <!-- Default content -->
                @else
                    <div @class([
                        'absolute inset-0 z-[1] flex flex-col items-center justify-end gap-2 px-20 py-12 text-center',
                        'bg-gradient-to-t from-slate-900/85' => $hasContent,
                    ])>
                        <!-- Title -->
                        @if ($slideTitle)
                            <h3 class="w-full text-2xl font-bold text-white lg:text-3xl">{{ $slideTitle }}</h3>
                        @endif

                        <!-- Description -->
                        @if ($slideDescription)
                            <div class="mb-5 w-full text-sm text-white">{{ $slideDescription }}</div>
                        @endif

                        <!-- Button -->
                        @if ($slideUrlText && $slideUrl)
                            <a href="{{ $slideUrl }}"
                                class="btn btn-sm btn-outline my-3 border-white text-white hover:scale-105 hover:bg-transparent">
                                {{ $slideUrlText }}
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Image -->
                @if ($slideImage)
                    <img class="inset-0 h-full w-full object-cover"
                        src="{{ $slideImage }}"
                        alt="{{ $slideTitle ?: 'Slide image' }}" />
                @endif
            </div>
        @endforeach
    </div>

    <!-- Indicators -->
    @if ($hasIndicators)
        <div class="bg-base-300 absolute bottom-3 left-1/2 z-[2] flex -translate-x-1/2 gap-4 rounded-xl px-1.5 py-1 md:bottom-5 md:gap-3 md:px-2"
            role="group"
            aria-label="slides">
            <template x-for="(slide, index) in slides">
                <button class="size-2.5 cursor-pointer rounded-full transition hover:scale-125"
                    @click="currentSlideIndex = index + 1"
                    :class="[currentSlideIndex === index + 1 ? 'bg-base-content' : 'bg-base-content/30']"
                    :aria-label="`Go to slide ${index + 1}`">
                </button>
            </template>
        </div>
    @endif
</div>
