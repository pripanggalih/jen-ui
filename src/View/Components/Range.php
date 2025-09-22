<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Range extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?int $min = 0,
		public ?int $max = 100,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'jen-range-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get wire:model attribute name for validation
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Determine which field name to use for error validation
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Check if component has label
	public function hasLabel(): bool
	{
		return (bool) $this->label;
	}

	// Check if component has hint
	public function hasHint(): bool
	{
		return (bool) $this->hint;
	}

	// Check if required attribute is set
	public function isRequired(): bool
	{
		return (bool) $this->attributes->get('required');
	}

	// Get base classes for range input
	public function getRangeClasses(): string
	{
		return 'range w-full';
	}

	// Get range input attributes for merging
	public function getRangeAttributes(): array
	{
		return [
			'type' => 'range',
			'min' => (string) $this->min,
			'max' => (string) $this->max,
			'id' => $this->uuid,
		];
	}

	public function render(): View|Closure|string
	{
		return view('jen::range');
	}
}
