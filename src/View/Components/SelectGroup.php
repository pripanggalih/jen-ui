<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class SelectGroup extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $icon = null,
		public ?string $iconRight = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
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
		$this->uuid = 'select-group-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Check if component has floating label mode
	public function hasFloatingLabel(): bool
	{
		return (bool) ($this->label && $this->inline);
	}

	// Check if component has standard label
	public function hasStandardLabel(): bool
	{
		return (bool) ($this->label && !$this->inline);
	}

	// Check if component has prepend or append elements
	public function hasJoinElements(): bool
	{
		return (bool) ($this->prepend || $this->append);
	}

	// Check if select should have error styling
	public function hasError(): bool
	{
		if ($this->omitError) {
			return false;
		}

		$errorField = $this->errorFieldName();
		return $errorField && $this->getErrors()->has($errorField);
	}

	// Check if field is required
	public function isRequired(): bool
	{
		return (bool) $this->attributes->get('required');
	}

	// Check if field is readonly
	public function isReadonly(): bool
	{
		return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
	}

	// Get select wrapper classes
	public function getSelectWrapperClasses(): string
	{
		$classes = ['select w-full'];

		if ($this->hasJoinElements()) {
			$classes[] = 'join-item';
		}

		if ($this->isReadonly()) {
			$classes[] = 'border-dashed';
		}

		if ($this->hasError()) {
			$classes[] = '!select-error';
		}

		return implode(' ', $classes);
	}

	// Get errors instance (for compatibility with blade templates)
	private function getErrors()
	{
		return session('errors') ?? new \Illuminate\Support\ViewErrorBag();
	}

	public function render(): View|Closure|string
	{
		return view('jen::select-group');
	}
}
