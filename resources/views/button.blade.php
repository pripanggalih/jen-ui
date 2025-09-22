@php
    $isLinkElement = $isLink();
    $buttonClasses = $getButtonClasses();
    $tooltip = $getTooltip();
    $spinnerTargetValue = $hasSpinner() ? $spinnerTarget() : null;

    $baseAttributes = [];

    if ($tooltip) {
        $baseAttributes['data-tip'] = $tooltip;
    }

    if ($hasSpinner()) {
        $baseAttributes['wire:target'] = $spinnerTargetValue;
        $baseAttributes['wire:loading.attr'] = 'disabled';
    }

    if ($isLinkElement) {
        $baseAttributes = array_merge($baseAttributes, $getLinkAttributes());
    }
@endphp

@if ($isLinkElement)
    <a href="{!! $link !!}"
        wire:key="{{ $uuid }}"
        {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
        {{ $attributes->class($buttonClasses) }}>
    @else
        <button wire:key="{{ $uuid }}"
            {{ $attributes->whereDoesntStartWith('class')->merge(array_merge(['type' => 'button'], $baseAttributes)) }}
            {{ $attributes->class($buttonClasses) }}>
@endif

{{-- SPINNER LEFT --}}
@if ($shouldShowLeftSpinner())
    <span wire:loading
        wire:target="{{ $spinnerTargetValue }}"
        class="loading loading-spinner h-5 w-5"></span>
@endif

{{-- ICON --}}
@if ($icon)
    <span class="block"
        wire:loading.class="hidden"
        @if ($hasSpinner()) wire:target="{{ $spinnerTargetValue }}" @endif>
        <x-dynamic-component :component="$jenPrefix . '::icon'" :name="$icon" />
    </span>
@endif

{{-- LABEL / SLOT --}}
@if ($label)
    <span class="{{ $getLabelClasses() }}">{{ $label }}</span>
    @if ($hasBadge())
        <span class="badge badge-sm {{ $badgeClasses }}">{{ $badge }}</span>
    @endif
@else
    {{ $slot }}
@endif

{{-- ICON RIGHT --}}
@if ($iconRight)
    <span class="block"
        wire:loading.class="hidden"
        @if ($hasSpinner()) wire:target="{{ $spinnerTargetValue }}" @endif>
        <x-dynamic-component :component="$jenPrefix . '::icon'" :name="$iconRight" />
    </span>
@endif

{{-- SPINNER RIGHT --}}
@if ($shouldShowRightSpinner())
    <span wire:loading
        wire:target="{{ $spinnerTargetValue }}"
        class="loading loading-spinner h-5 w-5"></span>
@endif

@if ($isLinkElement)
    </a>
@else
    </button>
@endif
