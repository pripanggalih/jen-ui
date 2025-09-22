@php
    // Cache method calls in template for performance
    $hasAvatar = $hasAvatar();
    $hasCustomAvatar = $hasCustomAvatar();
    $hasLink = $hasLink();
    $hasActions = $hasActions();
    $hasActionsWithEvents = $hasActionsWithEvents();
    $mainClasses = $getMainClasses();

    // Build attributes for Laravel native merge
    $baseAttributes = [];
@endphp

<div wire:key="{{ $uuid }}">
    <div {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
        {{ $attributes->class($mainClasses) }}>

        @if ($hasLink && ($hasAvatar || $hasCustomAvatar))
            <div>
                <a href="{{ $link }}" wire:navigate>
        @endif

        {{-- AVATAR --}}
        @if ($hasAvatar)
            <div class="py-3">
                <div class="avatar">
                    <div class="w-11 rounded-full">
                        <img src="{{ $getAvatarUrl() }}"
                            @if ($fallbackAvatar) onerror="this.src='{{ $fallbackAvatar }}'" @endif />
                    </div>
                </div>
            </div>
        @endif

        @if ($hasCustomAvatar)
            <div {{ $avatar->attributes->class(['py-3']) }}>
                {{ $avatar }}
            </div>
        @endif

        @if ($hasLink && ($hasAvatar || $hasCustomAvatar))
            </a>
    </div>
    @endif

    {{-- CONTENT --}}
    <div class="w-0 flex-1 overflow-hidden truncate text-ellipsis whitespace-nowrap">
        @if ($hasLink)
            <a href="{{ $link }}" wire:navigate>
        @endif

        <div class="py-3">
            <div
                @if (!is_string($value)) {{ $value->attributes->class(['font-semibold truncate']) }} @else class="font-semibold truncate" @endif>
                {{ is_string($value) ? $getMainValue() : $value }}
            </div>

            @if ($subValue)
                <div
                    @if (!is_string($subValue)) {{ $subValue->attributes->class(['text-base-content/50 text-sm truncate']) }} @else class="text-base-content/50 text-sm truncate" @endif>
                    {{ is_string($subValue) ? $getSubValue() : $subValue }}
                </div>
            @endif
        </div>

        @if ($hasLink)
            </a>
        @endif
    </div>

    {{-- ACTIONS --}}
    @if ($hasActions)
        @if ($hasLink && !$hasActionsWithEvents)
            <a href="{{ $link }}" wire:navigate>
        @endif
        <div {{ $actions->attributes->class(['py-3 flex items-center gap-3']) }}>
            {{ $actions }}
        </div>

        @if ($hasLink && !$hasActionsWithEvents)
            </a>
        @endif
    @endif
</div>

@if (!$noSeparator)
    <hr class="border-base-content/10 border-t-[length:var(--border)]" />
@endif
</div>
