<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Step extends Component
{
	public string $uuid;

	public function __construct(
		public int $step,
		public string $text,
		public ?string $id = null,
		public ?string $icon = null,
		public ?string $stepClasses = null,
		public ?string $dataContent = null,
	) {
		$this->uuid = 'step-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	/**
	 * Check if step has an icon
	 */
	public function hasIcon(): bool
	{
		return (bool) $this->icon;
	}

	/**
	 * Check if step has data content
	 */
	public function hasDataContent(): bool
	{
		return (bool) $this->dataContent;
	}

	/**
	 * Generate step data object for Alpine.js
	 */
	public function getStepData(): array
	{
		$stepData = [
			'step' => (string) $this->step,
			'text' => $this->text,
			'classes' => $this->stepClasses ?? '',
		];

		if ($this->hasIcon()) {
			$stepData['icon'] = $this->getIconHtml();
		}

		if ($this->hasDataContent()) {
			$stepData['dataContent'] = $this->dataContent;
		}

		return $stepData;
	}

	/**
	 * Get icon HTML using jen-ui icon component
	 * This maintains compatibility with Mary UI's iconHTML method
	 */
	private function getIconHtml(): string
	{
		if (!$this->hasIcon()) {
			return '';
		}

		// Use the same pattern as Mary UI but with jen-ui component
		return "<x-dynamic-component :component=\"config('jen.prefix', 'jen') . '::icon'\" name=\"{$this->icon}\" class=\"w-4 h-4\" />";
	}

	public function render(): View|Closure|string
	{
		return view('jen::step');
	}
}
