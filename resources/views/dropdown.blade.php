@php
    // Cache method calls for performance
    $hasCustomTrigger = $hasCustomTrigger();
    $dropdownClasses = $getDropdownClasses();
    $menuClasses = $getMenuClasses();
    $xAnchorPosition = $getXAnchorPosition();
@endphp

<details x-data="{ open: false }"
    @click.outside="open = false"
    :open="open"
    class="{{ $dropdownClasses }}">
    @if ($hasCustomTrigger)
        {{-- CUSTOM TRIGGER --}}
        <summary x-ref="button"
            @click.prevent="open = !open"
            {{ $trigger->attributes->class(['list-none']) }}>
            {{ $trigger }}
        </summary>
    @else
        {{-- DEFAULT TRIGGER --}}
        <summary x-ref="button"
            @click.prevent="open = !open"
            {{ $attributes->class(['btn']) }}>
            {{ $label }}
            <x-dynamic-component :component="$jenPrefix . '::icon'" :name="$icon" />
        </summary>
    @endif

    <ul class="{{ $menuClasses }}"
        @click="open = false"
        @if (!$noXAnchor) x-anchor.{{ $xAnchorPosition }}="$refs.button" @endif>
        <div wire:key="{{ $uuid }}">
            {{ $slot }}
        </div>
    </ul>
</details>
