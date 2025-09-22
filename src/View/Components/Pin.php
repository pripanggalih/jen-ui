<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Pin extends Component
{
	public string $uuid;

	public function __construct(
		public int $size,
		public ?string $id = null,
		public ?bool $numeric = false,
		public ?bool $hide = false,
		public ?string $hideType = "disc",
		public ?bool $noGap = false,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error text-xs pt-2',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'jen-pin-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get the wire:model attribute name for error handling
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get the field name for error validation
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Check if component should show errors
	public function hasErrors(): bool
	{
		if ($this->omitError) {
			return false;
		}

		$fieldName = $this->errorFieldName();
		return $fieldName && session()->has('errors') && session()->get('errors')->has($fieldName);
	}

	// Get container classes based on layout preference
	public function getContainerClasses(): string
	{
		$classes = ['flex'];

		if ($this->noGap) {
			$classes[] = 'join';
		} else {
			$classes[] = 'gap-3';
		}

		return implode(' ', $classes);
	}

	// Get input classes with error state
	public function getInputClasses(): array
	{
		$classes = [
			'input',
			'input-border',
			'min-w-6',
			'max-w-12',
			'p-0',
			'font-bold',
			'text-xl',
			'text-center'
		];

		if ($this->noGap) {
			$classes[] = 'join-item';
		}

		if ($this->hasErrors()) {
			$classes[] = '!input-error';
		}

		return $classes;
	}

	// Get text security styles for hiding input
	public function getSecurityStyles(): array
	{
		if (!$this->hide) {
			return [];
		}

		return [
			'text-security' => $this->hideType,
			'-webkit-text-security' => $this->hideType,
			'-moz-text-security' => $this->hideType,
		];
	}

	// Get input attributes for each PIN field
	public function getInputAttributes(int $index): array
	{
		$attributes = [
			'id' => "{$this->uuid}-pin-{$index}",
			'type' => 'text',
			'maxlength' => '1',
			'x-model' => "inputs[{$index}]",
		];

		if ($this->numeric) {
			$attributes['inputmode'] = 'numeric';
			$attributes['x-mask'] = '9';
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::pin');
	}
}
