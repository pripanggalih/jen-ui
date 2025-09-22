<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Card extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $title = null,
		public ?string $subtitle = null,
		public ?bool $separator = false,
		public ?bool $shadow = false,
		public ?string $progressIndicator = null,

		// Slots
		public mixed $menu = null,
		public mixed $actions = null,
		public mixed $figure = null,
		public ?string $bodyClass = 'null'
	) {
		$this->uuid = 'card-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Check if card has shadow
	public function hasShadow(): bool
	{
		return (bool) $this->shadow;
	}

	// Check if separator is enabled
	public function hasSeparator(): bool
	{
		return (bool) $this->separator;
	}

	// Check if progress indicator exists
	public function hasProgressIndicator(): bool
	{
		return (bool) $this->progressIndicator;
	}

	// Get progress target for wire:target
	public function progressTarget(): ?string
	{
		if ($this->progressIndicator == 1) {
			return $this->attributes->whereStartsWith('progress-indicator')->first();
		}

		return $this->progressIndicator;
	}

	// Get main card classes
	public function getCardClasses(): string
	{
		$classes = ['card', 'bg-base-100', 'rounded-lg', 'p-5'];

		if ($this->hasShadow()) {
			$classes[] = 'shadow-xs';
		}

		return implode(' ', $classes);
	}

	// Get title classes
	public function getTitleClasses(): string
	{
		$classes = ['text-xl', 'font-bold'];

		if (!is_string($this->title) && $this->title && method_exists($this->title, 'attributes')) {
			$titleClass = $this->title->attributes->get('class');
			if ($titleClass) {
				$classes[] = $titleClass;
			}
		}

		return implode(' ', $classes);
	}

	// Get subtitle classes
	public function getSubtitleClasses(): string
	{
		$classes = ['text-base-content/50', 'text-sm', 'mt-1'];

		if (!is_string($this->subtitle) && $this->subtitle && method_exists($this->subtitle, 'attributes')) {
			$subtitleClass = $this->subtitle->attributes->get('class');
			if ($subtitleClass) {
				$classes[] = $subtitleClass;
			}
		}

		return implode(' ', $classes);
	}

	// Get menu classes
	public function getMenuClasses(): string
	{
		$classes = ['flex', 'items-center', 'gap-2'];

		if ($this->menu && !is_string($this->menu) && method_exists($this->menu, 'attributes')) {
			$menuClass = $this->menu->attributes->get('class');
			if ($menuClass) {
				$classes[] = $menuClass;
			}
		}

		return implode(' ', $classes);
	}

	// Get actions classes
	public function getActionsClasses(): string
	{
		$classes = ['flex', 'w-full', 'items-end', 'justify-end', 'gap-3', 'pt-5'];

		if ($this->actions && !is_string($this->actions) && method_exists($this->actions, 'attributes')) {
			$actionsClass = $this->actions->attributes->get('class');
			if ($actionsClass) {
				$classes[] = $actionsClass;
			}
		}

		return implode(' ', $classes);
	}

	// Get body classes
	public function getBodyClasses(): string
	{
		$classes = ['grow-1'];

		if ($this->bodyClass && $this->bodyClass !== 'null') {
			$classes[] = $this->bodyClass;
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::card');
	}
}
