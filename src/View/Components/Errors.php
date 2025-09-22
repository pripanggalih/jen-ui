<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Errors extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $title = null,
		public ?string $description = null,
		public ?string $icon = 'o-x-circle',
		public ?array $only = [],
	) {
		$this->uuid = 'errors-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Simple helper method to check if we have title
	public function hasTitle(): bool
	{
		return (bool) $this->title;
	}

	// Simple helper method to check if we have description
	public function hasDescription(): bool
	{
		return (bool) $this->description;
	}

	// Get main alert classes
	public function getAlertClasses(): string
	{
		return 'alert alert-error rounded rounded-sm';
	}

	// Get icon classes
	public function getIconClasses(): string
	{
		return 'w-6 h-6 mt-0.5';
	}

	public function render(): View|Closure|string
	{
		return view('jen::errors');
	}
}
