<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
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
        public ?bool $inline = false,
        public ?bool $clearable = false,
        public ?bool $money = false,
        public ?string $locale = 'en-US',

        // Slots
        public mixed $prepend = null,
        public mixed $append = null,

        // Validations
        public ?string $errorField = null,
        public ?string $errorClass = 'text-error',
        public ?bool $omitError = false,
        public ?bool $firstErrorOnly = false,
    ) {
        $this->uuid = 'input-' . Str::random(8) . ($id ? "-{$id}" : '');
    }

    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function errorFieldName(): ?string
    {
        return $this->errorField ?? $this->modelName();
    }

    public function isReadonly(): bool
    {
        return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
    }

    public function isDisabled(): bool
    {
        return $this->attributes->has('disabled') && $this->attributes->get('disabled') == true;
    }

    public function moneySettings(): string
    {
        return json_encode([
            'init' => true,
            'maskOpts' => [
                'locales' => $this->locale
            ]
        ]);
    }

    // Simple helper methods for template optimization
    public function hasIcon(): bool
    {
        return (bool) $this->icon;
    }

    public function hasIconRight(): bool
    {
        return (bool) $this->iconRight;
    }

    public function hasPrefix(): bool
    {
        return (bool) $this->prefix;
    }

    public function hasSuffix(): bool
    {
        return (bool) $this->suffix;
    }

    public function hasHint(): bool
    {
        return (bool) $this->hint;
    }

    public function hasPrepend(): bool
    {
        return (bool) $this->prepend;
    }

    public function hasAppend(): bool
    {
        return (bool) $this->append;
    }

    public function getInputClasses(): string
    {
        $classes = ['input', 'w-full'];

        if ($this->hasPrepend() || $this->hasAppend()) {
            $classes[] = 'join-item';
        }

        if ($this->isReadonly()) {
            $classes[] = 'border-dashed';
        }

        return implode(' ', $classes);
    }

    public function getInputAttributes(): array
    {
        $attributes = [];

        if ($this->money) {
            $attributes['x-ref'] = 'myInput';
            $attributes['inputmode'] = 'numeric';
        }

        if ($this->attributes->has('autofocus') && $this->attributes->get('autofocus') == true) {
            $attributes['autofocus'] = true;
        }

        return $attributes;
    }

    public function render(): View|Closure|string
    {
        return view('jen::input');
    }
}
