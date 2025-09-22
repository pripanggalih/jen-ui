@php
    // Cache method calls in template for performance
    $hasModel = $hasModel();
    $shouldShowError = $shouldShowError();
    $containerClasses = $getContainerClasses();
    $canvasClasses = $getCanvasClasses();
    $clearButtonClasses = $getClearButtonClasses();
    $setupConfig = $setup();
    $errorFieldName = $errorFieldName();

    // Build attributes for container
    $containerAttributes = [];

    // Add error class if has validation errors
    if ($hasModel && $errors->has($modelName())) {
        $containerAttributes['class'] = '!border-error';
    }
@endphp

<div>
    <div x-data="{
        value: @if ($hasModel) @entangle($attributes->wire('model')) @else null @endif,
        signature: null,
        init() {
            let canvas = document.getElementById('{{ $uuid }}')
            this.signature = new SignaturePad(canvas, {{ $setupConfig }});
    
            // Resize canvas for high DPI displays
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            this.signature.fromData(this.signature.toData());
    
            // Event listener for signature changes
            this.signature.addEventListener('endStroke', () => this.extract());
        },
        extract() {
            this.value = this.signature.toDataURL();
        },
        clear() {
            this.signature.clear();
            this.value = null;
        }
    }"
        wire:ignore
        class="block touch-none select-none">

        <div {{ $attributes->except('wire:model')->class($containerClasses)->merge($containerAttributes) }}>
            <canvas id="{{ $uuid }}"
                height="{{ $height }}"
                class="{{ $canvasClasses }}">
            </canvas>

            {{-- Clear Button --}}
            <div class="absolute end-2 top-1/2 -translate-y-1/2">
                <x-dynamic-component :component="$jenPrefix . '::button'"
                    icon="o-backspace"
                    :label="$clearText"
                    @click="clear"
                    :class="$clearButtonClasses" />
            </div>
        </div>
    </div>

    {{-- ERROR MESSAGES --}}
    @if ($shouldShowError && $errors->has($errorFieldName))
        @foreach ($errors->get($errorFieldName) as $message)
            @foreach (Arr::wrap($message) as $line)
                <div class="{{ $errorClass }}">{{ $line }}</div>
                @break($firstErrorOnly)
            @endforeach
            @break($firstErrorOnly)
        @endforeach
    @endif

    {{-- HINT TEXT --}}
    @if ($hint)
        <div class="{{ $hintClass }}">{{ $hint }}</div>
    @endif
</div>
