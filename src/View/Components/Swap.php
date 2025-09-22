<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Swap extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $true = null,
		public ?string $false = null,
		public ?string $trueIcon = 'o-sun',
		public ?string $falseIcon = 'o-moon',
		public ?string $iconSize = "h-5 w-5",
	) {
		$this->uuid = 'jen-swap-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Simple helper methods for readability
	public function hasCustomTrue(): bool
	{
		return (bool) $this->true;
	}

	public function hasCustomFalse(): bool
	{
		return (bool) $this->false;
	}

	public function getSwapClasses(): string
	{
		return 'swap';
	}

	public function getTrueClasses(): string
	{
		return 'swap-on';
	}

	public function getFalseClasses(): string
	{
		return 'swap-off';
	}

	public function getIconClasses(): string
	{
		return $this->iconSize;
	}

	public function render(): View|Closure|string
	{
		return view('jen::swap');
	}
}
