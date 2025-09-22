@php
    // Cache method calls for performance
    $isRequired = $isRequired();
    $isInline = (bool) $inline;
    $hasLabel = (bool) $label;
    $hasHint = (bool) $hint;
    $hasErrors = $hasErrors();
    $textareaClasses = $getTextareaClasses();
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();

    // Build base attributes
    $baseAttributes = $getBaseAttributes();
    $baseAttributes['id'] = $uuid . $modelName;

    // We need this extra step to support model arrays. Ex: wire:model="emails.0", wire:model="emails.1"
    $finalUuid = $uuid . $modelName;
@endphp

<div wire:key="{{ $finalUuid }}">
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($hasLabel && !$isInline)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label @class(['floating-label' => $hasLabel && $isInline])>
            {{-- FLOATING LABEL --}}
            @if ($hasLabel && $isInline)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div class="w-full">
                {{-- TEXTAREA --}}
                <textarea {{ $attributes->whereDoesntStartWith(['class', 'placeholder'])->merge($baseAttributes) }}
                    {{ $attributes->class($textareaClasses) }}>{{ $slot }}</textarea>
            </div>
        </label>

        {{-- ERROR --}}
        @if (!$omitError && $hasErrors)
            @foreach (app('view')->shared('errors')->get($errorFieldName) as $message)
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
