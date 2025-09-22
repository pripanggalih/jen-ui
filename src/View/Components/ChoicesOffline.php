<?php

namespace Jen\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ChoicesOffline extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?string $icon = null,
		public ?string $iconRight = null,
		public ?bool $inline = false,
		public ?bool $clearable = false,
		public ?string $prefix = null,
		public ?string $suffix = null,

		public ?bool $searchable = false,
		public ?bool $single = false,
		public ?bool $compact = false,
		public ?string $compactText = 'selected',
		public ?bool $allowAll = false,
		public ?string $debounce = '250ms',
		public ?int $minChars = 0,
		public ?string $allowAllText = 'Select all',
		public ?string $removeAllText = 'Remove all',
		public ?string $optionValue = 'id',
		public ?string $optionLabel = 'name',
		public ?string $optionSubLabel = '',
		public ?string $optionAvatar = 'avatar',
		public ?bool $valuesAsString = false,
		public ?string $height = 'max-h-64',
		public Collection|array $options = new Collection(),
		public ?string $noResultText = 'No results found.',

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error label-text-alt p-1',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,

		// Slots
		public mixed $item = null,
		public mixed $selection = null,
		public mixed $prepend = null,
		public mixed $append = null
	) {
		$this->uuid = 'choices-offline-' . Str::random(8) . ($id ? "-{$id}" : '');

		if (($this->allowAll || $this->compact) && ($this->single || $this->searchable)) {
			throw new Exception("`allow-all` and `compact` does not work combined with `single` or `searchable`.");
		}
	}

	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	public function isReadonly(): bool
	{
		return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
	}

	public function isDisabled(): bool
	{
		return $this->attributes->has('disabled') && $this->attributes->get('disabled') == true;
	}

	public function isRequired(): bool
	{
		return $this->attributes->has('required') && $this->attributes->get('required') == true;
	}

	public function getOptionValue($option): mixed
	{
		$value = data_get($option, $this->optionValue);

		if ($this->valuesAsString) {
			return "'$value'";
		}

		return is_numeric($value) && ! str($value)->startsWith('0') ? $value : "'$value'";
	}

	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	public function hasIconRight(): bool
	{
		return (bool) $this->iconRight;
	}

	public function hasPrefix(): bool
	{
		return (bool) $this->prefix;
	}

	public function hasSuffix(): bool
	{
		return (bool) $this->suffix;
	}

	public function shouldShowError(): bool
	{
		return !$this->omitError && $this->errorFieldName() && $this->attributes->get('errors') && $this->attributes->get('errors')->has($this->errorFieldName());
	}

	public function getFieldsetClasses(): string
	{
		return 'fieldset py-0';
	}

	public function getLabelClasses(): string
	{
		$classes = ['w-full'];

		if ($this->prepend || $this->append) {
			$classes[] = 'join';
		}

		return implode(' ', $classes);
	}

	public function getInputClasses(): string
	{
		$classes = [
			'select select-bordered w-full',
		];

		if ($this->shouldShowError()) {
			$classes[] = '!select-error';
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::choices-offline');
	}
}
