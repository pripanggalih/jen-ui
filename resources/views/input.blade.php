@php
    // Cache method calls untuk performa yang optimal
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
    $isDisabled = $isDisabled();
    $isReadonly = $isReadonly();
    $hasIcon = $hasIcon();
    $hasIconRight = $hasIconRight();
    $hasPrefix = $hasPrefix();
    $hasSuffix = $hasSuffix();
    $hasHint = $hasHint();
    $hasPrepend = $hasPrepend();
    $hasAppend = $hasAppend();
    $inputClasses = $getInputClasses();
    $inputAttributes = $getInputAttributes();
    $fullUuid = $uuid . $modelName;

    // Build attributes untuk Laravel native merge
    $baseAttributes = [];

    if ($isDisabled) {
        $baseAttributes['disabled'] = true;
    }

    // Error handling attributes
    $hasError = !$omitError && $errorFieldName && $errors->has($errorFieldName);
    if ($hasError) {
        $baseAttributes['class'] = '!input-error';
    }

    // Input specific attributes
    $inputBaseAttributes = array_merge(
        [
            'id' => $fullUuid,
            'type' => 'text',
            'placeholder' => $attributes->get('placeholder') ?? '',
        ],
        $inputAttributes,
    );

    // Money handling attributes
    $inputExcept = $money ? ['wire:model', 'wire:model.live', 'wire:model.blur'] : '';
@endphp

<div wire:key="{{ $uuid }}">
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

        <label @class(['floating-label' => $label && $inline])>
            {{-- FLOATING LABEL --}}
            @if ($label && $inline)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div @class(['w-full', 'join' => $hasPrepend || $hasAppend])>
                {{-- PREPEND --}}
                @if ($hasPrepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label {{ $attributes->whereStartsWith('class')->class($inputClasses)->merge($baseAttributes) }}>
                    {{-- PREFIX --}}
                    @if ($hasPrefix)
                        <span class="label">{{ $prefix }}</span>
                    @endif

                    {{-- ICON LEFT --}}
                    @if ($hasIcon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none h-4 w-4 opacity-40" />
                    @endif

                    {{-- MONEY SETUP --}}
                    @if ($money)
                        <div class="w-full"
                            x-data="{ amount: $wire.get('{{ $modelName }}') }"
                            x-init="$nextTick(() => new Currency($refs.myInput, {{ $moneySettings() }}))">
                    @endif

                    {{-- INPUT --}}
                    <input {{ $attributes->merge($inputBaseAttributes)->except($inputExcept) }}
                        @if ($money) :value="amount"
                               x-on:input="$nextTick(() => $wire.set('{{ $modelName }}', Currency.getUnmasked(), {{ json_encode($attributes->wire('model')->hasModifier('live')) }}))"
                               x-on:blur="$nextTick(() => $wire.set('{{ $modelName }}', Currency.getUnmasked(), {{ json_encode($attributes->wire('model')->hasModifier('blur')) }}))" @endif />

                    {{-- HIDDEN MONEY INPUT + END MONEY SETUP --}}
                    @if ($money)
                        <input type="hidden" {{ $attributes->wire('model') }} />
            </div>
            @endif

            {{-- CLEAR ICON --}}
            @if ($clearable)
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    x-on:click="$wire.set('{{ $modelName }}', '', {{ json_encode($attributes->wire('model')->hasModifier('live')) }})"
                    name="o-x-mark"
                    class="h-4 w-4 cursor-pointer opacity-40" />
            @endif

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
            <div class="{{ $errorClass }}" x-class="text-error">{{ $line }}</div>
            @break($firstErrorOnly)
        @endforeach
        @break($firstErrorOnly)
    @endforeach
@endif

{{-- HINT --}}
@if ($hasHint)
    <div class="{{ $hintClass }}" x-classes="fieldset-label">{{ $hint }}</div>
@endif
</fieldset>
</div>
