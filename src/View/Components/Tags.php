<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Tags extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $hintClass = 'fieldset-label',
        public ?string $icon = null,
        public ?string $iconRight = null,
        public ?bool $inline = false,
        public ?bool $clearable = false,
        public ?string $prefix = null,
        public ?string $suffix = null,

        // Slots
        public mixed $prepend = null,
        public mixed $append = null,

        // Validations
        public ?string $errorField = null,
        public ?string $errorClass = 'text-error',
        public ?bool $omitError = false,
        public ?bool $firstErrorOnly = false,
    ) {
        $this->uuid = 'tags-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
    }

    // Get the model name from wire:model attribute
    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    // Get the error field name (errorField takes priority over modelName)
    public function errorFieldName(): ?string
    {
        return $this->errorField ?? $this->modelName();
    }

    // Check if component is readonly
    public function isReadonly(): bool
    {
        return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
    }

    // Check if component is disabled
    public function isDisabled(): bool
    {
        return $this->attributes->has('disabled') && $this->attributes->get('disabled') == true;
    }

    // Check if component is required
    public function isRequired(): bool
    {
        return $this->attributes->has('required') && $this->attributes->get('required') == true;
    }

    // Get fieldset classes for the container
    public function getFieldsetClasses(): string
    {
        return 'fieldset py-0';
    }

    // Get input label classes based on inline property
    public function getLabelClasses(): string
    {
        $classes = [];

        if ($this->label && $this->inline) {
            $classes[] = 'floating-label';
        }

        return implode(' ', $classes);
    }

    // Get main input classes with conditional styling
    public function getInputClasses(): string
    {
        $classes = [
            'input',
            'w-full',
            'h-fit',
            'pl-2.5',
        ];

        if ($this->prepend || $this->append) {
            $classes[] = 'join-item';
        }

        if ($this->isReadonly()) {
            $classes[] = 'border-dashed';
        }

        return implode(' ', $classes);
    }

    // Get container wrapper classes based on prepend/append
    public function getContainerClasses(): string
    {
        $classes = ['w-full'];

        if ($this->prepend || $this->append) {
            $classes[] = 'join';
        }

        return implode(' ', $classes);
    }

    // Get placeholder text from attributes
    public function getPlaceholder(): ?string
    {
        return $this->attributes->get('placeholder');
    }

    public function render(): View|Closure|string
    {
        return view('jen::tags');
    }
}
