@php
    // Cache method calls in template for performance
    $hasShadow = $hasShadow();
    $hasSeparator = $hasSeparator();
    $hasProgressIndicator = $hasProgressIndicator();
    $cardClasses = $getCardClasses();
    $titleClasses = $getTitleClasses();
    $subtitleClasses = $getSubtitleClasses();
    $menuClasses = $getMenuClasses();
    $actionsClasses = $getActionsClasses();
    $bodyClasses = $getBodyClasses();
    $progressTarget = $progressTarget();

    // Build wire:key attributes
    $baseAttributes = [
        'wire:key' => $uuid,
    ];
@endphp

<div {{ $attributes->class($cardClasses)->merge($baseAttributes) }}>
    {{-- Figure Section --}}
    @if ($figure)
        <figure {{ $figure->attributes->class(['mb-5', '-m-5']) }}>
            {{ $figure }}
        </figure>
    @endif

    {{-- Header Section (Title/Subtitle/Menu) --}}
    @if ($title || $subtitle)
        <div class="pb-5">
            <div class="flex w-full items-center justify-between gap-3">
                <div class="grow-1">
                    @if ($title)
                        <div class="{{ $titleClasses }}">
                            {{ $title }}
                        </div>
                    @endif
                    @if ($subtitle)
                        <div class="{{ $subtitleClasses }}">
                            {{ $subtitle }}
                        </div>
                    @endif
                </div>

                @if ($menu)
                    <div class="{{ $menuClasses }}">
                        {{ $menu }}
                    </div>
                @endif
            </div>

            {{-- Separator with Progress Indicator --}}
            @if ($hasSeparator)
                <hr class="border-base-content/10 mt-3 border-t-[length:var(--border)]" />

                @if ($hasProgressIndicator)
                    <div class="-mt-4 mb-4 h-0.5">
                        <progress class="progress progress-primary h-0.5 w-full"
                            wire:loading
                            @if ($progressTarget) wire:target="{{ $progressTarget }}" @endif>
                        </progress>
                    </div>
                @endif
            @endif
        </div>
    @endif

    {{-- Body Section --}}
    <div class="{{ $bodyClasses }}">
        {{ $slot }}
    </div>

    {{-- Actions Section --}}
    @if ($actions)
        @if ($hasSeparator)
            <hr class="border-base-content/10 mt-5 border-t-[length:var(--border)]" />
        @else
            <div></div>
        @endif

        <div class="{{ $actionsClasses }}">
            {{ $actions }}
        </div>
    @endif
</div>
