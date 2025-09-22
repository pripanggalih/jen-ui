@php
    // Cache method calls for performance
    $isPending = $isPending();
    $isFirst = $isFirst();
    $isLast = $isLast();
    $hasIcon = $hasIcon();
    $hasSubtitle = $hasSubtitle();
    $hasDescription = $hasDescription();

    // Get classes for timeline elements
    $lastBorderClasses = $getLastBorderClasses();
    $wrapperClasses = $getWrapperClasses();
    $bulletClasses = $getBulletClasses();
    $iconClasses = $getIconClasses();
@endphp

<div wire:key="{{ $uuid }}">
    {{-- Last item border cut --}}
    @if ($isLast)
        <div class="{{ $lastBorderClasses }}"></div>
    @endif

    {{-- WRAPPER THAT ALSO ACTS A LINE CONNECTOR --}}
    <div class="{{ $wrapperClasses }}">
        {{-- BULLET --}}
        <div class="{{ $bulletClasses }}">
            {{-- ICON --}}
            @if ($hasIcon)
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$icon"
                    class="{{ $iconClasses }}" />
            @endif
        </div>

        {{-- TITLE --}}
        <div class="mb-1 font-bold">{{ $title }}</div>

        {{-- SUBTITLE --}}
        @if ($hasSubtitle)
            <div class="text-base-content/30 text-xs font-bold">{{ $subtitle }}</div>
        @endif

        {{-- DESCRIPTION --}}
        @if ($hasDescription)
            <div class="mt-3 text-sm">
                {{ $description }}
            </div>
        @endif
    </div>
</div>
