@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $iconClasses = $getIconClasses();
    $labelClasses = $labelClasses();
    $iconName = $icon();

    // Build base attributes for the icon
    $iconAttributes = [];
@endphp

@if ($hasLabel)
    <div wire:key="{{ $uuid }}" class="inline-flex items-center gap-1">
@endif

<x-svg :name="$iconName"
    {{ $attributes->whereDoesntStartWith(['@', 'class'])->merge($iconAttributes) }}
    {{ $attributes->class($iconClasses) }} />

@if ($hasLabel)
    <div class="{{ $labelClasses }}" {{ $attributes->whereStartsWith('@') }}>
        {{ $label }}
    </div>
    </div>
@endif
