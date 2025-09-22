<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Collapse extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $name = null,
		public ?bool $collapsePlusMinus = false,
		public ?bool $separator = false,
		public ?bool $noIcon = false,
		public mixed $heading = null,
		public mixed $content = null,
	) {
		$this->uuid = 'collapse-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	/**
	 * Check if component should use plus/minus icon
	 */
	public function hasPlusMinusIcon(): bool
	{
		return $this->collapsePlusMinus && !$this->noIcon;
	}

	/**
	 * Check if component should use arrow icon
	 */
	public function hasArrowIcon(): bool
	{
		return !$this->collapsePlusMinus && !$this->noIcon;
	}

	/**
	 * Check if component has separator
	 */
	public function hasSeparator(): bool
	{
		return (bool) $this->separator;
	}

	/**
	 * Get collapse classes
	 */
	public function getCollapseClasses(): string
	{
		$classes = [
			'collapse',
			'border-[length:var(--border)]',
			'border-base-content/10'
		];

		if ($this->hasArrowIcon()) {
			$classes[] = 'collapse-arrow';
		}

		if ($this->hasPlusMinusIcon()) {
			$classes[] = 'collapse-plus';
		}

		return implode(' ', $classes);
	}

	/**
	 * Get heading classes
	 */
	public function getHeadingClasses(): string
	{
		return 'collapse-title font-semibold';
	}

	/**
	 * Get content classes
	 */
	public function getContentClasses(): string
	{
		return 'collapse-content text-sm';
	}

	/**
	 * Get separator classes
	 */
	public function getSeparatorClasses(): string
	{
		return 'mb-3 border-t-[length:var(--border)] border-base-content/10';
	}

	public function render(): View|Closure|string
	{
		return view('jen::collapse');
	}
}
