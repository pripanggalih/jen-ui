<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Radio extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?string $optionValue = 'id',
		public ?string $optionLabel = 'name',
		public ?string $optionHint = 'hint',
		public Collection|array $options = new Collection(),
		public ?bool $inline = false,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'jen-radio-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get wire:model attribute name
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get error field name for validation
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

	// Check if component is required
	public function isRequired(): bool
	{
		return $this->attributes->get('required') !== null;
	}

	// Get container classes for radio options
	public function getContainerClasses(): string
	{
		$classes = ['gap-4', 'grid'];

		if ($this->inline) {
			$classes[] = 'sm:flex sm:gap-6';
		}

		return implode(' ', $classes);
	}

	// Get base attributes for fieldset
	public function getFieldsetAttributes(): array
	{
		$attributes = ['class' => 'fieldset py-0'];

		return $attributes;
	}

	// Get option value
	public function getOptionValue($option): mixed
	{
		return data_get($option, $this->optionValue);
	}

	// Get option label
	public function getOptionLabel($option): mixed
	{
		return data_get($option, $this->optionLabel);
	}

	// Get option hint
	public function getOptionHint($option): mixed
	{
		return data_get($option, $this->optionHint);
	}

	// Check if option is disabled
	public function isOptionDisabled($option): bool
	{
		return (bool) data_get($option, 'disabled', false);
	}

	public function render(): View|Closure|string
	{
		return view('jen::radio');
	}
}
