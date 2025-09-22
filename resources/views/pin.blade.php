@php
    // Cache method calls for performance
    $containerClasses = $getContainerClasses();
    $inputClasses = $getInputClasses();
    $securityStyles = $getSecurityStyles();
    $hasErrors = $hasErrors();
    $errorFieldName = $errorFieldName();

    // Convert security styles to CSS string
    $securityStyleString = '';
    foreach ($securityStyles as $property => $value) {
        $securityStyleString .= "{$property}: {$value}; ";
    }
@endphp

<div>
    <div x-data="{
        value: @entangle($attributes->wire('model')),
        inputs: [],
        init() {
            // Copy & Paste support
            document.getElementById('pin{{ $uuid }}').addEventListener('paste', (e) => {
                const paste = (e.clipboardData || window.clipboardData).getData('text');
    
                for (var i = 0; i < {{ $size }}; i++) {
                    this.inputs[i] = paste[i];
                }
    
                e.preventDefault()
                this.handlePin()
            })
        },
        next(el) {
            this.handlePin()
    
            if (el.value.length == 0) {
                return
            }
    
            if (el.nextElementSibling) {
                el.nextElementSibling.focus()
                el.nextElementSibling.select()
            }
        },
        remove(el, i) {
            this.inputs[i] = ''
            this.handlePin()
    
            if (el.previousElementSibling) {
                el.previousElementSibling.focus()
                el.previousElementSibling.select()
            }
        },
        handlePin() {
            this.value = this.inputs.join('')
    
            this.value.length === {{ $size }} ?
                this.$dispatch('completed', this.value) :
                this.$dispatch('incomplete', this.value)
        }
    }">

        <div class="{{ $containerClasses }}" id="pin{{ $uuid }}">
            @foreach (range(0, $size - 1) as $i)
                @php
                    $inputAttributes = $getInputAttributes($i);
                    $baseAttributes = [];

                    // Add security styles if hiding is enabled
                    if ($securityStyleString) {
                        $baseAttributes['style'] = $securityStyleString;
                    }

                    // Add keyboard event handlers
                    $baseAttributes['@keydown.space.prevent'] = '';
                    $baseAttributes['@keydown.backspace.prevent'] = "remove(\$event.target, {$i})";
                    $baseAttributes['@input'] = 'next($event.target)';
                @endphp

                <input
                    {{ $attributes->whereDoesntStartWith(['wire', 'class'])->merge(array_merge($inputAttributes, $baseAttributes)) }}
                    {{ $attributes->class($inputClasses) }} />
            @endforeach
        </div>

        {{-- ERROR DISPLAY --}}
        @if ($hasErrors)
            @php
                $errors = session()->get('errors');
                $fieldErrors = $errors ? $errors->get($errorFieldName) : [];
            @endphp

            @foreach ($fieldErrors as $message)
                @foreach ((array) $message as $line)
                    <div class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif
    </div>
</div>
