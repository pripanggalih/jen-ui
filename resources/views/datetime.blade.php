@php
    // Cache method calls in template for performance
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
    $hasIcon = $hasIcon();
    $hasRightIcon = $hasRightIcon();
    $hasPrepend = $hasPrepend();
    $hasAppend = $hasAppend();
    $isFloatingLabel = $isFloatingLabel();
    $isStandardLabel = $isStandardLabel();
    $inputClasses = $getInputClasses();
    $wrapperAttributes = $getWrapperAttributes();

    // Build error state
    $hasError = $errorFieldName && $errors->has($errorFieldName) && !$omitError;

    // Final UUID with model name support for arrays
    $finalUuid = $uuid . $modelName;

    // Build input wrapper classes
    $inputWrapperClasses = array_merge(['input', 'w-full'], $wrapperAttributes['class'] ?? []);

    if ($hasPrepend || $hasAppend) {
        $inputWrapperClasses[] = 'join-item';
    }

    if ($hasError) {
        $inputWrapperClasses[] = '!input-error';
    }

    $inputWrapperClass = implode(' ', $inputWrapperClasses);
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($isStandardLabel)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($attributes->get('required'))
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label @class(['floating-label' => $isFloatingLabel])>
            {{-- FLOATING LABEL --}}
            @if ($isFloatingLabel)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div class="w-full">
                {{-- PREPEND --}}
                @if ($hasPrepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label {{ $attributes->whereStartsWith('class')->class($inputWrapperClass) }}>

                    {{-- ICON LEFT --}}
                    @if ($hasIcon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none -ml-1 h-4 w-4 opacity-40" />
                    @endif

                    {{-- INPUT --}}
                    <input wire:key="{{ $finalUuid }}"
                        id="{{ $finalUuid }}"
                        class="!grid"
                        {{ $attributes->whereDoesntStartWith('class')->merge(['type' => 'date']) }} />

                    {{-- ICON RIGHT --}}
                    @if ($hasRightIcon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$iconRight"
                            class="pointer-events-none h-4 w-4 opacity-40" />
                    @endif
                </label>

                {{-- APPEND --}}
                @if ($hasAppend)
                    {{ $append }}
                @endif
            </div>
        </label>

        {{-- ERROR --}}
        @if ($hasError)
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
