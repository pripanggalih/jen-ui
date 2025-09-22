<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Toggle extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?bool $right = false,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'toggle-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	/**
	 * Get the wire:model attribute name if present
	 */
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	/**
	 * Get the field name for error validation
	 */
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	/**
	 * Check if component has right alignment
	 */
	public function isRightAligned(): bool
	{
		return (bool) $this->right;
	}

	/**
	 * Check if component has hint text
	 */
	public function hasHint(): bool
	{
		return !empty($this->hint);
	}

	/**
	 * Check if component is required based on attributes
	 */
	public function isRequired(): bool
	{
		return $this->attributes->has('required');
	}

	/**
	 * Get base classes for the toggle input
	 */
	public function getToggleClasses(): string
	{
		$classes = ['toggle'];

		if ($this->isRightAligned()) {
			$classes[] = 'order-2';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get classes for the label container
	 */
	public function getLabelClasses(): string
	{
		$classes = [];

		if ($this->isRightAligned()) {
			$classes[] = 'order-1';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get classes for the main label element
	 */
	public function getMainLabelClasses(): string
	{
		$classes = ['flex', 'gap-3', 'items-center', 'cursor-pointer'];

		if ($this->isRightAligned()) {
			$classes[] = 'justify-between';
		}

		if ($this->hasHint()) {
			$classes[] = '!items-start';
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::toggle');
	}
}
