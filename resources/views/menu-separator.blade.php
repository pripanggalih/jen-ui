@php
    // Cache method calls for performance
    $hasTitle = $hasTitle();
    $hasIcon = $hasIcon();
    $menuTitleClasses = $getMenuTitleClasses();
    $separatorAttributes = $getSeparatorAttributes();
@endphp

{{-- Always show the separator line --}}
<hr wire:key="{{ $uuid }}-separator"
    {{ collect($separatorAttributes)->map(fn($value, $key) => "{$key}=\"{$value}\"")->implode(' ') }} />

{{-- Show title section if title exists --}}
@if ($hasTitle)
    <li wire:key="{{ $uuid }}-title" {{ $attributes->class($menuTitleClasses) }}>
        <div class="flex items-center gap-2">
            {{-- Icon with dynamic prefix --}}
            @if ($hasIcon)
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$icon"
                    :class="$iconClasses" />
            @endif

            {{ $title }}
        </div>
    </li>
@endif
