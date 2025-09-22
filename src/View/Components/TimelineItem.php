<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class TimelineItem extends Component
{
	public string $uuid;

	public function __construct(
		public string $title,
		public ?string $id = null,
		public ?string $subtitle = null,
		public ?string $description = null,
		public ?string $icon = null,
		public ?bool $pending = false,
		public ?bool $first = false,
		public ?bool $last = false,
	) {
		$this->uuid = 'timeline-item-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Simple helper methods for timeline logic
	public function isPending(): bool
	{
		return (bool) $this->pending;
	}

	public function isFirst(): bool
	{
		return (bool) $this->first;
	}

	public function isLast(): bool
	{
		return (bool) $this->last;
	}

	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	public function hasSubtitle(): bool
	{
		return (bool) $this->subtitle;
	}

	public function hasDescription(): bool
	{
		return (bool) $this->description;
	}

	public function getLastBorderClasses(): string
	{
		if (!$this->isLast()) {
			return '';
		}

		$classes = ['border-s-2 border-s-base-300 h-5 -mb-5'];

		if (!$this->isPending()) {
			$classes[] = '!border-s-primary';
		}

		return implode(' ', $classes);
	}

	public function getWrapperClasses(): string
	{
		$classes = ['border-s-2 border-s-base-300 ps-8 py-3'];

		if (!$this->isPending()) {
			$classes[] = '!border-s-primary';
		}

		if ($this->isFirst()) {
			$classes[] = 'pt-0';
		}

		if ($this->isLast()) {
			$classes[] = '!border-s-0';
		}

		return implode(' ', $classes);
	}

	public function getBulletClasses(): string
	{
		$classes = ['w-4 h-4 -mb-5 -ms-[41px] rounded-full bg-base-300'];

		if (!$this->isPending()) {
			$classes[] = 'bg-primary';
		}

		if ($this->isLast()) {
			$classes[] = '!-ms-[39px]';
		}

		if ($this->hasIcon()) {
			$classes[] = 'w-8 h-8 !-ms-[48px] -mb-7';
		}

		return implode(' ', $classes);
	}

	public function getIconClasses(): string
	{
		$classes = ['ms-2 mt-1 w-4 h-4'];

		if (!$this->isPending()) {
			$classes[] = 'text-base-100';
		}

		return implode(' ', $classes);
	}

	public function render(): View|Closure|string
	{
		return view('jen::timeline-item');
	}
}
