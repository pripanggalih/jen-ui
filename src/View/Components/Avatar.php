<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Avatar extends Component
{
	public string $uuid;

	/**
	 * @param  ?string  $image  The URL of the avatar image.
	 * @param  ?string  $alt  The HTML `alt` attribute
	 * @param  ?string  $placeholder  The placeholder of the avatar.
	 * @param  ?string  $title  The title text displayed beside the avatar.
	 * @slot  ?string  $title  The title text displayed beside the avatar.
	 * @param  ?string  $subtitle  The subtitle text displayed beside the avatar.
	 * @slot  ?string  $subtitle The subtitle text displayed beside the avatar.
	 */
	public function __construct(
		public ?string $id = null,
		public ?string $image = '',
		public ?string $alt = '',
		public ?string $placeholder = '',
		public ?string $fallbackImage = null,

		// Slots
		public ?string $title = null,
		public ?string $subtitle = null
	) {
		$this->uuid = 'avatar-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Check if component has image
	 */
	public function hasImage(): bool
	{
		return !empty($this->image);
	}

	/**
	 * Check if component has title or subtitle
	 */
	public function hasTextContent(): bool
	{
		return (bool) ($this->title || $this->subtitle);
	}

	/**
	 * Get avatar container classes
	 */
	public function getAvatarClasses(): string
	{
		$classes = ['avatar'];

		if (!$this->hasImage()) {
			$classes[] = 'avatar-placeholder';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get avatar image/placeholder classes
	 */
	public function getImageClasses(): string
	{
		$classes = ['w-7', 'rounded-full'];

		if (!$this->hasImage()) {
			$classes[] = 'bg-neutral';
			$classes[] = 'text-neutral-content';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get title classes for slots
	 */
	public function getTitleClasses(): string
	{
		$baseClasses = 'font-semibold font-lg';

		if (is_string($this->title)) {
			return $baseClasses;
		}

		return $baseClasses . ' ' . ($this->title?->attributes->get('class') ?? '');
	}

	/**
	 * Get subtitle classes for slots
	 */
	public function getSubtitleClasses(): string
	{
		$baseClasses = 'text-sm text-base-content/50';

		if (is_string($this->subtitle)) {
			return $baseClasses;
		}

		return $baseClasses . ' ' . ($this->subtitle?->attributes->get('class') ?? '');
	}

	public function render(): View|Closure|string
	{
		return view('jen::avatar');
	}
}
