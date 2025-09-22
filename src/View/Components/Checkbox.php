<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Checkbox extends Component
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
		$this->uuid = 'checkbox-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Simple helper methods - NO CACHING for simple operations
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	public function hasHint(): bool
	{
		return (bool) $this->hint;
	}

	public function isRightAligned(): bool
	{
		return (bool) $this->right;
	}

	public function isRequired(): bool
	{
		return (bool) $this->attributes->get('required');
	}

	public function hasLabel(): bool
	{
		return (bool) $this->label;
	}

	public function getLabelClasses(): string
	{
		$classes = ['flex gap-3 items-center cursor-pointer'];

		if ($this->isRightAligned()) {
			$classes[] = 'justify-between';
		}

		if ($this->hasHint()) {
			$classes[] = '!items-start';
		}

		return implode(' ', $classes);
	}

	public function getCheckboxClasses(): string
	{
		$classes = ['checkbox'];

		if ($this->isRightAligned()) {
			$classes[] = 'order-2';
		}

		return implode(' ', $classes);
	}

	public function getLabelContentClasses(): string
	{
		$classes = [];

		if ($this->isRightAligned()) {
			$classes[] = 'order-1';
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::checkbox');
	}
}
