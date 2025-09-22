@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasIcon = $hasIcon();
    $hasRightIcon = $hasRightIcon();
    $hasHint = $hasHint();
    $isDisabled = $isDisabled();
    $isReadonly = $isReadonly();
    $inputClasses = $getInputClasses();
    $labelClasses = $getLabelClasses();
    $errorField = $errorFieldName();
    $modelNameValue = $modelName();

    // Generate unique UUID for this instance
    $uniqueUuid = $uuid . $modelNameValue;

    // Build base attributes
    $baseAttributes = $getBaseAttributes();

    // Build input wrapper attributes
    $wrapperAttributes = [];
    if ($errorField && $errors->has($errorField) && !$omitError) {
        $wrapperAttributes['class'] = '!input-error';
    }
@endphp

<div wire:key="{{ $uniqueUuid }}">
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

        <label class="{{ $labelClasses }}">
            {{-- FLOATING LABEL --}}
            @if ($hasLabel && $inline)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div class="w-full">
                {{-- PREPEND --}}
                @if ($prepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label
                    {{ $attributes->whereStartsWith('class')->class($inputClasses)->merge($baseAttributes)->merge($wrapperAttributes) }}>
                    {{-- ICON LEFT --}}
                    @if ($hasIcon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none -ml-1 h-4 w-4 opacity-40" />
                    @endif

                    {{-- INPUT --}}
                    <div x-data="{ instance: undefined }"
                        x-init="instance = flatpickr($refs.input, {{ $setup() }});"
                        @if (isset($config['mode']) && $config['mode'] == 'range' && $attributes->get('live')) @change="const value = $event.target.value; if(value.split(instance.l10n.rangeSeparator).length == 2) { $wire.set('{{ $modelNameValue }}', value) };" @endif
                        x-on:livewire:navigating.window="instance.destroy();"
                        class="w-full">
                        <input x-ref="input"
                            {{ $attributes->whereDoesntStartWith('class')->merge(['type' => 'date']) }} />
                    </div>

                    {{-- ICON RIGHT --}}
                    @if ($hasRightIcon)
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

        {{-- ERROR --}}
        @if (!$omitError && $errors->has($errorField))
            @foreach ($errors->get($errorField) as $message)
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
