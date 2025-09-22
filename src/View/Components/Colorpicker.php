<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Colorpicker extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $icon = '',
		public ?string $iconRight = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?string $prefix = null,
		public ?string $suffix = null,
		public ?bool $inline = false,
		public ?bool $clearable = false,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'colorpicker-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Get wire:model name for binding
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get error field name for validation
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

	// Check if component has label
	public function hasLabel(): bool
	{
		return (bool) $this->label;
	}

	// Check if component has icon
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	// Check if component has right icon
	public function hasIconRight(): bool
	{
		return (bool) $this->iconRight;
	}

	// Check if component has prefix
	public function hasPrefix(): bool
	{
		return (bool) $this->prefix;
	}

	// Check if component has suffix
	public function hasSuffix(): bool
	{
		return (bool) $this->suffix;
	}

	// Check if component has hint
	public function hasHint(): bool
	{
		return (bool) $this->hint;
	}

	// Get input container classes
	public function getInputClasses(): string
	{
		$classes = ['input', 'join-item', 'w-full'];

		if ($this->isReadonly()) {
			$classes[] = 'border-dashed';
		}

		return implode(' ', $classes);
	}

	// Get color picker button classes
	public function getColorPickerClasses(): string
	{
		$classes = ['input', 'join-item', 'w-12', 'p-0'];

		if ($this->isReadonly()) {
			$classes[] = 'border';
			$classes[] = 'border-dashed';
		}

		return implode(' ', $classes);
	}

	// Get base attributes for color picker input
	public function getColorPickerAttributes(): array
	{
		$attributes = [
			'type' => 'color',
			'class' => 'cursor-pointer opacity-0 join-item',
		];

		if ($this->isReadonly()) {
			$attributes['class'] .= ' border-dashed';
		}

		return $attributes;
	}

	// Get base attributes for text input
	public function getTextInputAttributes(): array
	{
		return [
			'id' => $this->uuid,
			'type' => 'text',
			'placeholder' => $this->attributes->get('placeholder') ?? '',
		];
	}

	public function render(): View|Closure|string
	{
		return view('jen::colorpicker');
	}
}
