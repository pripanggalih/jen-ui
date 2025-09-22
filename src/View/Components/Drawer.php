<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Livewire\WireDirective;

class Drawer extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?bool $right = false,
		public ?string $title = null,
		public ?string $subtitle = null,
		public ?bool $separator = false,
		public ?bool $withCloseButton = false,
		public ?bool $closeOnEscape = false,
		public ?bool $withoutTrapFocus = false,

		//Slots
		public ?string $actions = null
	) {
		$this->uuid = 'drawer-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Get the drawer ID from parameter or wire:model
	public function id(): string
	{
		return $this->id ?? $this->attributes?->wire('model')->value();
	}

	// Get the Livewire model directive
	public function modelName(): WireDirective
	{
		return $this->attributes->wire('model');
	}

	// Check if drawer is positioned on the right
	public function isRightSide(): bool
	{
		return (bool) $this->right;
	}

	// Check if close button should be shown
	public function hasCloseButton(): bool
	{
		return (bool) $this->withCloseButton;
	}

	// Check if should close on escape key
	public function shouldCloseOnEscape(): bool
	{
		return (bool) $this->closeOnEscape;
	}

	// Check if focus trapping is disabled
	public function isFocusTrapDisabled(): bool
	{
		return (bool) $this->withoutTrapFocus;
	}

	// Get drawer container classes
	public function getDrawerClasses(): string
	{
		$classes = ['drawer', 'absolute', 'z-50'];

		if ($this->isRightSide()) {
			$classes[] = 'drawer-end';
		}

		return implode(' ', $classes);
	}

	// Get card classes for the drawer content
	public function getCardClasses(): string
	{
		return 'min-h-screen rounded-none px-8';
	}

	public function render(): View|Closure|string
	{
		return view('jen::drawer');
	}
}
