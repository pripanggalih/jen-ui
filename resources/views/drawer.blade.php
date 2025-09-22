@php
    // Cache method calls for performance
    $drawerId = $id();
    $modelName = $modelName();
    $drawerClasses = $getDrawerClasses();
    $cardClasses = $getCardClasses();
    $hasCloseButton = $hasCloseButton();
    $shouldCloseOnEscape = $shouldCloseOnEscape();
    $isFocusTrapDisabled = $isFocusTrapDisabled();

    // Build base attributes for Alpine.js functionality
    $baseAttributes = [];

    if ($shouldCloseOnEscape) {
        $baseAttributes['@keydown.window.escape'] = 'close()';
    }

    if (!$isFocusTrapDisabled) {
        $baseAttributes['x-trap'] = 'open';
        $baseAttributes['x-bind:inert'] = '!open';
    }
@endphp

<div x-data="{
    open: @if ($modelName->value) @entangle($modelName)
            @else
                false @endif,
    close() {
        this.open = false
        $refs.checkbox.checked = false
    }
}"
    x-init="$watch('open', value => { if (!value) { $dispatch('close') } else { $dispatch('open') } })"
    wire:key="{{ $uuid }}"
    {{ $attributes->whereStartsWith('@')->merge($baseAttributes) }}
    {{ $attributes->whereDoesntStartWith(['@', 'class'])->except('wire:model') }}
    {{ $attributes->class($drawerClasses) }}>
    <!-- Toggle visibility  -->
    <input id="{{ $drawerId }}"
        x-model="open"
        x-ref="checkbox"
        type="checkbox"
        class="drawer-toggle" />

    <div class="drawer-side">
        <!-- Overlay effect, click outside -->
        <label for="{{ $drawerId }}" class="drawer-overlay"></label>

        <!-- Content -->
        <x-card :title="$title"
            :subtitle="$subtitle"
            :separator="$separator"
            wire:key="drawer-card"
            {{ $attributes->except('wire:model')->class($cardClasses) }}>
            @if ($hasCloseButton)
                <x-slot:menu>
                    <x-dynamic-component :component="$jenPrefix . '::button'"
                        icon="o-x-mark"
                        class="btn-ghost btn-sm btn-circle"
                        @click="close()" />
                </x-slot:menu>
            @endif

            {{ $slot }}

            @if ($actions)
                <x-slot:actions>
                    {{ $actions }}
                </x-slot:actions>
            @endif
        </x-card>
    </div>
</div>
