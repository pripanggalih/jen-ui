@php
    // Cache method calls for performance
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
    $hasJoinItems = $hasJoinItems();
    $selectClasses = $getSelectClasses();
    $containerClasses = $getContainerClasses();
    $floatingLabelClasses = $getFloatingLabelClasses();

    // Generate final UUID with model name
    $finalUuid = $uuid . $modelName;

    // Check for errors in template where $errors is available
    $hasErrors = $errorFieldName && $errors->has($errorFieldName) && !$omitError;

    // Add error class if needed
    if ($hasErrors) {
        $selectClasses .= ' !select-error';
    }
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($label && !$inline)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($attributes->get('required'))
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label class="{{ $floatingLabelClasses }}">
            {{-- FLOATING LABEL --}}
            @if ($label && $inline)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div class="{{ $containerClasses }}">
                {{-- PREPEND --}}
                @if ($prepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label {{ $attributes->whereStartsWith('class')->class($selectClasses) }}>

                    {{-- PREFIX --}}
                    @if ($prefix)
                        <span class="label">{{ $prefix }}</span>
                    @endif

                    {{-- ICON LEFT --}}
                    @if ($icon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none -ml-1 h-4 w-4 opacity-40" />
                    @endif

                    {{-- SELECT --}}
                    <select id="{{ $finalUuid }}"
                        wire:key="{{ $finalUuid }}"
                        {{ $attributes->whereDoesntStartWith('class') }}>
                        @if ($placeholder)
                            <option value="{{ $placeholderValue }}">{{ $placeholder }}</option>
                        @endif

                        @foreach ($options as $option)
                            <option value="{{ data_get($option, $optionValue) }}"
                                @if (data_get($option, 'disabled')) disabled @endif>
                                {{ data_get($option, $optionLabel) }}
                            </option>
                        @endforeach
                    </select>

                    {{-- ICON RIGHT --}}
                    @if ($iconRight)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$iconRight"
                            class="pointer-events-none h-4 w-4 opacity-40" />
                    @endif

                    {{-- SUFFIX --}}
                    @if ($suffix)
                        <span class="label">{{ $suffix }}</span>
                    @endif
                </label>

                {{-- APPEND --}}
                @if ($append)
                    {{ $append }}
                @endif
            </div>
        </label>

        {{-- ERROR --}}
        @if ($hasErrors)
            @foreach ($errors->get($errorFieldName) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif

        {{-- HINT --}}
        @if ($hint)
            <div class="{{ $hintClass }}">{{ $hint }}</div>
        @endif
    </fieldset>
</div>
