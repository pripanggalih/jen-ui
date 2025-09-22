@php
    // Cache method calls for performance
    $hasCustomTrue = $hasCustomTrue();
    $hasCustomFalse = $hasCustomFalse();
    $swapClasses = $getSwapClasses();
    $trueClasses = $getTrueClasses();
    $falseClasses = $getFalseClasses();
    $iconClasses = $getIconClasses();
@endphp

<label for="{{ $uuid }}" {{ $attributes->whereDoesntStartWith('wire:model') }}>

    {{-- Before --}}
    @isset($before)
        <div {{ $before->attributes }}>
            {{ $before }}
        </div>
        @endif

        <div class="{{ $swapClasses }}">

            {{-- Hidden checkbox for state --}}
            <input id="{{ $uuid }}"
                type="checkbox"
                {{ $attributes->wire('model') }} />

            {{-- True Element --}}
            @if ($hasCustomTrue)
                <div
                    {{ is_string($true) ? new Illuminate\View\ComponentAttributeBag(['class' => $trueClasses]) : $true->attributes->merge(['class' => $trueClasses]) }}>
                    {{ $true ?? '' }}
                </div>
            @else
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$trueIcon"
                    class="{{ $trueClasses }} {{ $iconClasses }}" />
            @endif

            {{-- False Element --}}
            @if ($hasCustomFalse)
                <div
                    {{ is_string($false) ? new Illuminate\View\ComponentAttributeBag(['class' => $falseClasses]) : $false->attributes->merge(['class' => $falseClasses]) }}>
                    {{ $false ?? '' }}
                </div>
            @else
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$falseIcon"
                    class="{{ $falseClasses }} {{ $iconClasses }}" />
            @endif

        </div>

        {{-- After --}}
        @isset($after)
            <div {{ $after->attributes }}>
                {{ $after }}
            </div>
            @endif
        </label>
