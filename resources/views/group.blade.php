@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $isRequired = $isRequired();
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
    $fieldsetClasses = $getFieldsetClasses();
    $legendClasses = $getLegendClasses();
    $joinClasses = $getJoinClasses();
@endphp

<div wire:key="{{ $uuid }}">
    <fieldset class="{{ $fieldsetClasses }}">
        {{-- STANDARD LABEL --}}
        @if ($hasLabel)
            <legend class="{{ $legendClasses }}">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <div class="{{ $joinClasses }}">
            @foreach ($options as $option)
                @php
                    $optionAttributes = $getOptionAttributes($option);
                    $radioClasses = $getRadioClasses($option);
                @endphp

                <input {{ $attributes->whereStartsWith('wire:model') }}
                    {{ $attributes->class($radioClasses)->merge($optionAttributes) }} />
            @endforeach
        </div>

        {{-- ERROR --}}
        @if (!$omitError && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif

        {{-- HINT --}}
        @if ($hasHint)
            <div class="{{ $hintClass }}">{{ $hint }}</div>
        @endif
    </fieldset>
</div>
