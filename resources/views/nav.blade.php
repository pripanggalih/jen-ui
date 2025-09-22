@php
    // Cache method calls in template for performance
    $isSticky = $isSticky();
    $isFullWidth = $isFullWidth();
    $navClasses = $getNavClasses();
    $containerClasses = $getContainerClasses();
@endphp

<div wire:key="{{ $uuid }}" {{ $attributes->class($navClasses) }}>
    <div class="{{ $containerClasses }}">
        <div {{ $brand?->attributes->class(['flex-1 flex items-center']) }}>
            {{ $brand }}
        </div>
        <div {{ $actions?->attributes->class(['flex items-center gap-4']) }}>
            {{ $actions }}
        </div>
    </div>
</div>
