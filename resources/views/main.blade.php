@php
    // Cache method calls in template for performance
    $hasSidebar = $hasSidebar();
    $hasFooter = $hasFooter();
    $isFullWidth = $isFullWidth();
    $hasNav = $hasNav();
    $isCollapsible = $isCollapsible();

    // Get computed classes
    $mainClasses = $getMainClasses();
    $drawerClasses = $getDrawerClasses();
    $contentClasses = $getContentClasses();
    $sidebarClasses = $getSidebarClasses();
    $sidebarContentClasses = $getSidebarContentClasses();
    $footerClasses = $getFooterClasses();

    // Get dynamic values
    $drawerId = $getDrawerId();
    $sidebarSessionState = $getSidebarSessionState();
@endphp

<main wire:key="{{ $uuid }}" {{ $attributes->class($mainClasses) }}>
    <div class="{{ $drawerClasses }}">
        <input id="{{ $drawerId }}"
            type="checkbox"
            class="drawer-toggle" />

        <div {{ $content?->attributes->class($contentClasses) ?? 'class=' . $contentClasses }}>
            {{-- MAIN CONTENT --}}
            {{ $content ?? $slot }}
        </div>

        {{-- SIDEBAR --}}
        @if ($hasSidebar)
            <div x-data="{
                collapsed: {{ $sidebarSessionState }},
                collapseText: '{{ $collapseText }}',
                toggle() {
                    this.collapsed = !this.collapsed;
                    fetch('{{ $url }}?collapsed=' + this.collapsed);
                    this.$dispatch('sidebar-toggled', this.collapsed);
                }
            }"
                @menu-sub-clicked="if(collapsed) { toggle() }"
                class="{{ $sidebarClasses }}">
                <label for="{{ $drawerId }}"
                    aria-label="close sidebar"
                    class="drawer-overlay"></label>

                {{-- SIDEBAR CONTENT --}}
                <div :class="collapsed
                    ?
                    '!w-[62px] [&>*_summary::after]:!hidden [&_.jen-hideable]:!hidden [&_.display-when-collapsed]:!block [&_.hidden-when-collapsed]:!hidden' :
                    '!w-[270px] [&>*_summary::after]:!block [&_.jen-hideable]:!block [&_.hidden-when-collapsed]:!block [&_.display-when-collapsed]:!hidden'"
                    {{ $sidebar->attributes->class($sidebarContentClasses) }}>
                    <div class="flex-1">
                        {{ $sidebar }}
                    </div>

                    {{-- SIDEBAR COLLAPSE --}}
                    @if ($sidebar->attributes['collapsible'] ?? $isCollapsible)
                        <x-menu class="hidden lg:block">
                            <x-menu-item @click="toggle"
                                icon="{{ $sidebar->attributes['collapse-icon'] ?? $collapseIcon }}"
                                title="{{ $sidebar->attributes['collapse-text'] ?? $collapseText }}" />
                        </x-menu>
                    @endif
                </div>
            </div>
        @endif
        {{-- END SIDEBAR --}}
    </div>
</main>

{{-- FOOTER --}}
@if ($hasFooter)
    <footer {{ $footer->attributes->class($footerClasses) }}>
        {{ $footer }}
    </footer>
@endif
