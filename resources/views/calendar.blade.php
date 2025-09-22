@php
    // Cache method calls for performance
    $isMultiple = $isMultiple();
    $hasEvents = $hasEvents();
    $calendarConfig = $getCalendarConfig();

    // Build base attributes for VanillaCalendar integration
    $baseAttributes = [
        'x-data' => '',
        'x-init' => "const calendar = new VanillaCalendar(\$el, {$calendarConfig}); calendar.init();",
    ];
@endphp

<div wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
    {{ $attributes->class(['w-fit']) }}>
</div>
