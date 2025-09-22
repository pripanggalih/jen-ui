<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Popover extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $position = "bottom",
		public ?string $offset = "10",

		// Slots
		public mixed $trigger = null,
		public mixed $content = null
	) {
		$this->uuid = 'popover-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	public function getPosition(): string
	{
		return $this->position ?? 'bottom';
	}

	public function getOffset(): string
	{
		return $this->offset ?? '10';
	}

	public function getTriggerClasses(): string
	{
		return 'w-fit cursor-pointer';
	}

	public function getContentClasses(): string
	{
		return 'z-[1] shadow-xl border-[length:var(--border)] border-base-content/10 w-fit p-3 rounded-md bg-base-100';
	}

	public function render(): View|Closure|string
	{
		return view('jen::popover');
	}
}
