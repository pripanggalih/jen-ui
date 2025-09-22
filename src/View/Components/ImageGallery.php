<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ImageGallery extends Component
{
	public string $uuid;

	public function __construct(
		public array $images,
		public ?string $id = null,
		public ?bool $withArrows = false,
		public ?bool $withIndicators = false
	) {
		$this->uuid = 'gallery-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Check if gallery has images
	 */
	public function hasImages(): bool
	{
		return !empty($this->images);
	}

	/**
	 * Get the gallery container classes
	 */
	public function getGalleryClasses(): string
	{
		$classes = ['pswp-gallery', 'pswp-gallery--single-column', 'carousel'];

		return implode(' ', $classes);
	}

	/**
	 * Get carousel item classes
	 */
	public function getCarouselItemClasses(): string
	{
		return 'carousel-item';
	}

	/**
	 * Get image classes
	 */
	public function getImageClasses(): string
	{
		return 'object-cover hover:opacity-70';
	}

	public function render(): View|Closure|string
	{
		return view('jen::image-gallery');
	}
}
