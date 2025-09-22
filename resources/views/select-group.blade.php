@php
    // Cache method calls for performance
    $hasStandardLabel = $hasStandardLabel();
    $hasFloatingLabel = $hasFloatingLabel();
    $hasJoinElements = $hasJoinElements();
    $hasError = $hasError();
    $isRequired = $isRequired();
    $isReadonly = $isReadonly();
    $selectWrapperClasses = $getSelectWrapperClasses();
    $errorFieldName = $errorFieldName();
    $modelName = $modelName();

    // Generate unique ID for this instance
    $selectId = $uuid . $modelName;

    // Build base attributes for wrapper div
    $wrapperAttributes = [];
    if ($hasJoinElements) {
        $wrapperAttributes['class'] = 'w-full';
    } else {
        $wrapperAttributes['class'] = 'w-full';
    }

    // Build select attributes
    $selectAttributes = [];
    if ($errorFieldName && $hasError) {
        $selectAttributes['aria-invalid'] = 'true';
        $selectAttributes['aria-describedby'] = $selectId . '-error';
    }
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($hasStandardLabel)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}
                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label @class(['floating-label' => $hasFloatingLabel])>
            {{-- FLOATING LABEL --}}
            @if ($hasFloatingLabel)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div
                {{ $attributes->whereDoesntStartWith(['class', 'wire:model', 'id', 'name', 'required', 'readonly', 'disabled'])->merge($wrapperAttributes)->class(['join' => $hasJoinElements]) }}>

                {{-- PREPEND --}}
                @if ($prepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label wire:key="{{ $uuid }}" class="{{ $selectWrapperClasses }}">
                    {{-- ICON LEFT --}}
                    @if ($icon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none -ml-1 h-4 w-4 opacity-40" />
                    @endif

                    {{-- SELECT --}}
                    <select id="{{ $selectId }}"
                        {{ $attributes->whereStartsWith(['wire:model', 'name', 'required', 'readonly', 'disabled'])->merge($selectAttributes) }}>

                        @if ($placeholder)
                            <option value="{{ $placeholderValue }}">{{ $placeholder }}</option>
                        @endif

                        @foreach (array_keys($options) as $groupLabel)
                            <optgroup label="{{ $groupLabel }}">
                                @foreach ($options[$groupLabel] as $option)
                                    <option value="{{ $option[$optionValue] }}">
                                        {{ $option[$optionLabel] }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                    {{-- ICON RIGHT --}}
                    @if ($iconRight)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$iconRight"
                            class="pointer-events-none h-4 w-4 opacity-40" />
                    @endif
                </label>

                {{-- APPEND --}}
                @if ($append)
                    {{ $append }}
                @endif
            </div>
        </label>

        {{-- HINT --}}
        @if ($hint)
            <div class="{{ $hintClass }}">{{ $hint }}</div>
        @endif

        {{-- ERROR --}}
        @if (!$omitError && $errorFieldName && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div id="{{ $selectId }}-error" class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif
    </fieldset>
</div>
