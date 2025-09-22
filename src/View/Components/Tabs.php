<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Tabs extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $selected = null,
		public string $labelClass = 'font-semibold pb-1',
		public string $activeClass = 'border-b-[length:var(--border)] border-b-base-content/50',
		public string $labelDivClass = 'border-b-[length:var(--border)] border-b-base-content/10 flex overflow-x-auto',
		public string $tabsClass = 'relative w-full',
	) {
		$this->uuid = 'jen-tabs-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Simple helper methods
	public function hasSelected(): bool
	{
		return (bool) $this->selected;
	}

	public function getTabsClasses(): string
	{
		return $this->tabsClass;
	}

	public function getLabelDivClasses(): string
	{
		return $this->labelDivClass;
	}

	public function getLabelClasses(): string
	{
		return $this->labelClass;
	}

	public function getActiveClasses(): string
	{
		return $this->activeClass;
	}

	public function render(): View|Closure|string
	{
		return view('jen::tabs');
	}
}
