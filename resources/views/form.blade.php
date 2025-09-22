@php
    // Cache method calls for performance
    $hasActions = $hasActions();
    $shouldShowSeparator = $shouldShowSeparator();
    $formClasses = $getFormClasses();
    $actionsClasses = $getActionsClasses();

    // Build base attributes
    $baseAttributes = [];
@endphp

<form wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
    {{ $attributes->class($formClasses) }}>

    {{ $slot }}

    @if ($hasActions)
        {{-- Separator --}}
        @if ($shouldShowSeparator)
            <hr class="border-base-content/10 my-3 border-t-[length:var(--border)]" />
        @else
            <div></div>
        @endif

        {{-- Actions Container --}}
        <div {{ $actions->attributes->class([$actionsClasses]) }}>
            {{ $actions }}
        </div>
    @endif
</form>
