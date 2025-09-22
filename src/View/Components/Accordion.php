<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Accordion extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?bool $noJoin = false,
	) {
		$this->uuid = 'accordion-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Check if accordion should use join styling
	 */
	public function hasJoinStyling(): bool
	{
		return !$this->noJoin;
	}

	/**
	 * Get main accordion classes
	 */
	public function getAccordionClasses(): string
	{
		return $this->hasJoinStyling() ? 'join join-vertical w-full' : '';
	}

	public function render(): View|Closure|string
	{
		return view('jen::accordion');
	}
}
