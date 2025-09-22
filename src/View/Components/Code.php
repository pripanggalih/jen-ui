<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Code extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = '',
		public string $language = 'javascript',
		public ?string $lightTheme = 'github_light_default',
		public ?string $darkTheme = 'github_dark',
		public ?string $lightClass = "light",
		public ?string $darkClass = "dark",
		public string $height = '200px',
		public string $lineHeight = '2',
		public bool $printMargin = false,
	) {
		$this->uuid = 'jen-code-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Get the wire:model attribute name for error handling
	 */
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	/**
	 * Check if the component has a label
	 */
	public function hasLabel(): bool
	{
		return !empty($this->label);
	}

	/**
	 * Check if the component has a hint
	 */
	public function hasHint(): bool
	{
		return !empty($this->hint);
	}

	/**
	 * Get the main container classes
	 */
	public function getContainerClasses(): string
	{
		$classes = ['textarea', 'w-full', 'p-0'];

		if ($this->modelName() && $this->attributes->get('errors', collect())->has($this->modelName())) {
			$classes[] = 'textarea-error';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get editor configuration as JSON
	 */
	public function getEditorConfig(): array
	{
		return [
			'language' => $this->language,
			'lightTheme' => $this->lightTheme,
			'darkTheme' => $this->darkTheme,
			'lightClass' => $this->lightClass,
			'darkClass' => $this->darkClass,
			'height' => $this->height,
			'lineHeight' => $this->lineHeight,
			'printMargin' => $this->printMargin,
		];
	}

	public function render(): View|Closure|string
	{
		return view('jen::code');
	}
}
