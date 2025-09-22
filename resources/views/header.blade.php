@php
    // Cache method calls in template for performance
    $hasIcon = $hasIcon();
    $hasProgressIndicator = $hasProgressIndicator();
    $hasProgressTarget = $hasProgressTarget();
    $containerClasses = $getContainerClasses();
    $titleClasses = $getTitleClasses();
    $subtitleClasses = $getSubtitleClasses();
    $middleClasses = $getMiddleClasses();
    $actionsClasses = $getActionsClasses();
@endphp

<div id="{{ $anchor }}" {{ $attributes->class($containerClasses) }}>
    <div class="flex flex-wrap items-center justify-between gap-5">
        <div>
            <div class="{{ $titleClasses }}">
                @if ($withAnchor)
                    <a href="#{{ $anchor }}">
                @endif

                @if ($hasIcon)
                    <x-dynamic-component :component="$jenPrefix . '::icon'"
                        name="{{ $icon }}"
                        class="{{ $iconClasses }}" />
                @endif

                <span @class(['ml-2' => $hasIcon])>{{ $title }}</span>

                @if ($withAnchor)
                    </a>
                @endif
            </div>

            @if ($subtitle)
                <div class="{{ $subtitleClasses }}">
                    {{ $subtitle }}
                </div>
            @endif
        </div>

        @if ($middle)
            <div class="{{ $middleClasses }}">
                <div class="w-full lg:w-auto">
                    {{ $middle }}
                </div>
            </div>
        @endif

        <div class="{{ $actionsClasses }}">
            {{ $actions }}
        </div>
    </div>

    @if ($separator)
        <hr class="border-base-content/10 mt-3 border-t-[length:var(--border)]" />

        @if ($hasProgressIndicator)
            <div class="-mt-4 mb-4 h-0.5">
                <progress class="progress {{ $progressIndicatorClass }} h-[var(--border)] w-full"
                    wire:loading
                    @if ($hasProgressTarget) wire:target="{{ $progressTarget() }}" @endif></progress>
            </div>
        @endif
    @endif
</div>
