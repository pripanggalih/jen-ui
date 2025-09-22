@php
    // Cache method calls in template for performance
    $hasProgressTarget = $hasProgressTarget();
    $containerClasses = $getContainerClasses();
    $progressClasses = $getProgressClasses();
    $progressAttributes = $getProgressAttributes();
@endphp

<div wire:key="{{ $uuid }}" {{ $attributes->class($containerClasses) }}>

    <progress class="{{ $progressClasses }}"
        {{ $attributes->whereStartsWith(['wire:loading', 'wire:target'])->merge($progressAttributes) }}>
    </progress>

</div>
