@php
    // Cache method calls for performance
    $isReadonly = $isReadonly();
    $isDisabled = $isDisabled();
    $isRequired = $isRequired();
    $fieldsetClasses = $getFieldsetClasses();
    $labelClasses = $getLabelClasses();
    $inputClasses = $getInputClasses();
    $containerClasses = $getContainerClasses();
    $placeholder = $getPlaceholder();
    $errorFieldName = $errorFieldName();

    // Build base attributes for the main input
    $inputAttributes = [];

    if ($isDisabled) {
        $inputAttributes['disabled'] = true;
    }
@endphp

<div x-data="{
    tags: @entangle($attributes->wire('model')),
    tag: null,
    focused: false,
    isReadonly: {{ json_encode($isReadonly) }},
    isRequired: {{ json_encode($isRequired) }},
    isDisabled: {{ json_encode($isDisabled) }},

    init() {
        if (this.tags == null || !Array.isArray(this.tags)) {
            this.tags = [];
        }

        // Fix weird issue when navigating back
        document.addEventListener('livewire:navigating', () => {
            let elements = document.querySelectorAll('.jen-tags-element');
            elements.forEach(el => el.remove());
        });
    },
    push() {
        if (this.tag != '' && this.tag != null && this.tag != undefined) {
            let tag = this.tag.toString().replace(/,/g, '').trim()

            if (tag != '' && !this.hasTag(tag)) {
                this.tags.push(tag)
            }
        }

        this.clear()
    },

    hasTag(tag) {
        var tag = this.tags.find(e => {
            e = e.toString();
            return e.toLowerCase() === tag.toLowerCase()
        })
        return tag != undefined
    },

    remove(index) {
        this.tags.splice(index, 1)
    },

    clear() {
        this.tag = null;
        this.focused = false;
    },

    clearAll() {
        this.tags = [];
    },

    focus() {
        if (this.isReadonly || this.isDisabled) {
            return
        }

        this.focused = true
        $refs.searchInput.focus()
    },

    resize() {
        $refs.searchInput.style.width = ($refs.searchInput.value.length + 1) * 0.55 + 'rem'
    }
}" @keydown.escape="clear()">
    <fieldset class="{{ $fieldsetClasses }}">
        {{-- STANDARD LABEL --}}
        @if ($label && !$inline)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label @class([$labelClasses])>
            {{-- FLOATING LABEL --}}
            @if ($label && $inline)
                <span class="font-semibold">{{ $label }}</span>
            @endif

            <div class="{{ $containerClasses }}">
                {{-- PREPEND --}}
                @if ($prepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label @click="focus()"
                    {{ $attributes->whereDoesntStartWith('class')->whereDoesntStartWith('wire:')->merge($inputAttributes)->class([$inputClasses, '!input-error' => $errorFieldName && $errors->has($errorFieldName) && !$omitError]) }}>
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

                    <div class="min-h-9.5 w-full content-center text-wrap py-1">
                        {{-- TAGS --}}
                        <span wire:key="tags-{{ $uuid }}">
                            <template :key="index" x-for="(tag, index) in tags">
                                <span class="jen-tags-element badge badge-soft m-0.5 !inline-block cursor-pointer">
                                    <span x-text="tag"></span>
                                    <x-dynamic-component :component="$jenPrefix . '::icon'"
                                        @click="remove(index)"
                                        x-show="!isReadonly && !isDisabled"
                                        name="o-x-mark"
                                        class="hover:text-error mb-0.5 h-4 w-4" />
                                </span>
                            </template>
                        </span>

                        {{-- PLACEHOLDER --}}
                        <span :class="(focused || tags.length) && 'hidden'" class="text-base-content/40">
                            {{ $placeholder }}
                        </span>

                        {{-- INPUT --}}
                        <input id="{{ $uuid }}"
                            type="text"
                            enterkeyhint="done"
                            class="!inline-block w-1"
                            x-ref="searchInput"
                            :required="isRequired"
                            :readonly="isReadonly"
                            :disabled="isDisabled"
                            x-model="tag"
                            @input="focus(); resize();"
                            @focus="focus()"
                            @click.outside="clear()"
                            @keydown.enter.prevent="push()"
                            @keyup.prevent="if (event.key === ',') { push() }" />
                    </div>

                    {{-- CLEAR ICON  --}}
                    @if ($clearable && !$isReadonly && !$isDisabled)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            @click="clearAll()"
                            x-show="tags.length"
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
        @if (!$omitError && $errorFieldName && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
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
</div>
