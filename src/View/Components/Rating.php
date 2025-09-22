<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Rating extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public int $total = 5
	) {
		$this->uuid = 'rating-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get the model name from wire:model attributes
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	// Extract size from class attribute using regex
	public function size(): ?string
	{
		return str($this->attributes->get('class'))->match('/(rating-(..))/');
	}

	// Check if component has size class
	public function hasSize(): bool
	{
		return !empty($this->size());
	}

	// Get base rating classes
	public function getRatingClasses(): string
	{
		$classes = ['rating', 'gap-1'];

		if ($this->hasSize()) {
			$classes[] = $this->size();
		}

		return implode(' ', $classes);
	}

	// Get input classes for star mask
	public function getInputClasses(): string
	{
		return 'mask mask-star-2';
	}

	public function render(): View|Closure|string
	{
		return view('jen::rating');
	}
}
