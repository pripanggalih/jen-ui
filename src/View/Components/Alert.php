<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Alert extends Component
{
	public string $uuid;

	/**
	 * @param ?string  $id  The unique identifier for the alert.
	 * @param ?string  $title  The title of the alert, displayed in bold.
	 * @param ?string  $icon  The icon displayed at the beginning of the alert.
	 * @param ?string  $description  A short description under the title.
	 * @param ?bool  $shadow  Whether to apply a shadow effect to the alert.
	 * @param ?bool  $dismissible  Whether the alert can be dismissed by the user.
	 * @slot  mixed  $actions  Slots for actionable elements like buttons or links.
	 */
	public function __construct(
		public ?string $id = null,
		public ?string $title = null,
		public ?string $icon = null,
		public ?string $description = null,
		public ?bool $shadow = false,
		public ?bool $dismissible = false,

		// Slots
		public mixed $actions = null
	) {
		$this->uuid = 'alert-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Helper methods for template optimization
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	public function hasTitle(): bool
	{
		return (bool) $this->title;
	}

	public function hasDescription(): bool
	{
		return (bool) $this->description;
	}

	public function hasShadow(): bool
	{
		return (bool) $this->shadow;
	}

	public function isDismissible(): bool
	{
		return (bool) $this->dismissible;
	}

	public function getAlertClasses(): string
	{
		$classes = ['alert', 'rounded-md'];

		if ($this->hasShadow()) {
			$classes[] = 'shadow-md';
		}

		return implode(' ', $classes);
	}

	public function getTitleClasses(): string
	{
		return $this->hasDescription() ? 'font-bold' : '';
	}

	public function render(): View|Closure|string
	{
		return view('jen::alert');
	}
}
