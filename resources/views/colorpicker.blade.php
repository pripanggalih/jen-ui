@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasIcon = $hasIcon();
    $hasIconRight = $hasIconRight();
    $hasPrefix = $hasPrefix();
    $hasSuffix = $hasSuffix();
    $hasHint = $hasHint();
    $isReadonly = $isReadonly();
    $isDisabled = $isDisabled();
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
    $inputClasses = $getInputClasses();
    $colorPickerClasses = $getColorPickerClasses();
    $colorPickerAttributes = $getColorPickerAttributes();
    $textInputAttributes = $getTextInputAttributes();

    // Build base attributes for input container
    $inputBaseAttributes = [];

    if ($errorFieldName && $errors->has($errorFieldName) && !$omitError) {
        $inputBaseAttributes['class'] = '!input-error';
    }

    // Create full UUID for wire:model support
    $fullUuid = $uuid . $modelName;
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($hasLabel && !$inline)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($attributes->get('required'))
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label @class(['floating-label' => $hasLabel && $inline])>
            {{-- FLOATING LABEL --}}
            @if ($hasLabel && $inline)
                <span class="ml-10 font-semibold">{{ $label }}</span>
            @endif

            <div class="join w-full">
                {{-- COLOR PICKER --}}
                <label x-data
                    x-on:click="$refs.colorpicker.click()"
                    :class="!$wire.{{ $modelName }} &&
                        'bg-[repeating-linear-gradient(45deg,_#ddd_0px,_#ddd_1px,_transparent_1px,_transparent_5px)]'"
                    :style="{ backgroundColor: $wire.{{ $modelName }} }"
                    class="{{ $colorPickerClasses }}">
                    <input wire:key="{{ $fullUuid }}"
                        x-ref="colorpicker"
                        x-on:click.stop=""
                        :style="{ backgroundColor: $wire.{{ $modelName }} }"
                        {{ $attributes->whereDoesntStartWith(['class', 'id', 'placeholder', 'type'])->merge($colorPickerAttributes) }}
                        {{ $attributes->wire('model') }}
                        @if ($isDisabled || $isReadonly) disabled @endif />
                </label>

                {{-- THE LABEL THAT HOLDS THE TEXT INPUT --}}
                <label {{ $attributes->whereStartsWith('class')->class($inputClasses)->merge($inputBaseAttributes) }}>
                    {{-- PREFIX --}}
                    @if ($hasPrefix)
                        <span class="label">{{ $prefix }}</span>
                    @endif

                    {{-- ICON LEFT --}}
                    @if ($hasIcon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none -ml-1 h-4 w-4 opacity-40" />
                    @endif

                    {{-- TEXT INPUT --}}
                    <input wire:key="{{ $fullUuid }}-text"
                        {{ $attributes->whereDoesntStartWith(['class', 'wire:model'])->merge($textInputAttributes) }}
                        {{ $attributes->wire('model') }}
                        @if ($isDisabled || $isReadonly) disabled @endif />

                    {{-- ICON RIGHT --}}
                    @if ($hasIconRight)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$iconRight"
                            class="pointer-events-none h-4 w-4 opacity-40" />
                    @endif

                    {{-- SUFFIX --}}
                    @if ($hasSuffix)
                        <span class="label">{{ $suffix }}</span>
                    @endif
                </label>
            </div>
        </label>

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
