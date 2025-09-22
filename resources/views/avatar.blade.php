@php
    // Cache method calls in template for performance
    $hasImage = $hasImage();
    $hasTextContent = $hasTextContent();
    $avatarClasses = $getAvatarClasses();
    $imageClasses = $getImageClasses();
    $titleClasses = $getTitleClasses();
    $subtitleClasses = $getSubtitleClasses();
@endphp

<div wire:key="{{ $uuid }}" class="flex items-center gap-3">
    <div class="{{ $avatarClasses }}">
        <div {{ $attributes->class($imageClasses) }}>
            @if (!$hasImage)
                <span class="text-xs" alt="{{ $alt }}">{{ $placeholder }}</span>
            @else
                <img src="{{ $image }}"
                    alt="{{ $alt }}"
                    @if ($fallbackImage) onerror="this.src='{{ $fallbackImage }}'" @endif />
            @endif
        </div>
    </div>

    @if ($hasTextContent)
        <div>
            @if ($title)
                <div class="{{ $titleClasses }}">
                    {{ $title }}
                </div>
            @endif

            @if ($subtitle)
                <div class="{{ $subtitleClasses }}">
                    {{ $subtitle }}
                </div>
            @endif
        </div>
    @endif
</div>
