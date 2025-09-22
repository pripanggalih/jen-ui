<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Nav extends Component
{
	public string $uuid;

	public function __construct(
		public ?bool $sticky = false,
		public ?bool $fullWidth = false,

		// Slots
		public mixed $brand = null,
		public mixed $actions = null
	) {
		$this->uuid = 'nav-' . Str::random(8);
	}

	// Simple helper methods for template logic
	public function isSticky(): bool
	{
		return (bool) $this->sticky;
	}

	public function isFullWidth(): bool
	{
		return (bool) $this->fullWidth;
	}

	public function getNavClasses(): string
	{
		$classes = ['bg-base-100', 'border-base-content/10', 'border-b-[length:var(--border)]'];

		if ($this->isSticky()) {
			$classes[] = 'sticky top-0 z-10';
		}

		return implode(' ', $classes);
	}

	public function getContainerClasses(): string
	{
		$classes = ['flex', 'items-center', 'px-6', 'py-3'];

		if (!$this->isFullWidth()) {
			$classes[] = 'max-w-screen-2xl mx-auto';
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::nav');
	}
}
