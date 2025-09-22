@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $shouldShowError = $shouldShowError();
    $isRequired = $isRequired();
    $isDisabled = $isDisabled();
    $isReadonly = $isReadonly();
    $setupConfig = $getSetupConfig();
    $uploadUrl = $getUploadUrl();
    $contentStyle = $getContentStyle();
    $modelName = $modelName();
    $errorFieldName = $errorFieldName();

    // We need this extra step to support models arrays. Ex: wire:model="emails.0", wire:model="emails.1"
    $finalUuid = $uuid . $modelName;

    // Build base attributes for Laravel native merge
    $baseAttributes = [
        'id' => $id ?? $finalUuid,
        'type' => 'textarea',
    ];
@endphp

<div>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($hasLabel)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        {{-- EDITOR --}}
        <div x-data="{
            value: @entangle($attributes->wire('model')),
            uploadUrl: '{{ $uploadUrl }}'
        }"
            x-init="tinymce.init({
                {{ $setupConfig }},
            
                @if($gplLicense)
                license_key: 'gpl',
                @endif
            
                target: $refs.tinymce,
                images_upload_url: uploadUrl,
                readonly: {{ json_encode($isReadonly || $isDisabled) }},
                skin: document.documentElement.getAttribute('class') == 'dark' ? 'oxide-dark' : 'oxide',
                content_css: document.documentElement.getAttribute('class') == 'dark' ? 'dark' : 'default',
                content_style: '{{ $contentStyle }}',
            
                setup: function(editor) {
                    editor.on('keyup', (e) => value = editor.getContent())
                    editor.on('change', (e) => value = editor.getContent())
                    editor.on('undo', (e) => value = editor.getContent())
                    editor.on('redo', (e) => value = editor.getContent())
                    editor.on('init', () => editor.setContent(value ?? ''))
                    editor.on('OpenWindow', (e) => tinymce.activeEditor.topLevelWindow = e.dialog)
            
                    // Handles a case where people try to change contents on the fly from Livewire methods
                    $watch('value', function(newValue) {
                        if (newValue !== editor.getContent()) {
                            editor.resetContent(newValue || '');
                        }
                    })
                },
                file_picker_callback: function(cb, value, meta) {
                    const formData = new FormData()
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.click();
            
                    tinymce.activeEditor.topLevelWindow.block('');
            
                    input.addEventListener('change', (e) => {
                        formData.append('file', e.target.files[0])
                        formData.append('_token', '{{ csrf_token() }}')
            
                        fetch(uploadUrl, { method: 'POST', body: formData })
                            .then(response => response.json())
                            .then(data => cb(data.location))
                            .catch((err) => console.error(err))
                            .finally(() => tinymce.activeEditor.topLevelWindow.unblock());
                    });
                }
            })"
            x-on:livewire:navigating.window="tinymce.activeEditor.destroy();"
            wire:ignore>
            <input x-ref="tinymce" {{ $attributes->whereDoesntStartWith('wire:model')->merge($baseAttributes) }} />
        </div>

        {{-- ERROR --}}
        @if ($shouldShowError && $errors->has($errorFieldName))
            @foreach ($errors->get($errorFieldName) as $message)
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
