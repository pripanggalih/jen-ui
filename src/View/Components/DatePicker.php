<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class DatePicker extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $icon = null,
		public ?string $iconRight = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?bool $inline = false,
		public ?array $config = [],

		// Slots
		public mixed $prepend = null,
		public mixed $append = null,

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'datepicker-' . Str::random(8) . ($id ? "-{$id}" : '');
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

	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	public function hasRightIcon(): bool
	{
		return (bool) $this->iconRight;
	}

	public function hasLabel(): bool
	{
		return (bool) $this->label;
	}

	public function hasHint(): bool
	{
		return (bool) $this->hint;
	}

	public function getInputClasses(): string
	{
		$classes = ['input', 'w-full'];

		if ($this->prepend || $this->append) {
			$classes[] = 'join-item';
		}

		if ($this->isReadonly()) {
			$classes[] = 'border-dashed';
		}

		return implode(' ', $classes);
	}

	public function getLabelClasses(): string
	{
		$classes = [];

		if ($this->hasLabel() && $this->inline) {
			$classes[] = 'floating-label';
		}

		return implode(' ', $classes);
	}

	public function getBaseAttributes(): array
	{
		$attributes = [];

		if ($this->isDisabled()) {
			$attributes['disabled'] = true;
		}

		return $attributes;
	}

	public function setup(): string
	{
		// Handle `wire:model.live` for `range` dates
		if (isset($this->config["mode"]) && $this->config["mode"] == "range" && $this->attributes->wire('model')->hasModifier('live')) {
			$this->attributes->setAttributes([
				'wire:model' => $this->modelName(),
				'live' => true
			]);
		}

		$config = json_encode(array_merge([
			'dateFormat' => 'Y-m-d H:i',
			'altInput' => true,
			'altInputClass' => ' ',
			'clickOpens' => !$this->isReadonly(),
			'defaultDate' => '#model#',
			'plugins' => ['#plugins#'],
			'disable' => ['#disable#'],
		], Arr::except($this->config, ["plugins"])));

		// Plugins
		$plugins = "";
		foreach (Arr::get($this->config, 'plugins', []) as $plugin) {
			$plugins .= "new " . key($plugin) . "( " . json_encode(current($plugin)) . " ),";
		}
		$config = str_replace('"#plugins#"', $plugins, $config);

		// Disables
		$disables = '';
		foreach (Arr::get($this->config, 'disable', []) as $disable) {
			$disables .= $disable . ',';
		}
		$config = str_replace('"#disable#"', $disables, $config);

		// Sets default date as current bound model
		$config = str_replace('"#model#"', '$wire.get("' . $this->modelName() . '")', $config);

		return $config;
	}

	public function render(): View|Closure|string
	{
		return view('jen::datepicker');
	}
}
