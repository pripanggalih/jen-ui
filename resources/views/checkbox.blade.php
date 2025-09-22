@php
    // Cache method calls in template for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $isRequired = $isRequired();
    $isRightAligned = $isRightAligned();
    $labelClasses = $getLabelClasses();
    $checkboxClasses = $getCheckboxClasses();
    $labelContentClasses = $getLabelContentClasses();
    $errorFieldName = $errorFieldName();

    // Build attributes array for Laravel's native merge
$checkboxAttributes = [];
$checkboxAttributes['id'] = $uuid;
$checkboxAttributes['type'] = 'checkbox';
@endphp

<div wire:key="{{ $uuid }}">
    <fieldset class="fieldset">
        <div class="w-full">
            <label class="{{ $labelClasses }}">
                {{-- CHECKBOX --}}
                <input {{ $attributes->whereDoesntStartWith(['id', 'class'])->merge($checkboxAttributes) }}
                    {{ $attributes->class($checkboxClasses) }} />

                {{-- LABEL --}}
                @if ($hasLabel || $hasHint)
                    <div class="{{ $labelContentClasses }}">
                        @if ($hasLabel)
                            <div class="text-sm font-medium">
                                {{ $label }}

                                @if ($isRequired)
                                    <span class="text-error">*</span>
                                @endif
                            </div>
                        @endif

                        {{-- HINT --}}
                        @if ($hasHint)
                            <div class="{{ $hintClass }}">{{ $hint }}</div>
                        @endif
                    </div>
                @endif
            </label>
        </div>

        {{-- ERROR --}}
        @if (!$omitError && $errorFieldName && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif
    </fieldset>
</div>
