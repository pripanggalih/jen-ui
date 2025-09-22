<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Hr extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $target = null,
	) {
		$this->uuid = 'hr-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Get the progress target for wire:target directive
	public function progressTarget(): ?string
	{
		if ($this->target == 1) {
			return $this->attributes->whereStartsWith('target')->first();
		}

		return $this->target;
	}

	// Check if component has progress target
	public function hasProgressTarget(): bool
	{
		return (bool) $this->progressTarget();
	}

	// Get main container classes
	public function getContainerClasses(): string
	{
		return 'h-[2px] border-t-[length:var(--border)] border-t-base-content/10 my-5';
	}

	// Get progress element classes
	public function getProgressClasses(): string
	{
		return 'progress progress-primary hidden h-[1px]';
	}

	// Get progress loading attributes
	public function getProgressAttributes(): array
	{
		$attributes = [
			'wire:loading.class' => '!h-[length:var(--border)] !block'
		];

		if ($this->hasProgressTarget()) {
			$attributes['wire:target'] = $this->progressTarget();
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::hr');
	}
}
