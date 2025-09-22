@php
    // Cache method calls untuk performance
    $isRightAligned = $isRightAligned();
    $hasHint = $hasHint();
    $isRequired = $isRequired();
    $toggleClasses = $getToggleClasses();
    $labelClasses = $getLabelClasses();
    $mainLabelClasses = $getMainLabelClasses();

    // Build base attributes untuk toggle input
    $toggleAttributes = [];

    if ($id) {
        $toggleAttributes['id'] = $uuid;
    }
@endphp

<div wire:key="{{ $uuid }}">
    <fieldset class="fieldset">
        <div class="w-full">
            <label class="{{ $mainLabelClasses }}">

                {{-- TOGGLE INPUT --}}
                <input type="checkbox"
                    {{ $attributes->whereDoesntStartWith('id')->whereDoesntStartWith('class')->merge($toggleAttributes) }}
                    {{ $attributes->class($toggleClasses) }} />

                {{-- LABEL CONTAINER --}}
                <div class="{{ $labelClasses }}">
                    <div class="text-sm font-medium">
                        {{ $label }}

                        @if ($isRequired)
                            <span class="text-error">*</span>
                        @endif
                    </div>

                    {{-- HINT TEXT --}}
                    @if ($hasHint)
                        <div class="{{ $hintClass }}" x-classes="fieldset-label">{{ $hint }}</div>
                    @endif
                </div>
            </label>
        </div>

        {{-- ERROR DISPLAY --}}
        @if (!$omitError && $errors->has($errorFieldName()))
            @foreach ($errors->get($errorFieldName()) as $message)
                @foreach (Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}" x-class="text-error">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif
    </fieldset>
</div>
