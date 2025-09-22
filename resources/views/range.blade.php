@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $isRequired = $isRequired();
    $rangeClasses = $getRangeClasses();
    $rangeAttributes = $getRangeAttributes();
    $errorFieldName = $errorFieldName();
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($hasLabel)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        {{-- RANGE INPUT --}}
        <input wire:key="{{ $uuid }}"
            {{ $attributes->whereDoesntStartWith(['class', 'label', 'hint', 'min', 'max'])->merge($rangeAttributes) }}
            {{ $attributes->class($rangeClasses) }} />

        {{-- ERROR HANDLING --}}
        @if (!$omitError && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif

        {{-- HINT TEXT --}}
        @if ($hasHint)
            <div class="{{ $hintClass }}">{{ $hint }}</div>
        @endif
    </fieldset>
</div>
