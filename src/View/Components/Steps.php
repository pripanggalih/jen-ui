<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Steps extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public bool $vertical = false,
		public ?string $stepsColor = 'step-neutral',
		public ?string $stepperClasses = null
	) {
		$this->uuid = 'steps-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	/**
	 * Check if the component is in vertical mode
	 */
	public function isVertical(): bool
	{
		return $this->vertical;
	}

	/**
	 * Get the step color class
	 */
	public function getStepsColor(): string
	{
		return $this->stepsColor ?: 'step-neutral';
	}

	/**
	 * Get the stepper classes
	 */
	public function getStepperClasses(): string
	{
		$classes = ['steps', '[&>*:nth-child(2)]:before:hidden'];

		if ($this->stepperClasses) {
			$classes[] = $this->stepperClasses;
		}

		return implode(' ', $classes);
	}

	/**
	 * Get forced tailwind classes for compilation
	 */
	public function getForcedClasses(): string
	{
		return 'hidden step-primary step-error step-success step-neutral step-info step-accent';
	}

	public function render(): View|Closure|string
	{
		return view('jen::steps');
	}
}
