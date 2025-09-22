<?php

namespace Jen\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Password extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $icon = null,
		public ?string $iconRight = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?string $prefix = null,
		public ?string $suffix = null,
		public ?bool $inline = false,
		public ?bool $clearable = false,

		// Password
		public ?string $passwordIcon = 'o-eye-slash',
		public ?string $passwordVisibleIcon = 'o-eye',
		public ?bool $passwordIconTabindex = false,
		public ?bool $right = false,
		public ?bool $onlyPassword = false,

		// Slots
		public mixed $prepend = null,
		public mixed $append = null,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'password-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');

		// Cannot use a left icon when password toggle should be shown on the left side.
		if (($this->icon && ! $this->right) && ! $this->onlyPassword) {
			throw new Exception("Cannot use `icon` without providing `right` or `onlyPassword`.");
		}

		// Cannot use a right icon when password toggle should be shown on the right side.
		if (($this->iconRight && $this->right) && ! $this->onlyPassword) {
			throw new Exception("Cannot use `iconRight` when providing `right` and not providing `onlyPassword`.");
		}
	}

	// Get wire:model value for unique UUID and error handling
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Get error field name for validation
	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	// Determine if toggle should be placed on the left
	public function placeToggleLeft(): bool
	{
		return (! $this->icon && ! $this->right) && ! $this->onlyPassword;
	}

	// Determine if toggle should be placed on the right
	public function placeToggleRight(): bool
	{
		return (! $this->iconRight && $this->right) && ! $this->onlyPassword;
	}

	// Check if component has error
	public function hasError(): bool
	{
		return $this->errorFieldName() && ! $this->omitError;
	}

	// Get main input classes
	public function getInputClasses(): string
	{
		$classes = ['input', 'w-full'];

		if ($this->prepend || $this->append) {
			$classes[] = 'join-item';
		}

		if ($this->attributes->has("readonly") && $this->attributes->get("readonly") == true) {
			$classes[] = 'border-dashed';
		}

		return implode(' ', $classes);
	}

	// Get wrapper classes for floating label
	public function getWrapperClasses(): string
	{
		$classes = [];

		if ($this->label && $this->inline) {
			$classes[] = 'floating-label';
		}

		return implode(' ', $classes);
	}

	// Get join classes for prepend/append
	public function getJoinClasses(): string
	{
		$classes = ['w-full'];

		if ($this->prepend || $this->append) {
			$classes[] = 'join';
		}

		return implode(' ', $classes);
	}

	// Check if component is required
	public function isRequired(): bool
	{
		return $this->attributes->get('required') == true;
	}

	public function render(): View|Closure|string
	{
		return view('jen::password');
	}
}
