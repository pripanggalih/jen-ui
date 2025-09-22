<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class DateTime extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $icon = null,
		public ?string $iconRight = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?bool $inline = false,

		// Slots
		public mixed $prepend = null,
		public mixed $append = null,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'datetime-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Get the wire:model attribute value for this component
	 */
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	/**
	 * Get the field name to use for error validation
	 */
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	/**
	 * Check if component has an icon (left side)
	 */
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	/**
	 * Check if component has a right icon
	 */
	public function hasRightIcon(): bool
	{
		return (bool) $this->iconRight;
	}

	/**
	 * Check if component has prepend slot
	 */
	public function hasPrepend(): bool
	{
		return (bool) $this->prepend;
	}

	/**
	 * Check if component has append slot
	 */
	public function hasAppend(): bool
	{
		return (bool) $this->append;
	}

	/**
	 * Check if label should be displayed as floating
	 */
	public function isFloatingLabel(): bool
	{
		return $this->label && $this->inline;
	}

	/**
	 * Check if label should be displayed as standard (legend)
	 */
	public function isStandardLabel(): bool
	{
		return $this->label && !$this->inline;
	}

	/**
	 * Get the input wrapper classes
	 */
	public function getInputClasses(): string
	{
		$classes = ['input', 'w-full'];

		if ($this->hasPrepend() || $this->hasAppend()) {
			$classes[] = 'join-item';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get attributes for the input wrapper label
	 */
	public function getWrapperAttributes(): array
	{
		$attributes = [];

		// Add readonly styling
		if ($this->attributes->has('readonly') && $this->attributes->get('readonly') == true) {
			$attributes['class'] = 'border-dashed';
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::datetime');
	}
}
