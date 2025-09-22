<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Header extends Component
{
	public string $anchor = '';

	public function __construct(
		public ?string $title = null,
		public ?string $subtitle = null,
		public ?bool $separator = false,
		public ?string $progressIndicator = null,
		public string $progressIndicatorClass = "progress-primary",
		public ?bool $withAnchor = false,
		public ?string $size = 'text-2xl',

		// Icon
		public ?string $icon = null,
		public ?string $iconClasses = null,

		// Slots
		public mixed $middle = null,
		public mixed $actions = null,
	) {
		$this->anchor = Str::slug($title);
	}

	// Progress target computation - no caching needed for simple logic
	public function progressTarget(): ?string
	{
		if ($this->progressIndicator == 1) {
			return $this->attributes->whereStartsWith('progress-indicator')->first();
		}

		return $this->progressIndicator;
	}

	// Check if progress target exists
	public function hasProgressTarget(): bool
	{
		return (bool) $this->progressTarget();
	}

	// Check if we have an icon to display
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	// Check if we should show progress indicator
	public function hasProgressIndicator(): bool
	{
		return $this->separator && (bool) $this->progressIndicator;
	}

	// Get main container classes
	public function getContainerClasses(): string
	{
		$classes = ['mb-10'];

		if ($this->withAnchor) {
			$classes[] = 'mary-header-anchor';
		}

		return implode(' ', $classes);
	}

	// Get title section classes
	public function getTitleClasses(): string
	{
		$classes = ['flex', 'items-center', $this->size, 'font-extrabold'];

		// Handle title slot attributes if not string
		if (!is_string($this->title) && $this->title && method_exists($this->title, 'attributes')) {
			$titleClass = $this->title->attributes?->get('class');
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

		// Handle subtitle slot attributes if not string
		if (!is_string($this->subtitle) && $this->subtitle && method_exists($this->subtitle, 'attributes')) {
			$subtitleClass = $this->subtitle->attributes?->get('class');
			if ($subtitleClass) {
				$classes[] = $subtitleClass;
			}
		}

		return implode(' ', $classes);
	}

	// Get middle section classes
	public function getMiddleClasses(): string
	{
		$classes = ['flex', 'items-center', 'justify-center', 'gap-3', 'grow', 'order-last', 'sm:order-none'];

		// Handle middle slot attributes if not string
		if (!is_string($this->middle) && $this->middle && method_exists($this->middle, 'attributes')) {
			$middleClass = $this->middle->attributes?->get('class');
			if ($middleClass) {
				$classes[] = $middleClass;
			}
		}

		return implode(' ', $classes);
	}

	// Get actions section classes
	public function getActionsClasses(): string
	{
		$classes = ['flex', 'items-center', 'gap-3'];

		// Handle actions slot attributes if not string
		if (!is_string($this->actions) && $this->actions && method_exists($this->actions, 'attributes')) {
			$actionsClass = $this->actions->attributes?->get('class');
			if ($actionsClass) {
				$classes[] = $actionsClass;
			}
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::header');
	}
}
