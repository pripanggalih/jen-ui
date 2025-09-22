<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Select extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $iconRight = null,
        public ?string $hint = null,
        public ?string $hintClass = 'fieldset-label',
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?string $placeholder = null,
        public ?string $placeholderValue = null,
        public ?bool $inline = false,
        public ?string $optionValue = 'id',
        public ?string $optionLabel = 'name',
        public Collection|array $options = new Collection(),

        // Slots
        public mixed $prepend = null,
        public mixed $append = null,

        // Validations
        public ?string $errorField = null,
        public ?string $errorClass = 'text-error',
        public ?bool $omitError = false,
        public ?bool $firstErrorOnly = false,
    ) {
        $this->uuid = 'jen-select-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
    }

    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function errorFieldName(): ?string
    {
        return $this->errorField ?? $this->modelName();
    }

    public function hasJoinItems(): bool
    {
        return (bool) ($this->prepend || $this->append);
    }

    public function isReadonly(): bool
    {
        return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
    }

    public function getSelectClasses(): string
    {
        $classes = ['select', 'w-full'];

        if ($this->hasJoinItems()) {
            $classes[] = 'join-item';
        }

        if ($this->isReadonly()) {
            $classes[] = 'border-dashed';
        }

        return implode(' ', $classes);
    }

    public function getContainerClasses(): string
    {
        $classes = ['w-full'];

        if ($this->hasJoinItems()) {
            $classes[] = 'join';
        }

        return implode(' ', $classes);
    }

    public function getFloatingLabelClasses(): string
    {
        $classes = [];

        if ($this->label && $this->inline) {
            $classes[] = 'floating-label';
        }

        return implode(' ', $classes);
    }

    public function render(): View|Closure|string
    {
        return view('jen::select');
    }
}
