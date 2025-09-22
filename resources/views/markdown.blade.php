@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $fieldsetClasses = $getFieldsetClasses();
    $legendClasses = $getLegendClasses();
    $editorAttributes = $getEditorAttributes();
    $setupConfig = $setup();
    $isRequired = $attributes->get('required');
@endphp

<div>
    <fieldset class="{{ $fieldsetClasses }}">
        {{-- STANDARD LABEL --}}
        @if ($hasLabel)
            <legend class="{{ $legendClasses }}">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        {{-- EDITOR --}}
        <div x-data="{
            editor: null,
            value: @entangle($attributes->wire('model')),
            uploadUrl: '{{ $uploadUrl }}?disk={{ $disk }}&folder={{ $folder }}&_token={{ csrf_token() }}',
            uploading: false,
            init() {
                this.initEditor()
        
                // Handles a case where people try to change contents on the fly from Livewire methods
                this.$watch('value', (newValue) => {
                    if (newValue !== this.editor.value()) {
                        this.value = newValue || ''
                        this.destroyEditor()
                        this.initEditor()
                    }
                })
            },
            destroyEditor() {
                this.editor.toTextArea();
                this.editor = null
            },
            initEditor() {
                this.editor = new EasyMDE({
                    {{ $setupConfig }},
                    element: $refs.markdown{{ $uuid }},
                    initialValue: this.value ?? '',
                    imageUploadFunction: (file, onSuccess, onError) => {
                        if (file.type.split('/')[0] !== 'image') {
                            return onError('File must be an image.');
                        }
        
                        var data = new FormData()
                        data.append('file', file)
        
                        this.uploading = true
        
                        fetch(this.uploadUrl, { method: 'POST', body: data })
                            .then(response => response.json())
                            .then(data => onSuccess(data.location))
                            .catch((err) => onError('Error uploading image!'))
                            .finally(() => this.uploading = false)
                    }
                })
        
                this.editor.codemirror.on('change', () => this.value = this.editor.value())
            }
        }"
            wire:ignore
            x-on:livewire:navigating.window="destroyEditor()">
            <div class="disabled relative text-base" :class="uploading && 'pointer-events-none opacity-50'">
                <textarea wire:key="{{ $uuid }}"
                    x-ref="markdown{{ $uuid }}"
                    {{ $attributes->whereDoesntStartWith(['wire:', 'class', 'x-', 'alpine'])->merge($editorAttributes) }}></textarea>

                <div class="absolute start-1/2 top-1/2 hidden text-center !opacity-100" :class="uploading && '!block'">
                    <div>Uploading</div>
                    <div class="loading loading-dots"></div>
                </div>
            </div>
        </div>

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
        @if ($hasHint)
            <div class="{{ $hintClass }}">{{ $hint }}</div>
        @endif
    </fieldset>
</div>
