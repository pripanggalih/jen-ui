<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Stat extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $value = null,
		public ?string $icon = null,
		public ?string $color = '',
		public ?string $title = null,
		public ?string $description = null,
		public ?string $tooltip = null,
		public ?string $tooltipLeft = null,
		public ?string $tooltipRight = null,
		public ?string $tooltipBottom = null,
	) {
		$this->uuid = 'jen-stat-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get final tooltip value with priority logic
	public function getTooltip(): ?string
	{
		return $this->tooltip ?? $this->tooltipLeft ?? $this->tooltipRight ?? $this->tooltipBottom;
	}

	// Get tooltip position class based on directional properties
	public function getTooltipPosition(): string
	{
		if ($this->tooltipLeft) {
			return 'lg:tooltip-left';
		}

		if ($this->tooltipRight) {
			return 'lg:tooltip-right';
		}

		if ($this->tooltipBottom) {
			return 'lg:tooltip-bottom';
		}

		return 'lg:tooltip-top';
	}

	// Check if component has icon
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	// Check if tooltip should be displayed
	public function hasTooltip(): bool
	{
		return (bool) $this->getTooltip();
	}

	// Get main container classes
	public function getContainerClasses(): string
	{
		$classes = ['bg-base-100', 'rounded-lg', 'px-5', 'py-4', 'w-full'];

		if ($this->hasTooltip()) {
			$classes[] = 'lg:tooltip';
			$classes[] = $this->getTooltipPosition();
		}

		return implode(' ', $classes);
	}

	// Get icon container classes with color
	public function getIconClasses(): string
	{
		return $this->color ?: '';
	}

	public function render(): View|Closure|string
	{
		return view('jen::stat');
	}
}
