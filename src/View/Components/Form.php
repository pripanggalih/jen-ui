<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Form extends Component
{
	public string $uuid;

	public function __construct(
		// Slots
		public mixed $actions = null,
		public ?bool $noSeparator = false,
	) {
		$this->uuid = 'form-' . Str::random(8);
	}

	/**
	 * Check if form has actions slot
	 */
	public function hasActions(): bool
	{
		return (bool) $this->actions;
	}

	/**
	 * Check if separator should be shown
	 */
	public function shouldShowSeparator(): bool
	{
		return $this->hasActions() && !$this->noSeparator;
	}

	/**
	 * Get form base classes
	 */
	public function getFormClasses(): string
	{
		return 'grid grid-flow-row auto-rows-min gap-3';
	}

	/**
	 * Get actions container classes
	 */
	public function getActionsClasses(): string
	{
		return 'flex justify-end gap-3';
	}

	public function render(): View|Closure|string
	{
		return view('jen::form');
	}
}
