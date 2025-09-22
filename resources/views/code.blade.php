@php
    // Cache method calls for performance
    $hasLabel = $hasLabel();
    $hasHint = $hasHint();
    $modelName = $modelName();
    $containerClasses = $getContainerClasses();
    $editorConfig = $getEditorConfig();

    // Build base attributes
    $baseAttributes = [];
    if ($id) {
        $baseAttributes['id'] = $id;
    }
@endphp

<div>
    @if ($hasLabel)
        <div class="mb-3 mt-5 text-xs font-semibold">{{ $label }}</div>
    @endif

    <div wire:key="{{ $uuid }}" {{ $attributes->whereStartsWith('class')->class($containerClasses) }}>
        <div wire:ignore
            x-data="{
                editor: null,
                modelValue: @entangle($attributes->wire('model')),
                class: $persist(window.matchMedia('(prefers-color-scheme: dark)').matches ? '{{ $editorConfig['darkClass'] }}' : '{{ $editorConfig['lightClass'] }}').as('jen-code-class'),
                init() {
                    ace.require('ace/ext/language_tools');
                    this.editor = ace.edit($refs.editor);
            
                    // Basic Settings
                    this.editor.session.setMode('ace/mode/{{ $editorConfig['language'] }}');
                    this.editor.setShowPrintMargin({{ json_encode($editorConfig['printMargin']) }});
                    this.editor.container.style.lineHeight = {{ $editorConfig['lineHeight'] }};
                    this.editor.renderer.setScrollMargin(10, 10);
            
                    // Initial theme
                    (this.class == '{{ $editorConfig['darkClass'] }}') ?
                    this.editor.setTheme('ace/theme/{{ $editorConfig['darkTheme'] }}'): this.editor.setTheme('ace/theme/{{ $editorConfig['lightTheme'] }}');
            
                    // More settings
                    this.editor.setOptions({
                        enableBasicAutocompletion: true,
                        enableLiveAutocompletion: true,
                        enableSnippets: true,
                    });
            
                    // Initial value
                    this.editor.setValue(this.modelValue || '', -1);
            
                    // Update value on change
                    this.editor.session.on('change', () => {
                        this.modelValue = this.editor.getValue();
                    });
            
                    // Watch for model changes
                    this.$watch('modelValue', value => {
                        if (this.editor.getValue() !== value) {
                            this.editor.setValue(value || '', -1);
                        }
                    });
            
                    // Watch for theme changes
                    window.addEventListener('theme-changed-class', e => {
                        (e.detail == 'dark') ?
                        this.editor.setTheme('ace/theme/{{ $editorConfig['darkTheme'] }}'): this.editor.setTheme('ace/theme/{{ $editorConfig['lightTheme'] }}');
                    })
                }
            }"
            x-init="init()">
            <div x-ref="editor"
                style="width: 100%; height: {{ $editorConfig['height'] }}"
                {{ $attributes->whereDoesntStartWith(['class', 'wire:model'])->merge($baseAttributes) }}>
            </div>
        </div>
    </div>

    @if ($modelName && $errors->has($modelName))
        <div class="text-error mt-3 text-xs">{{ $errors->first($modelName) }}</div>
    @endif

    @if ($hasHint)
        <div class="text-base-content/50 mt-2 text-xs">{{ $hint }}</div>
    @endif
</div>
