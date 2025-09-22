@php
    // Cache method calls in template for performance
    $hasImages = $hasImages();
    $galleryClasses = $getGalleryClasses();
    $carouselItemClasses = $getCarouselItemClasses();
    $imageClasses = $getImageClasses();

    // Build attributes array for Laravel's native merge
$baseAttributes = [
    'x-data' => "{
            init() {
                const lightbox = new PhotoSwipeLightbox({
                    gallery: '#{$uuid}',
                    children: 'a',
                    showHideAnimationType: 'fade',
                        pswpModule: PhotoSwipe
                    });

                    lightbox.init();
                }
            }",
    ];
@endphp

@if ($hasImages)
    <div {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}>
        <div id="{{ $uuid }}"
            wire:key="{{ $uuid }}"
            {{ $attributes->only('class')->class($galleryClasses) }}>

            @foreach ($images as $image)
                <a class="{{ $carouselItemClasses }}"
                    href="{{ $image }}"
                    target="_blank"
                    data-pswp-width="200"
                    data-pswp-height="200">
                    <img src="{{ $image }}"
                        class="{{ $imageClasses }}"
                        onload="this.parentNode.setAttribute('data-pswp-width', this.naturalWidth); this.parentNode.setAttribute('data-pswp-height', this.naturalHeight)"
                        alt="Gallery Image" />
                </a>
            @endforeach
        </div>
    </div>
@else
    <div {{ $attributes->class('text-center text-gray-500 p-8') }}>
        <p>No images to display</p>
    </div>
@endif
