<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Markdown extends Component
{
    public string $uuid;
    public string $uploadUrl;

    public function __construct(
        public ?string $id = null,
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $hintClass = 'fieldset-label',
        public ?string $disk = 'public',
        public ?string $folder = 'markdown',
        public ?array $config = [],

        // Validations
        public ?string $errorField = null,
        public ?string $errorClass = 'text-error',
        public ?bool $omitError = false,
        public ?bool $firstErrorOnly = false,
    ) {
        $this->uuid = 'jen-markdown-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
        $this->uploadUrl = route('jen.upload', absolute: false);
    }

    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function errorFieldName(): ?string
    {
        return $this->errorField ?? $this->modelName();
    }

    public function hasLabel(): bool
    {
        return (bool) $this->label;
    }

    public function hasHint(): bool
    {
        return (bool) $this->hint;
    }

    public function getFieldsetClasses(): string
    {
        return 'fieldset py-0';
    }

    public function getLegendClasses(): string
    {
        return 'fieldset-legend mb-0.5';
    }

    public function getEditorAttributes(): array
    {
        $attributes = [];

        if ($this->id) {
            $attributes['id'] = $this->id;
        }

        return $attributes;
    }

    public function setup(): string
    {
        $setup = array_merge([
            'spellChecker' => false,
            'autoSave' => false,
            'uploadImage' => true,
            'imageAccept' => 'image/png, image/jpeg, image/gif, image/avif',
            'toolbar' => [
                'heading',
                'bold',
                'italic',
                'strikethrough',
                '|',
                'code',
                'quote',
                'unordered-list',
                'ordered-list',
                'horizontal-rule',
                '|',
                'link',
                'upload-image',
                'table',
                '|',
                'preview',
                'side-by-side'
            ],
        ], $this->config);

        // Table default CSS class `.table` breaks the layout.
        // Here is a workaround
        $table = "{ 'title' : 'Table', 'name' : 'myTable', 'action' : EasyMDE.drawTable, 'className' : 'fa fa-table' }";

        return str(json_encode($setup))
            ->replace("\"", "'")
            ->trim('{}')
            ->replace("'table'", $table)
            ->toString();
    }

    public function render(): View|Closure|string
    {
        return view('jen::markdown');
    }
}
