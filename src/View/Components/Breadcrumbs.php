<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
	public string $uuid;

	/**
	 * @param  array  $items  The steps that should be displayed. Each element supports the keys 'label', 'link', 'icon' and 'tooltip'.
	 * @param  string  $separator  Any supported icon name, 'o-chevron-right' by default.
	 * @param ?string  $linkItemClass  The classes that should be applied to each item with a link.
	 * @param ?string  $textItemClass  The classes that should be applied to each item without a link.
	 * @param ?string  $iconClass  The classes that should be applied to each items icon.
	 * @param ?string  $separatorClass  The classes that should be applied to each separator.
	 * @param ?bool  $noWireNavigate  If true, the component will not use wire:navigate on links.
	 */
	public function __construct(
		public ?string $id = null,
		public array $items = [],
		public string $separator = 'o-chevron-right',
		public ?string $linkItemClass = "hover:underline text-sm",
		public ?string $textItemClass = "text-sm",
		public ?string $iconClass = "h-4 w-4",
		public ?string $separatorClass = "h-3 w-3 mx-1 text-base-content/40",
		public ?bool $noWireNavigate = false,
	) {
		$this->uuid = 'breadcrumbs-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Extract tooltip from different tooltip positions - kept for potential Mary UI compatibility
	public function tooltip(array $element): ?string
	{
		return $element['tooltip'] ?? $element['tooltip-left'] ?? $element['tooltip-right'] ?? $element['tooltip-bottom'] ?? $element['tooltip-top'] ?? null;
	}

	// Get tooltip position class - kept for potential Mary UI compatibility
	public function tooltipPosition(array $element): string
	{
		return match (true) {
			isset($element['tooltip-left']) => 'lg:tooltip-left',
			isset($element['tooltip-right']) => 'lg:tooltip-right',
			isset($element['tooltip-bottom']) => 'lg:tooltip-bottom',
			default => 'lg:tooltip-top',
		};
	}

	public function render(): View|Closure|string
	{
		return view('jen::breadcrumbs');
	}
}
