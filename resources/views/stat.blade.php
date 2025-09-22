@php
    // Cache method calls for performance
    $hasIcon = $hasIcon();
    $hasTooltip = $hasTooltip();
    $tooltip = $getTooltip();
    $containerClasses = $getContainerClasses();
    $iconClasses = $getIconClasses();

    // Build attributes array for Laravel's native merge
$baseAttributes = [];

if ($hasTooltip) {
    $baseAttributes['data-tip'] = $tooltip;
    }
@endphp

<div wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
    {{ $attributes->class($containerClasses) }}>

    <div class="flex items-center gap-3">
        {{-- Icon with dynamic prefix support --}}
        @if ($hasIcon)
            <div class="{{ $iconClasses }}">
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$icon"
                    class="h-9 w-9" />
            </div>
        @endif

        <div class="truncate text-left rtl:text-right">
            {{-- Title --}}
            @if ($title)
                <div class="text-base-content/50 whitespace-nowrap text-xs">{{ $title }}</div>
            @endif

            {{-- Value or slot content --}}
            <div class="text-xl font-black">{{ $value ?? $slot }}</div>

            {{-- Description --}}
            @if ($description)
                <div class="stat-desc">{{ $description }}</div>
            @endif
        </div>
    </div>
</div>
