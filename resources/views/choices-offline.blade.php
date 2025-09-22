@php
    // Cache method calls for performance
    $isReadonly = $isReadonly();
    $isDisabled = $isDisabled();
    $isRequired = $isRequired();
    $hasIcon = $hasIcon();
    $hasIconRight = $hasIconRight();
    $hasPrefix = $hasPrefix();
    $hasSuffix = $hasSuffix();
    $shouldShowError = $shouldShowError();
    $fieldsetClasses = $getFieldsetClasses();
    $labelClasses = $getLabelClasses();
    $inputClasses = $getInputClasses();

    // Build base attributes
    $baseAttributes = [];

    if ($isDisabled) {
        $baseAttributes['disabled'] = true;
    }
@endphp

<div x-data="{ focused: false, selection: @entangle($attributes->wire('model')) }">
    <div @click.outside="clear()"
        @keyup.esc="clear()"
        x-data="{
            id: $id('{{ $uuid }}'),
            options: {{ json_encode($options) }},
            isSingle: {{ json_encode($single) }},
            isSearchable: {{ json_encode($searchable) }},
            isReadonly: {{ json_encode($isReadonly) }},
            isDisabled: {{ json_encode($isDisabled) }},
            isRequired: {{ json_encode($isRequired) }},
            minChars: {{ $minChars }},
            noResults: false,
            search: '',
        
            init() {
                // Fix weird issue when navigating back
                document.addEventListener('livewire:navigating', () => {
                    let elements = document.querySelectorAll('.jen-choices-element');
                    elements.forEach(el => el.remove());
                });
            },
            get selectedOptions() {
                return this.isSingle ?
                    this.options.filter(i => i.{{ $optionValue }} == this.selection) :
                    this.selection.map(i => this.options.filter(o => o.{{ $optionValue }} == i)[0])
            },
            get isAllSelected() {
                return this.options.length == this.selection.length
            },
            get isSelectionEmpty() {
                return this.isSingle ?
                    this.selection == null || this.selection == '' :
                    this.selection.length == 0
            },
            selectAll() {
                this.selection = this.options.map(i => i.{{ $optionValue }})
                this.dispatchChangeEvent({ value: this.selection })
            },
            clear() {
                this.focused = false;
                this.search = ''
            },
            reset() {
                this.clear();
                this.isSingle ?
                    this.selection = null :
                    this.selection = []
        
                this.dispatchChangeEvent({ value: this.selection })
            },
            focus() {
                if (this.isReadonly || this.isDisabled) {
                    return
                }
        
                this.focused = true
                this.$refs.searchInput.focus()
            },
            resize() {
                $refs.searchInput.style.width = ($refs.searchInput.value.length + 1) * 0.55 + 'rem'
            },
            isActive(id) {
                return this.isSingle ?
                    this.selection == id :
                    this.selection.includes(id)
            },
            toggle(id, keepOpen = false) {
                if (this.isReadonly || this.isDisabled) {
                    return
                }
        
                if (this.isSingle) {
                    this.selection = id
                    this.focused = false
                    this.search = ''
                } else {
                    this.selection.includes(id) ?
                        this.selection = this.selection.filter(i => i != id) :
                        this.selection.push(id)
                }
        
                this.dispatchChangeEvent({ value: this.selection })
        
                if (!keepOpen) {
                    this.$refs.searchInput.focus()
                }
            },
            lookup() {
                Array.from(this.$refs.choicesOptions.children).forEach(child => {
                    if (!child.getAttribute('search-value').match(new RegExp(this.search, 'i'))) {
                        child.classList.add('hidden')
                    } else {
                        child.classList.remove('hidden')
                    }
                })
        
                this.noResults = Array.from(this.$refs.choicesOptions.querySelectorAll('div > .hidden')).length ==
                    Array.from(this.$refs.choicesOptions.querySelectorAll('[search-value]')).length
            },
            dispatchChangeEvent(detail) {
                this.$refs.searchInput.dispatchEvent(new CustomEvent('change-selection', { bubbles: true, detail }))
            },
            getFocusableElements() {
                return Array.from(this.$refs.choicesOptions.querySelectorAll('[tabindex]:not([disabled])'))
                    .filter(el => el.offsetParent !== null && getComputedStyle(el).visibility !== 'hidden')
            },
            focusNext() {
                let focusableElements = this.getFocusableElements()
                let index = focusableElements.indexOf(document.activeElement)
                let nextElement = focusableElements[index + 1]
        
                if (nextElement) {
                    nextElement.focus();
                }
            },
            focusPrevious() {
                let focusableElements = this.getFocusableElements()
                let index = focusableElements.indexOf(document.activeElement)
                let prevElement = focusableElements[index - 1]
        
                if (prevElement) {
                    prevElement.focus()
                }
            }
        }"
        @keydown.up="focusPrevious()"
        @keydown.down="focusNext()">
        <fieldset wire:key="{{ $uuid }}"
            {{ $attributes->whereDoesntStartWith(['class', 'wire:model'])->merge($baseAttributes) }}
            class="{{ $fieldsetClasses }}">
            {{-- STANDARD LABEL --}}
            @if ($label && !$inline)
                <legend class="fieldset-legend mb-0.5">
                    {{ $label }}

                    @if ($isRequired)
                        <span class="text-error">*</span>
                    @endif
                </legend>
            @endif

            <label @class(['floating-label' => $label && $inline])>
                {{-- FLOATING LABEL --}}
                @if ($label && $inline)
                    <span class="font-semibold">{{ $label }}</span>
                @endif

                <div class="{{ $labelClasses }}">
                    {{-- PREPEND --}}
                    @if ($prepend)
                        {{ $prepend }}
                    @endif

                    {{-- THE LABEL THAT HOLDS THE INPUT --}}
                    <label x-ref="container"
                        @if ($isDisabled) disabled @endif
                        @if (!$isDisabled && !$isReadonly) @click="focus()" @endif
                        class="{{ $inputClasses }}">
                        {{-- PREFIX --}}
                        @if ($hasPrefix)
                            <span class="label">{{ $prefix }}</span>
                        @endif

                        {{-- ICON LEFT --}}
                        @if ($hasIcon)
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$icon"
                                class="pointer-events-none h-4 w-4 opacity-40" />
                        @endif

                        <div class="min-h-3 w-full content-center text-wrap py-0.5">
                            {{-- SELECTION DISPLAY --}}
                            <template x-if="!isSelectionEmpty">
                                <div class="flex flex-wrap items-center gap-1">
                                    {{-- COMPACT MODE --}}
                                    <template x-if="!isSingle && selectedOptions.length > 0">
                                        @if ($compact)
                                            <span class="badge badge-primary badge-sm"
                                                x-show="selectedOptions.length > 0"
                                                x-text="`${selectedOptions.length} {{ $compactText }}`"></span>
                                        @else
                                            <template x-for="option in selectedOptions"
                                                :key="option.{{ $optionValue }}">
                                                <span class="badge badge-primary badge-sm flex items-center gap-1">
                                                    <span x-text="option.{{ $optionLabel }}"></span>
                                                    <x-dynamic-component :component="$jenPrefix . '::icon'"
                                                        @click="toggle(option.{{ $optionValue }}, true)"
                                                        name="o-x-mark"
                                                        class="h-3 w-3 cursor-pointer" />
                                                </span>
                                            </template>
                                        @endif
                                    </template>

                                    {{-- SINGLE MODE --}}
                                    <template x-if="isSingle && selectedOptions.length > 0">
                                        <span x-text="selectedOptions[0].{{ $optionLabel }}"></span>
                                    </template>
                                </div>
                            </template>

                            {{-- SEARCH INPUT --}}
                            @if ($searchable)
                                <input x-ref="searchInput"
                                    x-model="search"
                                    @input="lookup()"
                                    @keydown.enter.prevent="getFocusableElements()[0]?.focus()"
                                    type="text"
                                    class="input input-ghost w-full min-w-0"
                                    placeholder="Search..." />
                            @else
                                <input x-ref="searchInput" type="hidden" />
                            @endif
                        </div>

                        {{-- CLEAR ICON  --}}
                        @if ($clearable && !$isReadonly && !$isDisabled)
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                @click="reset()"
                                x-show="!isSelectionEmpty"
                                name="o-x-mark"
                                class="h-4 w-4 cursor-pointer opacity-40" />
                        @endif

                        {{-- ICON RIGHT --}}
                        @if ($hasIconRight)
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$iconRight"
                                class="pointer-events-none h-4 w-4 opacity-40" />
                        @endif

                        {{-- SUFFIX --}}
                        @if ($hasSuffix)
                            <span class="label">{{ $suffix }}</span>
                        @endif

                    </label>

                    {{-- APPEND --}}
                    @if ($append)
                        {{ $append }}
                    @endif
                </div>
            </label>

            {{-- ERROR --}}
            @if ($shouldShowError)
                @foreach ($errors->get($errorFieldName()) as $message)
                    @foreach (Arr::wrap($message) as $line)
                        <div class="{{ $errorClass }}">{{ $line }}</div>
                        @break($firstErrorOnly)
                    @endforeach
                    @break($firstErrorOnly)
                @endforeach
            @endif

            {{-- HINT --}}
            @if ($hint)
                <div class="{{ $hintClass }}">{{ $hint }}</div>
            @endif
        </fieldset>

        {{-- OPTIONS LIST --}}
        <div x-cloak
            x-show="focused"
            class="relative"
            wire:key="options-list-main-{{ $uuid }}">
            <div wire:key="options-list-{{ $uuid }}"
                class="{{ $height }} bg-base-100 border-base-content/10 absolute z-10 w-full cursor-pointer overflow-y-auto rounded-lg border shadow-xl"
                x-anchor.bottom-start="$refs.container">
                {{-- SELECT ALL --}}
                @if ($allowAll)
                    <div wire:key="allow-all-{{ rand() }}"
                        class="border-b-base-200 hover:bg-base-200 border border-s-4 font-bold">
                        <div x-show="!isAllSelected"
                            @click="selectAll()"
                            class="decoration-info p-3 underline decoration-wavy">{{ $allowAllText }}</div>
                        <div x-show="isAllSelected"
                            @click="reset()"
                            class="decoration-error p-3 underline decoration-wavy">{{ $removeAllText }}</div>
                    </div>
                @endif

                {{-- NO RESULTS --}}
                <div x-show="noResults"
                    wire:key="no-results-{{ rand() }}"
                    class="decoration-warning border-s-warning border-b-base-200 border border-s-4 p-3 font-bold underline decoration-wavy">
                    {{ $noResultText }}
                </div>

                <div x-ref="choicesOptions">
                    @foreach ($options as $option)
                        <div tabindex="0"
                            wire:key="option-{{ data_get($option, $optionValue) }}"
                            search-value="{{ data_get($option, $optionLabel) }} {{ data_get($option, $optionSubLabel) }}"
                            @click="toggle({{ $getOptionValue($option) }})"
                            @keydown.enter="toggle({{ $getOptionValue($option) }})"
                            @keydown.space.prevent="toggle({{ $getOptionValue($option) }})"
                            :class="isActive({{ $getOptionValue($option) }}) && 'border-l-4 border-l-primary bg-base-200'"
                            class="border-b-base-200 hover:bg-base-200 focus:bg-base-200 flex items-center gap-3 border-b p-3 focus:outline-none">
                            {{-- CUSTOM ITEM SLOT --}}
                            @if ($item)
                                {{ $item($option) }}
                            @else
                                {{-- AVATAR --}}
                                @if ($optionAvatar && data_get($option, $optionAvatar))
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-8 w-8">
                                            <img src="{{ data_get($option, $optionAvatar) }}"
                                                alt="{{ data_get($option, $optionLabel) }}" />
                                        </div>
                                    </div>
                                @endif

                                <div class="flex-1">
                                    {{-- MAIN LABEL --}}
                                    <div class="font-semibold">{{ data_get($option, $optionLabel) }}</div>

                                    {{-- SUB LABEL --}}
                                    @if ($optionSubLabel && data_get($option, $optionSubLabel))
                                        <div class="text-sm opacity-60">{{ data_get($option, $optionSubLabel) }}</div>
                                    @endif
                                </div>

                                {{-- SELECTION INDICATOR --}}
                                <div x-show="isActive({{ $getOptionValue($option) }})">
                                    <x-dynamic-component :component="$jenPrefix . '::icon'"
                                        name="o-check"
                                        class="text-primary h-4 w-4" />
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
