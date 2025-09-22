<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ThemeToggle extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $value = null,
		public ?string $light = "Light",
		public ?string $dark = "Dark",
		public ?string $lightTheme = "light",
		public ?string $darkTheme = "dark",
		public ?string $lightClass = "light",
		public ?string $darkClass = "dark",
		public ?bool $withLabel = false,
	) {
		$this->uuid = 'jen-theme-toggle-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Simple helper method for generating Alpine.js data attributes
	public function getAlpineData(): array
	{
		return [
			'theme' => "\$persist(window.matchMedia('(prefers-color-scheme: dark)').matches ? '{$this->darkTheme}' : '{$this->lightTheme}').as('jen-theme')",
			'class' => "\$persist(window.matchMedia('(prefers-color-scheme: dark)').matches ? '{$this->darkClass}' : '{$this->lightClass}').as('jen-class')",
		];
	}

	public function getToggleClasses(): string
	{
		return 'swap swap-rotate';
	}

	public function render(): View|Closure|string
	{
		return view('jen::theme-toggle');
	}
}
