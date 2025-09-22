<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Progress extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?float $value = 0,
		public ?float $max = 100,
		public ?bool $indeterminate = false,
	) {
		$this->uuid = 'progress-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Check if progress is in indeterminate mode
	public function isIndeterminate(): bool
	{
		return (bool) $this->indeterminate;
	}

	// Get the progress percentage for display
	public function getPercentage(): float
	{
		if ($this->isIndeterminate() || $this->max <= 0) {
			return 0;
		}

		return min(100, max(0, ($this->value / $this->max) * 100));
	}

	// Check if progress has a valid value
	public function hasValue(): bool
	{
		return !$this->isIndeterminate() && $this->value !== null;
	}

	// Get main progress classes
	public function getProgressClasses(): string
	{
		return 'progress';
	}

	// Get progress attributes for rendering
	public function getProgressAttributes(): array
	{
		$attributes = [];

		if (!$this->isIndeterminate()) {
			$attributes['value'] = $this->value;
			$attributes['max'] = $this->max;
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::progress');
	}
}
