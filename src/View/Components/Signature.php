<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Signature extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $height = '250',
		public ?string $clearText = 'Clear',
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label text-xs pt-1',
		public ?array $config = [],
		public ?string $clearBtnStyle = null,

		// Validations
		public ?string $errorClass = 'text-error text-xs pt-1',
		public ?string $errorField = null,
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'jen-signature-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get wire:model attribute name
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get error field name (errorField or modelName)
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Convert config array to JSON for SignaturePad
	public function setup(): string
	{
		return json_encode(array_merge([], $this->config));
	}

	// Check if has model name for validation
	public function hasModel(): bool
	{
		return (bool) $this->modelName();
	}

	// Check if should show errors
	public function shouldShowError(): bool
	{
		return !$this->omitError && $this->hasModel();
	}

	// Get container classes for canvas wrapper
	public function getContainerClasses(): string
	{
		$classes = [
			'border-[length:var(--border)]',
			'border-base-300',
			'rounded-lg',
			'relative',
			'bg-white',
			'select-none',
			'touch-none',
			'block'
		];

		return implode(' ', $classes);
	}

	// Get canvas classes
	public function getCanvasClasses(): string
	{
		return 'rounded-lg block w-full select-none touch-none';
	}

	// Get clear button classes
	public function getClearButtonClasses(): string
	{
		return $this->clearBtnStyle ?? 'btn-sm btn-ghost';
	}

	public function render(): View|Closure|string
	{
		return view('jen::signature');
	}
}
