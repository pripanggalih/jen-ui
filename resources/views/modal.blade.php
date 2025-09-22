@php
    // Cache method calls for performance
    $hasTitle = $hasTitle();
    $hasSeparator = $hasSeparator();
    $hasActions = $hasActions();
    $isPersistent = $isPersistent();
    $hasId = $hasId();
    $usesTrapFocus = $usesTrapFocus();
    $modalClasses = $getModalClasses();
    $boxClasses = $getBoxClasses();
    $closeButtonAttrs = $getCloseButtonAttributes();
    $alpineData = $getAlpineData();

    // Build base attributes for Alpine.js
    $baseAttributes = [];

    if ($hasId) {
        $baseAttributes['id'] = $id;
    } else {
        $baseAttributes = array_merge($baseAttributes, $alpineData);
    }
@endphp

<dialog wire:key="{{ $uuid }}"
    {{ $attributes->except('wire:model')->class($modalClasses)->merge($baseAttributes) }}>

    <div class="{{ $boxClasses }}">
        @if (!$isPersistent)
            <form method="dialog" tabindex="-1">
                @if ($hasId)
                    <x-dynamic-component :component="$jenPrefix . '::button'"
                        :class="$closeButtonAttrs['class']"
                        :icon="$closeButtonAttrs['icon']"
                        type="submit"
                        :tabindex="$closeButtonAttrs['tabindex']" />
                @else
                    <x-dynamic-component :component="$jenPrefix . '::button'"
                        :class="$closeButtonAttrs['class']"
                        :icon="$closeButtonAttrs['icon']"
                        @click="$wire.{{ $attributes->wire('model')->value() }} = false"
                        :tabindex="$closeButtonAttrs['tabindex']" />
                @endif
            </form>
        @endif

        @if ($hasTitle)
            <x-dynamic-component :component="$jenPrefix . '::header'"
                :title="$title"
                :subtitle="$subtitle"
                size="text-xl"
                :separator="$separator"
                class="!mb-5" />
        @endif

        <div>
            {{ $slot }}
        </div>

        @if ($hasSeparator && $hasActions)
            <hr class="border-base-content/10 mt-5 border-t-[length:var(--border)]" />
        @endif

        @if ($hasActions)
            <div class="modal-action">
                {{ $actions }}
            </div>
        @endif
    </div>

    @if (!$isPersistent)
        <form class="modal-backdrop" method="dialog">
            @if ($hasId)
                <button type="submit">close</button>
            @else
                <button @click="$wire.{{ $attributes->wire('model')->value() }} = false" type="button">close</button>
            @endif
        </form>
    @endif
</dialog>
