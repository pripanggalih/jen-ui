<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Badge extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $value = null,
	) {
		$this->uuid = 'badge-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Check if badge has value content
	 */
	public function hasValue(): bool
	{
		return (bool) $this->value;
	}

	/**
	 * Get main badge classes
	 */
	public function getBadgeClasses(): string
	{
		$classes = ['badge'];

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::badge');
	}
}
