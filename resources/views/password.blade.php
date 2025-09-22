@php
    // Cache method calls for performance
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();
    $hasError = $hasError();
    $isRequired = $isRequired();
    $placeToggleLeft = $placeToggleLeft();
    $placeToggleRight = $placeToggleRight();
    $inputClasses = $getInputClasses();
    $wrapperClasses = $getWrapperClasses();
    $joinClasses = $getJoinClasses();

    // Generate unique UUID with model name
    $uniqueUuid = $uuid . $modelName;

    // Build base input attributes
    $baseInputAttributes = [
        'id' => $uniqueUuid,
        'placeholder' => $attributes->get('placeholder') . ' ',
    ];

    if ($onlyPassword) {
        $baseInputAttributes['type'] = 'password';
    }

    if ($attributes->has('autofocus') && $attributes->get('autofocus') == true) {
        $baseInputAttributes['autofocus'] = true;
    }

    // Input wrapper attributes
    $inputWrapperAttributes = [];

    if ($hasError && $errors->has($errorFieldName)) {
        $inputWrapperAttributes['class'] = '!input-error';
    }
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($label && !$inline)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <div class="{{ $wrapperClasses }}">
            {{-- FLOATING LABEL --}}
            @if ($label && $inline)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div class="{{ $joinClasses }}">
                {{-- PREPEND --}}
                @if ($prepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <div x-data="{ hidden: true }"
                    wire:key="{{ $uniqueUuid }}"
                    {{ $attributes->whereStartsWith('class')->class($inputClasses)->merge($inputWrapperAttributes) }}>
                    {{-- PREFIX --}}
                    @if ($prefix)
                        <span class="label">{{ $prefix }}</span>
                    @endif

                    {{-- ICON LEFT / TOGGLE INPUT TYPE --}}
                    @if ($icon)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            class="pointer-events-none h-4 w-4 opacity-40" />
                    @elseif($placeToggleLeft)
                        <x-dynamic-component :component="$jenPrefix . '::button'"
                            x-on:click="hidden = !hidden"
                            class="btn-ghost btn-xs btn-circle -m-1"
                            :tabindex="$passwordIconTabindex ? null : -1">
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$passwordIcon"
                                x-show="hidden"
                                class="h-4 w-4 opacity-40" />
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$passwordVisibleIcon"
                                x-show="!hidden"
                                x-cloak
                                class="h-4 w-4 opacity-40" />
                        </x-dynamic-component>
                    @endif

                    {{-- INPUT --}}
                    <input {{ $attributes->except('type')->merge($baseInputAttributes) }}
                        @if (!$onlyPassword) x-bind:type="hidden ? 'password' : 'text'" @endif />

                    {{-- CLEAR ICON  --}}
                    @if ($clearable)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            name="o-x-mark"
                            class="h-4 w-4 cursor-pointer opacity-40"
                            x-on:click="$wire.set('{{ $modelName }}', '', {{ json_encode($attributes->wire('model')->hasModifier('live')) }})" />
                    @endif

                    {{-- ICON RIGHT / TOGGLE INPUT TYPE --}}
                    @if ($iconRight)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$iconRight"
                            @class([
                                'pointer-events-none w-4 h-4 opacity-40',
                                '!end-10' => $clearable,
                            ]) />
                    @elseif($placeToggleRight)
                        <x-dynamic-component :component="$jenPrefix . '::button'"
                            x-on:click="hidden = !hidden"
                            @class(['btn-ghost btn-xs btn-circle -m-1', '!end-9' => $clearable])
                            :tabindex="$passwordIconTabindex ? null : -1">
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$passwordIcon"
                                x-show="hidden"
                                class="h-4 w-4 opacity-40" />
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$passwordVisibleIcon"
                                x-show="!hidden"
                                x-cloak
                                class="h-4 w-4 opacity-40" />
                        </x-dynamic-component>
                    @endif

                    {{-- SUFFIX --}}
                    @if ($suffix)
                        <span class="label">{{ $suffix }}</span>
                    @endif
                </div>

                {{-- APPEND --}}
                @if ($append)
                    {{ $append }}
                @endif
            </div>
        </div>

        {{-- HINT --}}
        @if ($hint)
            <div class="{{ $hintClass }}" x-classes="fieldset-label">{{ $hint }}</div>
        @endif

        {{-- ERROR --}}
        @if ($hasError && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}" x-class="text-error">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif
    </fieldset>
</div>
