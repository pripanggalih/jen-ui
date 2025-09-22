@php
    // Cache method calls for performance
    $hasAppend = $hasAppend();
    $modalId = $getModalId();
    $modalClasses = $getModalClasses();
    $modalBoxClasses = $getModalBoxClasses();
    $inputClasses = $getInputClasses();
    $noResultsClasses = $getNoResultsClasses();
    $resultItemClasses = $getResultItemClasses();
    $resultContentClasses = $getResultContentClasses();

    // Build base attributes for main container
    $baseAttributes = [];
@endphp

<div wire:key="{{ $uuid }}"
    {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
    {{ $attributes->class('') }}
    x-data="{
        value: '',
        results: [],
        open: $persist(false).as('jen-spotlight-modal'),
        elapsed: 0,
        elapsedStep: 200,
        elapsedMax: 500,
        maxDebounce: 250,
        searchTimer: null,
        debounceTimer: null,
        controller: new AbortController(),
        query: '',
        searchedWithNoResults: false,
        init() {
            if (this.open) {
                this.show()
            }
    
            this.$watch('value', value => this.debounce(() => this.search(), this.maxDebounce))
    
            // Fix weird issue when navigating back
            document.addEventListener('livewire:navigating', () => {
                this.close()
                document.querySelectorAll('.jen-spotlight-element')?.forEach(el => el.remove());
            });
        },
        close() {
            this.open = false
            $refs.jenSpotlightRef?.close()
        },
        show() {
            this.open = true;
            $refs.jenSpotlightRef.showModal();
        },
        focus() {
            setTimeout(() => {
                this.$refs.spotSearch.focus();
                this.$refs.spotSearch.select();
            }, 100)
        },
        updateQuery(query) {
            this.query = query
            this.search()
        },
        startTimer() {
            this.searchTimer = setInterval(() => this.elapsed += this.elapsedStep, this.elapsedStep)
        },
        resetTimer() {
            clearInterval(this.searchTimer)
            this.elapsed = 0
        },
        debounce(fn, waitTime) {
            clearTimeout(this.debounceTimer)
            this.debounceTimer = setTimeout(() => fn(), waitTime)
        },
        async search() {
            $refs.spotSearch.focus()
    
            if (this.value == '') {
                this.results = []
                return
            }
    
            this.resetTimer()
            this.startTimer()
    
            try {
                this.controller?.abort()
                this.controller = new AbortController();
    
                let response = await fetch(`{{ $url }}?search=${this.value}&${this.query}`, { signal: this.controller.signal })
                this.results = await response.json()
            } catch (e) {
                console.log(e)
                return
            }
    
            this.resetTimer()
    
            Object.keys(this.results).length ?
                this.searchedWithNoResults = false :
                this.searchedWithNoResults = true
        }
    }"
    @keydown.window.prevent.{{ $shortcut }}="show(); focus();"
    @keydown.escape="close()"
    @keydown.up="$focus.previous()"
    @keydown.down="$focus.next()"
    @mary-search.window="updateQuery(event.detail)"
    @mary-search-open.window="show(); focus();">
    {{-- Modal Component with Dynamic Prefix --}}
    <x-dynamic-component :component="$jenPrefix . '::modal'"
        :id="$modalId"
        x-ref="jenSpotlightRef"
        :class="$modalClasses"
        :box-class="$modalBoxClasses">
        <div @click.outside="close()">
            {{-- INPUT --}}
            <div class="flex">
                <div class="flex-1">
                    <div class="flex items-center">
                        {{-- Icon with Dynamic Prefix --}}
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            name="o-magnifying-glass"
                            class="opacity-40" />
                        <input id="{{ $uuid }}"
                            x-model="value"
                            x-ref="spotSearch"
                            placeholder=" {{ $searchText }}"
                            class="{{ $inputClasses }}"
                            @focus="$el.focus()"
                            autofocus
                            tabindex="1" />
                    </div>
                </div>

                @if ($hasAppend)
                    {{ $append }}
                @endif
            </div>

            {{-- PROGRESS --}}
            <div class="h-[1px]">
                <progress class="progress hidden h-[1px]" :class="elapsed > elapsedMax && '!h-[2px] !block'"></progress>
            </div>

            {{-- SLOT --}}
            @if ($slot)
                {{ $slot }}
            @endif

            {{-- NO RESULTS --}}
            <template x-if="searchedWithNoResults && value != ''">
                <div class="{{ $noResultsClasses }}">{{ $noResultsText }}</div>
            </template>

            {{-- RESULTS --}}
            <div class="-mx-1 mt-1"
                @click="close()"
                @keydown.enter="close()">
                <template x-for="(item, index) in results" :key="index">
                    {{-- ITEM --}}
                    <a x-bind:href="item.link"
                        class="{{ $resultItemClasses }}"
                        wire:navigate
                        tabindex="0">
                        <div class="{{ $resultContentClasses }}">
                            <div class="flex items-center gap-3">
                                {{-- ICON --}}
                                <template x-if="item.icon">
                                    <div x-html="item.icon"></div>
                                </template>
                                {{-- AVATAR --}}
                                <template x-if="item.avatar && !item.icon">
                                    <div>
                                        <img :src="item.avatar"
                                            class="h-11 w-11 rounded-full"
                                            @if ($fallbackAvatar) onerror="this.src='{{ $fallbackAvatar }}'" @endif />
                                    </div>
                                </template>
                                <div
                                    class="jen-hideable w-0 flex-1 overflow-hidden truncate text-ellipsis whitespace-nowrap">
                                    {{-- NAME --}}
                                    <div x-text="item.name" class="truncate font-semibold"></div>

                                    {{-- DESCRIPTION --}}
                                    <template x-if="item.description">
                                        <div x-text="item.description" class="text-base-content/50 truncate text-sm">
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </a>
                </template>
                <div x-show="results.length" class="mb-3"></div>
            </div>
        </div>
    </x-dynamic-component>
</div>
