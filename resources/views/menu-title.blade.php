@php
    // Cache method calls in template for performance
    $hasIcon = $hasIcon();
    $mainClasses = $getMainClasses();
    $containerClasses = $getContainerClasses();

    // Build attributes array for Laravel's native merge
    $baseAttributes = [];
@endphp

<li wire:key="{{ $uuid }}" {{ $attributes->class($mainClasses)->merge($baseAttributes) }}>
    <div class="{{ $containerClasses }}">
        {{-- Icon with dynamic prefix --}}
        @if ($hasIcon)
            <x-dynamic-component :component="$jenPrefix . '::icon'"
                :name="$icon"
                :class="$iconClasses" />
        @endif

        {{-- Title --}}
        {{ $title }}
    </div>
</li>
