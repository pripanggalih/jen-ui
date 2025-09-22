<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class MenuTitle extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $title = null,
		public ?string $icon = null,
		public ?string $iconClasses = null,
	) {
		$this->uuid = 'menu-title-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	/**
	 * Check if component has an icon
	 */
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	/**
	 * Get the main CSS classes for the menu title
	 */
	public function getMainClasses(): string
	{
		return 'menu-title';
	}

	/**
	 * Get the container classes for the flex layout
	 */
	public function getContainerClasses(): string
	{
		return 'flex items-center gap-2';
	}

	public function render(): View|Closure|string
	{
		return view('jen::menu-title');
	}
}
