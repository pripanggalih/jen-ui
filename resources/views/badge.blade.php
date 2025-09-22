@php
    // Cache method calls for performance
    $hasValue = $hasValue();
    $badgeClasses = $getBadgeClasses();
@endphp

<div wire:key="{{ $uuid }}" {{ $attributes->class($badgeClasses) }}>
    @if ($hasValue)
        {{ $value }}
    @else
        {{ $slot }}
    @endif
</div>
