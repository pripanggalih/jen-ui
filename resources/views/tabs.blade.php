@php
    // Cache method calls in template for performance
    $hasSelected = $hasSelected();
    $tabsClasses = $getTabsClasses();
    $labelDivClasses = $getLabelDivClasses();
    $labelClasses = $getLabelClasses();
    $activeClasses = $getActiveClasses();
@endphp

<div x-data="{
    tabs: [],
    selected: @if ($hasSelected) '{{ $selected }}' @else @entangle($attributes->wire('model')) @endif,
    init() {
        // Fix weird issue when navigating back
        document.addEventListener('livewire:navigating', () => {
            document.querySelectorAll('.tab').forEach(el => el.remove());
        });
    }
}"
    class="{{ $tabsClasses }}"
    wire:key="{{ $uuid }}">

    <!-- TAB LABELS -->
    <div class="{{ $labelDivClasses }}">
        <template x-for="tab in tabs" :key="tab.name">
            <a role="tab"
                x-html="tab.label"
                @click="tab.disabled ? null : selected = tab.name"
                :class="{ '{{ $activeClasses }} tab-active': selected === tab.name, 'hidden': tab.hidden }"
                class="tab {{ $labelClasses }}"></a>
        </template>
    </div>

    <!-- TAB CONTENT -->
    <div role="tablist" {{ $attributes->except(['wire:model', 'wire:model.live'])->class(['block']) }}>
        {{ $slot }}
    </div>
</div>
