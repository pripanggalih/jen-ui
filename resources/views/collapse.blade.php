@aware(['noJoin' => null])

@php
    // Cache method calls for performance
    $hasPlusMinusIcon = $hasPlusMinusIcon();
    $hasArrowIcon = $hasArrowIcon();
    $hasSeparator = $hasSeparator();
    $collapseClasses = $getCollapseClasses();
    $headingClasses = $getHeadingClasses();
    $contentClasses = $getContentClasses();
    $separatorClasses = $getSeparatorClasses();

    // Build attributes array for Laravel's native merge
$baseAttributes = [];

// Add join-item class if not in noJoin context
if (!isset($noJoin)) {
    $collapseClasses .= ' join-item';
    }
@endphp

<div wire:key="collapse-{{ $uuid }}" {{ $attributes->class($collapseClasses) }}>

    {{-- Input for collapse functionality --}}
    @if (isset($noJoin))
        {{-- Radio button for accordion --}}
        <input id="radio-{{ $uuid }}"
            type="radio"
            value="{{ $name }}"
            x-model="model" />
    @else
        {{-- Checkbox for standalone --}}
        <input id="checkbox-{{ $uuid }}"
            {{ $attributes->wire('model') }}
            type="checkbox" />
    @endif

    {{-- Heading section --}}
    <div {{ $heading->attributes->class($headingClasses) }}
        @if (isset($noJoin)) :class="model == '{{ $name }}' && 'z-10'"
             @click="if (model == '{{ $name }}') model = null" @endif>
        {{ $heading }}
    </div>

    {{-- Content section --}}
    <div {{ $content->attributes->class($contentClasses) }} wire:key="content-{{ $uuid }}">

        @if ($hasSeparator)
            <hr class="{{ $separatorClasses }}" />
        @endif

        {{ $content }}
    </div>
</div>
