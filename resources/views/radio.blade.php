@php
    // Cache method calls in template for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $isRequired = $isRequired();
    $containerClasses = $getContainerClasses();
    $fieldsetAttributes = $getFieldsetAttributes();
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
@endphp

<div wire:key="{{ $uuid }}">
    <fieldset {{ $attributes->whereDoesntStartWith('wire:model')->merge($fieldsetAttributes) }}>
        {{-- STANDARD LABEL --}}
        @if ($hasLabel)
            <legend class="fieldset-legend mb-2">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <div class="{{ $containerClasses }}">
            @foreach ($options as $option)
                @php
                    $optionValue = $getOptionValue($option);
                    $optionLabel = $getOptionLabel($option);
                    $optionHint = $getOptionHint($option);
                    $isDisabled = $isOptionDisabled($option);

                    // Build radio input attributes
                    $radioAttributes = [
                        'type' => 'radio',
                        'name' => $modelName,
                        'value' => $optionValue,
                    ];

                    if ($isDisabled) {
                        $radioAttributes['disabled'] = true;
                    }
                @endphp

                <label>
                    <div @class([
                        'flex items-center gap-3 cursor-pointer',
                        '!items-start' => $optionHint,
                    ])>
                        <input
                            {{ $attributes->only(['wire:model', 'wire:model.lazy', 'wire:model.defer', 'wire:model.live'])->merge($radioAttributes) }}
                            {{ $attributes->class(['radio']) }} />

                        <div>
                            {{-- NAME --}}
                            <div class="text-sm font-medium">
                                {{ $optionLabel }}
                            </div>

                            {{-- HINT --}}
                            @if ($optionHint)
                                <div class="{{ $hintClass }} mt-1">
                                    {{ $optionHint }}
                                </div>
                            @endif
                        </div>
                    </div>
                </label>
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
