@php
    // Cache method calls for performance
    $isReadonly = $isReadonly();
    $isDisabled = $isDisabled();
    $isRequired = $isRequired();
    $selectClasses = $getSelectClasses();
    $hasError = $hasError();
    $searchFunctionCall = $getSearchFunctionCall();
    $searchTargetName = $getSearchTargetName();

    // Build base attributes
    $containerAttributes = [];
    $fieldsetClasses = ['fieldset py-0'];
    $joinClasses = ['w-full'];

    if ($prepend || $append) {
        $joinClasses[] = 'join';
    }

    $labelClasses = [];
    if ($label && $inline) {
        $labelClasses[] = 'floating-label';
    }
@endphp

<div x-data="{ focused: false, selection: @entangle($attributes->wire('model')) }">
    <div @click.outside="clear()"
        @keyup.esc="clear()"
        x-data="{
            options: {{ json_encode($options) }},
            isSingle: {{ json_encode($single) }},
            isSearchable: {{ json_encode($searchable) }},
            isReadonly: {{ json_encode($isReadonly) }},
            isDisabled: {{ json_encode($isDisabled) }},
            isRequired: {{ json_encode($isRequired) }},
            minChars: {{ $minChars }},
        
            init() {
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
            get noResults() {
                if (!this.isSearchable || this.$refs.searchInput.value == '') {
                    return false
                }
        
                return this.isSingle ?
                    (this.selection && this.options.length == 1) || (!this.selection && this.options.length == 0) :
                    this.options.length <= this.selection.length
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
                this.$refs.searchInput.value = ''
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
                this.$refs.searchInput.style.width = (this.$refs.searchInput.value.length + 1) * 0.55 + 'rem'
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
                } else {
                    this.selection.includes(id) ?
                        this.selection = this.selection.filter(i => i != id) :
                        this.selection.push(id)
                }
        
                this.dispatchChangeEvent({ value: this.selection })
        
                this.$refs.searchInput.value = ''
        
                if (!keepOpen) {
                    this.$refs.searchInput.focus()
                }
            },
            search(value, event) {
                if (value.length < this.minChars) {
                    return
                }
        
                if (event && ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'Shift', 'CapsLock', 'Tab',
                        'Control', 'Alt', 'Home', 'End', 'PageUp', 'PageDown'
                    ].includes(event.key)) {
                    return;
                }
        
                @this.{{ $searchFunctionCall }}.then(() => this.resize())
            },
            dispatchChangeEvent(detail) {
                this.$refs.searchInput.dispatchEvent(new CustomEvent('change-selection', { bubbles: true, detail }))
            }
        }"
        @keydown.up="$focus.previous()"
        @keydown.down="$focus.next()">
        <fieldset wire:key="{{ $uuid }}"
            {{ $attributes->whereDoesntStartWith(['wire:', 'class'])->merge($containerAttributes) }}
            class="{{ implode(' ', $fieldsetClasses) }}">
            {{-- STANDARD LABEL --}}
            @if ($label && !$inline)
                <legend class="fieldset-legend mb-0.5">
                    {{ $label }}

                    @if ($isRequired)
                        <span class="text-error">*</span>
                    @endif
                </legend>
            @endif

            <label class="{{ implode(' ', $labelClasses) }}">
                {{-- FLOATING LABEL --}}
                @if ($label && $inline)
                    <span class="font-semibold">{{ $label }}</span>
                @endif

                <div class="{{ implode(' ', $joinClasses) }}">
                    {{-- PREPEND --}}
                    @if ($prepend)
                        {{ $prepend }}
                    @endif

                    {{-- THE MAIN SELECT CONTAINER --}}
                    <label x-ref="container"
                        @if ($isDisabled) disabled @endif
                        @if (!$isDisabled && !$isReadonly) @click="focus()" @endif
                        {{ $attributes->class($selectClasses . ($hasError ? ' !select-error' : '')) }}>
                        {{-- PREFIX --}}
                        @if ($prefix)
                            <span class="label">{{ $prefix }}</span>
                        @endif

                        {{-- ICON LEFT --}}
                        @if ($icon)
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$icon"
                                class="pointer-events-none h-4 w-4 opacity-40" />
                        @endif

                        <div class="min-h-3 w-full content-center text-wrap py-0.5">
                            {{-- SELECTED OPTIONS --}}
                            <span wire:key="selected-options-{{ $uuid }}">
                                @if ($compact)
                                    <div class="badge badge-soft">
                                        <span class="font-black" x-text="selectedOptions.length"></span>
                                        {{ $compactText }}
                                    </div>
                                @else
                                    <template x-for="(option, index) in selectedOptions" :key="index">
                                        <span
                                            class="jen-choices-element badge badge-soft m-0.5 !inline-block !h-auto cursor-pointer">
                                            {{-- SELECTION SLOT --}}
                                            @if ($selection)
                                                <span
                                                    x-html="document.getElementById('selection-{{ $uuid }}-' + option.{{ $optionValue }}).innerHTML"></span>
                                            @else
                                                <span x-text="option?.{{ $optionLabel }}"></span>
                                            @endif

                                            @if (!$isDisabled && !$isReadonly)
                                                <x-dynamic-component :component="$jenPrefix . '::icon'"
                                                    @click="toggle(option.{{ $optionValue }})"
                                                    x-show="!isReadonly && !isDisabled && !isSingle"
                                                    name="o-x-mark"
                                                    class="hover:text-error h-4 w-4" />
                                            @endif
                                        </span>
                                    </template>
                                @endif
                            </span>

                            {{-- PLACEHOLDER --}}
                            <span :class="(focused || !isSelectionEmpty) && 'hidden'" class="text-base-content/40">
                                {{ $attributes->get('placeholder') }}
                            </span>

                            {{-- INPUT SEARCH --}}
                            <input x-ref="searchInput"
                                @input="focus(); resize();"
                                @keydown.arrow-down.prevent="focus()"
                                :required="isRequired && isSelectionEmpty"
                                class="outline-hidden !inline-block w-1"
                                {{ $attributes->whereStartsWith('@') }}
                                @if ($isReadonly || $isDisabled || !$searchable) readonly @endif
                                @if ($isDisabled) disabled @endif
                                @if (!$isReadonly && !$isDisabled) @focus="focus()" @endif
                                @if ($searchable) @keydown.debounce.{{ $debounce }}="search($el.value, $event)" @endif />
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
                        @if ($iconRight)
                            <x-dynamic-component :component="$jenPrefix . '::icon'"
                                :name="$iconRight"
                                class="pointer-events-none h-4 w-4 opacity-40" />
                        @endif

                        {{-- SUFFIX --}}
                        @if ($suffix)
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
            @if (!$omitError && $errors->has($errorFieldName()))
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
                {{-- PROGRESS --}}
                <progress wire:loading
                    wire:target="{{ $searchTargetName }}"
                    class="progress absolute top-0 h-0.5"></progress>

                {{-- SELECT ALL --}}
                @if ($allowAll)
                    <div wire:key="allow-all-{{ rand() }}"
                        class="border-s-base-content/10 border-base-200 hover:bg-base-200 border border-s-4 font-bold">
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

                @foreach ($options as $option)
                    <div wire:key="option-{{ data_get($option, $optionValue) }}"
                        @click="toggle({{ $getOptionValue($option) }}, true)"
                        @keydown.enter="toggle({{ $getOptionValue($option) }}, true)"
                        :class="isActive({{ $getOptionValue($option) }}) && 'border-s-4 border-s-base-content'"
                        class="border-base-content/10 focus:bg-base-200 border-s-4 focus:outline-none"
                        tabindex="0">
                        {{-- ITEM SLOT --}}
                        @if ($item)
                            {{ $item($option) }}
                        @else
                            <div class="p-3">
                                <div class="flex items-center gap-3">
                                    {{-- AVATAR --}}
                                    @if ($optionAvatar && data_get($option, $optionAvatar))
                                        <img src="{{ data_get($option, $optionAvatar) }}"
                                            class="h-8 w-8 rounded-full"
                                            alt="{{ data_get($option, $optionLabel) }}" />
                                    @endif

                                    <div>
                                        {{-- MAIN LABEL --}}
                                        <div class="font-medium">{{ data_get($option, $optionLabel) }}</div>

                                        {{-- SUB LABEL --}}
                                        @if ($optionSubLabel && data_get($option, $optionSubLabel))
                                            <div class="text-base-content/60 text-sm">
                                                {{ data_get($option, $optionSubLabel) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- SELECTION SLOT --}}
                        @if ($selection)
                            <span id="selection-{{ $uuid }}-{{ data_get($option, $optionValue) }}"
                                class="hidden">
                                {{ $selection($option) }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
