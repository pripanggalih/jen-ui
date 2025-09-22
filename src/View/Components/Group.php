<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Group extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?string $optionValue = 'id',
		public ?string $optionLabel = 'name',
		public Collection|array $options = new Collection(),

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'group-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Get wire:model name from attributes
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get error field name (from errorField or modelName)
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Check if component has label
	public function hasLabel(): bool
	{
		return !empty($this->label);
	}

	// Check if component has hint
	public function hasHint(): bool
	{
		return !empty($this->hint);
	}

	// Check if field is required
	public function isRequired(): bool
	{
		return (bool) $this->attributes->get('required');
	}

	// Get base fieldset classes
	public function getFieldsetClasses(): string
	{
		return 'fieldset py-0';
	}

	// Get legend classes
	public function getLegendClasses(): string
	{
		return 'fieldset-legend mb-0.5';
	}

	// Get join wrapper classes
	public function getJoinClasses(): string
	{
		return 'join';
	}

	// Get radio button classes for each option
	public function getRadioClasses(array|object $option): string
	{
		$classes = ['join-item btn [&:checked]:btn-neutral'];

		if (data_get($option, 'disabled')) {
			$classes[] = '!border-l-base-100';
		}

		return implode(' ', $classes);
	}

	// Get option attributes
	public function getOptionAttributes(array|object $option): array
	{
		$attributes = [
			'type' => 'radio',
			'name' => $this->modelName(),
			'value' => data_get($option, $this->optionValue),
			'aria-label' => data_get($option, $this->optionLabel),
		];

		if (data_get($option, 'disabled')) {
			$attributes['disabled'] = true;
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::group');
	}
}
