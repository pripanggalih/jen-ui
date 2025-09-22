<ul wire:key="{{ $uuid }}" {{ $attributes->class('flex items-center') }}>
    @foreach ($items as $element)
        @php
            // Check conditions for this element
            $elementTooltip =
                $element['tooltip'] ??
                ($element['tooltip-left'] ??
                    ($element['tooltip-right'] ?? ($element['tooltip-bottom'] ?? ($element['tooltip-top'] ?? null))));
            $hasElementLink = !empty($element['link']);
            $hasElementIcon = !empty($element['icon']);

            // Determine tooltip position
            $tooltipPositionClass = 'lg:tooltip-top';
            if (isset($element['tooltip-left'])) {
                $tooltipPositionClass = 'lg:tooltip-left';
            } elseif (isset($element['tooltip-right'])) {
                $tooltipPositionClass = 'lg:tooltip-right';
            } elseif (isset($element['tooltip-bottom'])) {
                $tooltipPositionClass = 'lg:tooltip-bottom';
            }

            // Build li classes
            $liClasses = [];
            if ($elementTooltip) {
                $liClasses[] = 'lg:tooltip ' . $tooltipPositionClass;
            }
            if (!$loop->first && !$loop->last) {
                $liClasses[] = 'hidden sm:block';
            }

            // Build li attributes
            $liAttributes = [];
            if ($elementTooltip) {
                $liAttributes['data-tip'] = $elementTooltip;
            }
            if (!empty($liClasses)) {
                $liAttributes['class'] = implode(' ', $liClasses);
            }
        @endphp

        {{-- Breadcrumb Item --}}
        <li
            @foreach ($liAttributes as $key => $value)
                {{ $key }}="{{ $value }}" @endforeach>

            @if ($hasElementLink)
                <a href="{{ $element['link'] }}"
                    @if (!$noWireNavigate) wire:navigate @endif
                    class="{{ $linkItemClass }}">
                @else
                    <span class="{{ $textItemClass }}">
            @endif

            {{-- Icon --}}
            @if ($hasElementIcon)
                <x-dynamic-component :component="$jenPrefix . '::icon'"
                    :name="$element['icon']"
                    class="{{ $iconClass }} mb-0.5" />
            @endif

            {{-- Label --}}
            <span>{{ $element['label'] ?? '' }}</span>

            @if ($hasElementLink)
                </a>
            @else
                </span>
            @endif
        </li>

        {{-- Mobile ellipsis indicator --}}
        @if ($loop->remaining == 1 && $loop->count > 2)
            <span class="sm:hidden">...</span>
        @endif

        {{-- Separator --}}
        @php
            $separatorClasses = ['hidden'];

            // Show separator after first item or before last item when count > 1
            if (($loop->first || $loop->remaining == 1) && $loop->count > 1) {
                $separatorClasses[] = '!block';
            }

            // Show separator on small screens for non-last items when count > 1
            if (!$loop->last && $loop->count > 1) {
                $separatorClasses[] = 'sm:!block';
            }
        @endphp

        <span class="{{ implode(' ', $separatorClasses) }}">
            <x-dynamic-component :component="$jenPrefix . '::icon'"
                :name="$separator"
                class="{{ $separatorClass }}" />
        </span>
    @endforeach
</ul>
