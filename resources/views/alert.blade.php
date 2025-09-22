@php
    // Cache method calls in template for performance
    $hasIcon = $hasIcon();
    $hasTitle = $hasTitle();
    $hasDescription = $hasDescription();
    $isDismissible = $isDismissible();
    $alertClasses = $getAlertClasses();
    $titleClasses = $getTitleClasses();
@endphp

<div wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith('class') }}
    {{ $attributes->class($alertClasses) }}
    x-data="{ show: true }"
    x-show="show">

    {{-- ICON --}}
    @if ($hasIcon)
        <x-dynamic-component :component="$jenPrefix . '::icon'"
            :name="$icon"
            class="self-center" />
    @endif

    {{-- TITLE & DESCRIPTION or SLOT --}}
    @if ($hasTitle)
        <div>
            <div class="{{ $titleClasses }}">{{ $title }}</div>
            @if ($hasDescription)
                <div class="text-xs">{{ $description }}</div>
            @endif
        </div>
    @else
        <span>{{ $slot }}</span>
    @endif

    {{-- ACTIONS SLOT --}}
    <div class="flex items-center gap-3">
        {{ $actions }}
    </div>

    {{-- DISMISSIBLE BUTTON --}}
    @if ($isDismissible)
        <x-dynamic-component :component="$jenPrefix . '::button'"
            icon="o-x-mark"
            @click="show = false"
            class="btn-xs btn-circle btn-ghost static end-0 self-start" />
    @endif
</div>
