@php
    // Cache method calls once per render for performance
    $toggleClasses = $getToggleClasses();
    $alpineData = $getAlpineData();

    // Build attributes array for Laravel's native merge
$baseAttributes = [
    'x-data' =>
        '{
                theme: ' .
        $alpineData['theme'] .
        ',
                class: ' .
        $alpineData['class'] .
        ',
                init() {
                    if (this.theme == \'' .
            $darkTheme .
            '\') {
                    this.$refs.sun.classList.add(\'swap-off\');
                    this.$refs.sun.classList.remove(\'swap-on\');
                    this.$refs.moon.classList.add(\'swap-on\');
                    this.$refs.moon.classList.remove(\'swap-off\');
                }
                this.setToggle()
            },
            setToggle() {
                document.documentElement.setAttribute(\'data-theme\', this.theme)
                document.documentElement.setAttribute(\'class\', this.class)
                this.$dispatch(\'theme-changed\', this.theme)
                this.$dispatch(\'theme-changed-class\', this.class)
            },
            toggle() {
                this.theme = this.theme == \'' .
            $lightTheme .
            '\' ? \'' .
            $darkTheme .
            '\' : \'' .
            $lightTheme .
            '\'
                this.class = this.theme == \'' .
            $lightTheme .
            '\' ? \'' .
            $lightClass .
            '\' : \'' .
            $darkClass .
            '\'
                this.setToggle()
            }
        }',
        '@jen-toggle-theme.window' => 'toggle()',
        'for' => $uuid,
    ];
@endphp

<div wire:key="{{ $uuid }}">
    <label {{ $attributes->whereDoesntStartWith('class')->merge($baseAttributes) }}
        {{ $attributes->class($toggleClasses) }}>

        <input id="{{ $uuid }}"
            type="checkbox"
            class="theme-controller opacity-0"
            @click="toggle()"
            :value="theme"
            @if ($value) value="{{ $value }}" @endif />

        {{-- Sun Icon (Light Mode) --}}
        <x-dynamic-component :component="$jenPrefix . '::icon'"
            name="o-sun"
            x-ref="sun"
            class="swap-on" />

        {{-- Moon Icon (Dark Mode) --}}
        <x-dynamic-component :component="$jenPrefix . '::icon'"
            name="o-moon"
            x-ref="moon"
            class="swap-off" />

        {{-- Optional Labels --}}
        @if ($withLabel)
            <span x-show="theme == '{{ $lightTheme }}'" class="ml-2">{{ $light }}</span>
            <span x-show="theme == '{{ $darkTheme }}'" class="ml-2">{{ $dark }}</span>
        @endif
    </label>
</div>

{{-- Initialize theme on page load --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('jen-theme')?.replaceAll('"', '');
        const savedClass = localStorage.getItem('jen-class')?.replaceAll('"', '');

        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        }

        if (savedClass) {
            document.documentElement.setAttribute('class', savedClass);
        }
    });
</script>
