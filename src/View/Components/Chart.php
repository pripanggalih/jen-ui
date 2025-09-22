<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Chart extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
	) {
		$this->uuid = 'jen-chart-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Get the chart container classes
	 */
	public function getContainerClasses(): string
	{
		return 'relative';
	}

	/**
	 * Get base attributes for the chart container
	 */
	public function getBaseAttributes(): array
	{
		return [
			'wire:key' => $this->uuid . '-' . rand(),
		];
	}

	public function render(): View|Closure|string
	{
		return view('jen::chart');
	}
}
