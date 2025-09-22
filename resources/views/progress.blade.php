@php
    // Cache method calls in template for performance
    $isIndeterminate = $isIndeterminate();
    $progressClasses = $getProgressClasses();
    $progressAttributes = $getProgressAttributes();
@endphp

<progress wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith('class')->merge($progressAttributes) }}
    {{ $attributes->class($progressClasses) }}>
</progress>
