@php
    // Cache method calls for performance
    $accordionClasses = $getAccordionClasses();

    // Build base attributes for Laravel native merge
    $baseAttributes = [
        'x-data' => '{ model: @entangle($attributes->wire(\'model\')) }',
        'wire:key' => $uuid,
    ];
@endphp

<div {{ $attributes->whereDoesntStartWith('wire:model')->class($accordionClasses)->merge($baseAttributes) }}>
    {{ $slot }}
</div>
