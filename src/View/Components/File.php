<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class File extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?bool $hideProgress = false,
		public ?bool $cropAfterChange = false,
		public ?string $changeText = "Change",
		public ?string $cropTitleText = "Crop image",
		public ?string $cropCancelText = "Cancel",
		public ?string $cropSaveText = "Crop",
		public ?array $cropConfig = [],
		public ?string $cropMimeType = "image/png",

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'file-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Get wire:model attribute name
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get field name for error display
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Generate JSON config for Cropper.js
	public function cropSetup(): string
	{
		return json_encode(array_merge([
			'autoCropArea' => 1,
			'viewMode' => 1,
			'dragMode' => 'move'
		], $this->cropConfig ?? []));
	}

	// Check if component has slot content
	public function hasSlot(): bool
	{
		return !empty(trim($this->slot ?? ''));
	}

	// Get file input classes
	public function getFileInputClasses(): string
	{
		$classes = ['file-input', 'w-full'];

		if ($this->hasErrors()) {
			$classes[] = '!file-input-error';
		}

		if ($this->hasSlot()) {
			$classes[] = 'hidden';
		}

		return implode(' ', $classes);
	}

	// Check if field has validation errors
	public function hasErrors(): bool
	{
		if ($this->omitError) {
			return false;
		}

		$errorField = $this->errorFieldName();
		$errors = session()->get('errors');
		return $errorField && $errors && $errors->has($errorField);
	}

	// Get error messages array
	public function getErrorMessages(): array
	{
		if (!$this->hasErrors()) {
			return [];
		}

		$errors = session()->get('errors');
		return $errors ? $errors->get($this->errorFieldName()) : [];
	}

	// Check if field is required
	public function isRequired(): bool
	{
		return $this->attributes->get('required') !== null;
	}

	public function render(): View|Closure|string
	{
		return view('jen::file');
	}
}
