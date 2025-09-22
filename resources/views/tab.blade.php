@php
    // Cache method calls in template for performance
    $isDisabled = $isDisabled();
    $isHidden = $isHidden();
    $tabData = $getTabData();

    // Build tab label HTML - use method exactly like Mary UI
    $labelHtml = $tabLabel($label ?: '');

    // Build base attributes for tab link
    $tabLinkAttributes = [
        'data-name' => $name,
    ];
@endphp

{{-- Tab link element (hidden, used for Alpine.js state management) --}}
<a class="tab hidden"
    :class="{ 'tab-active': selected === '{{ $name }}' }"
    {{ collect($tabLinkAttributes)->map(fn($value, $key) => "{$key}=\"{$value}\"")->join(' ') }}
    x-init="const newItem = {
        name: '{{ $name }}',
        label: {{ json_encode($labelHtml) }},
        disabled: {{ $isDisabled ? 'true' : 'false' }},
        hidden: {{ $isHidden ? 'true' : 'false' }}
    };
    const index = tabs.findIndex(item => item.name === '{{ $name }}');
    index !== -1 ? tabs[index] = newItem : tabs.push(newItem);

    Livewire.hook('morph.removed', ({ el }) => {
        if (el.getAttribute('data-name') == '{{ $name }}') {
            tabs = tabs.filter(i => i.name !== '{{ $name }}')
        }
    })"></a>

{{-- Tab content panel --}}
<div x-show="selected === '{{ $name }}'"
    role="tabpanel"
    wire:key="{{ $uuid }}"
    {{ $attributes->class('tab-content py-5 px-1') }}>
    {{ $slot }}
</div>
