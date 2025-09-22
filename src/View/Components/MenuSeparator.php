<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class MenuSeparator extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $title = null,
		public ?string $icon = null,
		public ?string $iconClasses = null,
	) {
		$this->uuid = 'menu-separator-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Check if title exists for display
	public function hasTitle(): bool
	{
		return (bool) $this->title;
	}

	// Check if icon should be displayed
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	// Get main classes for menu title
	public function getMenuTitleClasses(): string
	{
		return 'menu-title text-inherit uppercase';
	}

	// Get attributes for separator line
	public function getSeparatorAttributes(): array
	{
		return [
			'class' => 'my-3 border-t-[length:var(--border)] border-base-content/10'
		];
	}

	public function render(): View|Closure|string
	{
		return view('jen::menu-separator');
	}
}
