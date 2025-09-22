<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ProgressRadial extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?float $value = 0,
		public ?string $unit = '%'
	) {
		$this->uuid = 'progress-radial-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Simple helper to get CSS custom property value
	public function getCssValue(): string
	{
		return "--value: {$this->value}";
	}

	// Get the display text
	public function getDisplayText(): string
	{
		return $this->value . $this->unit;
	}

	// Get base classes
	public function getBaseClasses(): string
	{
		return 'radial-progress';
	}

	public function render(): View|Closure|string
	{
		return view('jen::progress-radial');
	}
}
