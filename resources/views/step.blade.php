@php
    // Cache method calls for performance
    $hasIcon = $hasIcon();
    $hasDataContent = $hasDataContent();
    $stepData = $getStepData();

    // Build x-init directive for Alpine.js
    $xInitValue = 'steps.push(' . html_entity_decode(json_encode($stepData, JSON_UNESCAPED_UNICODE)) . ')';
@endphp

{{-- Initialize step data for Alpine.js --}}
<div class="hidden" x-init="{{ $xInitValue }}"></div>

{{-- Step content container --}}
<div wire:key="{{ $uuid }}"
    x-show="current == '{{ $step }}'"
    {{ $attributes->whereDoesntStartWith('class')->merge([]) }}
    {{ $attributes->class('px-1') }}>
    {{ $slot }}
</div>
