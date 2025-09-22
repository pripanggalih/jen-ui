<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Textarea extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?bool $inline = false,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'jen-textarea-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	/**
	 * Get the wire:model attribute name
	 */
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	/**
	 * Get the error field name to use for validation
	 */
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	/**
	 * Check if field is required
	 */
	public function isRequired(): bool
	{
		return $this->attributes->has('required') && $this->attributes->get('required');
	}

	/**
	 * Check if field is readonly
	 */
	public function isReadonly(): bool
	{
		return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
	}

	/**
	 * Check if field has validation errors
	 */
	public function hasErrors(): bool
	{
		if ($this->omitError) {
			return false;
		}

		$errorField = $this->errorFieldName();

		return $errorField && app('view')->shared('errors')->has($errorField);
	}

	/**
	 * Get textarea CSS classes
	 */
	public function getTextareaClasses(): string
	{
		$classes = ['textarea', 'w-full'];

		if ($this->isReadonly()) {
			$classes[] = 'border-dashed';
		}

		if ($this->hasErrors()) {
			$classes[] = '!textarea-error';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get base attributes for the textarea
	 */
	public function getBaseAttributes(): array
	{
		$attributes = [];

		if ($this->attributes->has('placeholder')) {
			$attributes['placeholder'] = $this->attributes->get('placeholder') . ' ';
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::textarea');
	}
}
