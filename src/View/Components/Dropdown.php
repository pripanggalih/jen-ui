<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Dropdown extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $icon = 'o-chevron-down',
		public ?bool $right = false,
		public ?bool $top = false,
		public ?bool $noXAnchor = false,
		// Slots
		public mixed $trigger = null
	) {
		$this->uuid = 'dropdown-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Check if using custom trigger
	public function hasCustomTrigger(): bool
	{
		return (bool) $this->trigger;
	}

	// Get dropdown classes based on positioning
	public function getDropdownClasses(): string
	{
		$classes = ['dropdown'];

		if ($this->noXAnchor && $this->right) {
			$classes[] = 'dropdown-end';
		}

		if ($this->noXAnchor && $this->top) {
			$classes[] = 'dropdown-top';
		}

		if ($this->noXAnchor && !$this->top) {
			$classes[] = 'dropdown-bottom';
		}

		return implode(' ', $classes);
	}

	// Get dropdown menu classes
	public function getMenuClasses(): string
	{
		$classes = [
			'p-2',
			'shadow',
			'menu',
			'z-[1]',
			'border-[length:var(--border)]',
			'border-base-content/10',
			'bg-base-100',
			'rounded-box',
			'w-auto',
			'min-w-max'
		];

		if ($this->noXAnchor) {
			$classes[] = 'dropdown-content';
		}

		return implode(' ', $classes);
	}

	// Get x-anchor position for dynamic positioning
	public function getXAnchorPosition(): string
	{
		return $this->right ? 'bottom-end' : 'bottom-start';
	}

	public function render(): View|Closure|string
	{
		return view('jen::dropdown');
	}
}
