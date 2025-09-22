@aware(['activateByRoute' => false, 'activeBgColor' => 'bg-base-300'])

@php
    // Cache method calls in template for performance
    $isActive = $isActive();
    $isDisabled = $isDisabled();
    $hasSpinner = $hasSpinner();
    $hasIcon = $hasIcon();
    $hasBadge = $hasBadge();
    $routeMatches = $routeMatches();
    $menuItemClasses = $getMenuItemClasses();
    $linkAttributes = $getLinkAttributes();

    // Build base attributes array for Laravel's native merge
$baseAttributes = array_merge($linkAttributes, []);

// Dynamic classes based on active state
$activeClass = $isActive || ($activateByRoute && $routeMatches) ? "mary-active-menu {$activeBgColor}" : '';
@endphp

<li wire:key="{{ $uuid }}" @class(['menu-disabled' => $isDisabled])>
    <a {{ $attributes->class([$menuItemClasses, $activeClass])->merge($baseAttributes) }}>
        {{-- SPINNER --}}
        @if ($hasSpinner)
            <span wire:loading
                wire:target="{{ $spinnerTarget() }}"
                class="loading loading-spinner h-5 w-5"></span>
        @endif

        {{-- ICON --}}
        @if ($hasIcon)
            <span class="block py-0.5"
                @if ($hasSpinner) wire:loading.class="hidden"
                    wire:target="{{ $spinnerTarget() }}" @endif>
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$icon"
                    :class="$getIconClasses()" />
            </span>
        @endif

        {{-- TITLE AND BADGE --}}
        @if ($title || $slot->isNotEmpty())
            <span class="mary-hideable truncate whitespace-nowrap">
                @if ($title)
                    {{ $title }}

                    @if ($hasBadge)
                        <span class="{{ $getBadgeClasses() }}">{{ $badge }}</span>
                    @endif
                @else
                    {{ $slot }}
                @endif
            </span>
        @endif
    </a>
</li>
