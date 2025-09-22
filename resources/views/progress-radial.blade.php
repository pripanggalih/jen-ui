@php
    // Cache method calls for performance
    $cssValue = $getCssValue();
    $displayText = $getDisplayText();
    $baseClasses = $getBaseClasses();
@endphp

<div wire:key="{{ $uuid }}"
    {{ $attributes->class($baseClasses)->style($cssValue) }}
    role="progressbar">
    {{ $displayText }}
</div>
