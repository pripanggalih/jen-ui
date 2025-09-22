<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Carousel extends Component
{
	public string $uuid;

	public function __construct(
		public array $slides,
		public ?string $id = null,
		public ?bool $withoutIndicators = false,
		public ?bool $withoutArrows = false,
		public ?bool $autoplay = false,
		public ?int $interval = 2000,
		public mixed $content = null,
	) {
		$this->uuid = 'carousel-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Check if arrows should be displayed
	public function hasArrows(): bool
	{
		return !$this->withoutArrows;
	}

	// Check if indicators should be displayed
	public function hasIndicators(): bool
	{
		return !$this->withoutIndicators;
	}

	// Check if autoplay is enabled
	public function isAutoplay(): bool
	{
		return (bool) $this->autoplay;
	}

	// Get carousel configuration for Alpine.js
	public function getCarouselConfig(): array
	{
		return [
			'slides' => $this->slides,
			'withoutIndicators' => $this->withoutIndicators,
			'autoplay' => $this->autoplay,
			'interval' => $this->interval,
		];
	}

	// Get base container classes
	public function getContainerClasses(): string
	{
		return 'relative w-full overflow-hidden';
	}

	// Get slide container classes
	public function getSlideContainerClasses(): string
	{
		return 'relative h-64 w-full rounded-box overflow-hidden';
	}

	public function render(): View|Closure|string
	{
		return view('jen::carousel');
	}
}
