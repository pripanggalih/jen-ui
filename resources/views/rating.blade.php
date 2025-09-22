@php
    // Cache method calls in template for performance
    $modelName = $modelName();
    $ratingClasses = $getRatingClasses();
    $inputClasses = $getInputClasses();

    // Build base attributes array for Laravel's native merge
    $baseAttributes = [];
@endphp

<div wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith(['class', 'wire:model'])->merge($baseAttributes) }}
    {{ $attributes->class($ratingClasses) }}
    x-cloak>

    {{-- NO RATING --}}
    <input type="radio"
        name="{{ $modelName }}"
        value="0"
        class="rating-hidden hidden"
        {{ $attributes->whereStartsWith('wire:model') }} />

    {{-- RATING INPUTS --}}
    @for ($i = 1; $i <= $total; $i++)
        <input type="radio"
            name="{{ $modelName }}"
            value="{{ $i }}"
            {{ $attributes->whereStartsWith('wire:model') }}
            {{ $attributes->class([$inputClasses]) }} />
    @endfor
</div>
