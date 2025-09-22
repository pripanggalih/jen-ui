@php
    $hasTitle = (bool) $title;
    $hasIcon = (bool) $icon;
    $mainClasses = 'menu w-full';
@endphp

<ul wire:key="{{ $uuid }}" {{ $attributes->class([$mainClasses]) }}>
    @if ($hasTitle)
        <li class="menu-title uppercase text-inherit">
            <div class="flex items-center gap-2">
                @if ($hasIcon)
                    <x-dynamic-component :component="$jenPrefix . '::icon'"
                        :name="$icon"
                        class="{{ $iconClasses }} inline-flex" />
                @endif
                {{ $title }}
            </div>
        </li>
    @endif

    @if ($separator)
        <hr class="border-base-content/10 mb-3 border-t-[length:var(--border)]" />
    @endif

    {{ $slot }}
</ul>
