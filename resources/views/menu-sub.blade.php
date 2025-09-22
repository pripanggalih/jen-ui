@aware(['activeBgColor' => 'bg-base-300'])

@php
    // Cache method calls for performance
    $isDisabled = $isDisabled();
    $containerClasses = $getContainerClasses();
    $iconClasses = $getIconClasses();

    // Check for active submenu
    $submenuActive = Str::contains($slot, 'mary-active-menu') || Str::contains($slot, 'jen-active-menu');

    // Build attributes for summary element
    $summaryAttributes = [];
    $summaryClasses = ['hover:text-inherit px-4 py-1.5 my-0.5 text-inherit'];

    if ($submenuActive) {
        $summaryClasses[] = $activeBgColor;
    }
@endphp

@if ($slot->isNotEmpty())
    <li wire:key="{{ $uuid }}"
        class="{{ $containerClasses }}"
        x-data="{
            show: @if ($submenuActive || $open) true @else false @endif,
            toggle() {
                // From parent Sidebar
                if (this.collapsed) {
                    this.show = true
                    $dispatch('menu-sub-clicked');
                    return
                }
        
                this.show = !this.show
            }
        }">

        <details :open="show"
            @if ($submenuActive) open @endif
            @click.stop>
            <summary @click.prevent="toggle()"
                {{ $attributes->whereDoesntStartWith('class') }}
                {{ $attributes->class($summaryClasses) }}>

                @if ($icon)
                    <x-dynamic-component :component="$jenPrefix . '::icon'"
                        :name="$icon"
                        class="{{ $iconClasses }}" />
                @endif

                <span class="jen-hideable mary-hideable truncate whitespace-nowrap">
                    {{ $title }}
                </span>
            </summary>

            <ul class="jen-hideable mary-hideable">
                {{ $slot }}
            </ul>
        </details>
    </li>
@endif
