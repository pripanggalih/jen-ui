<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Main extends Component
{
	public string $uuid;
	public string $url;

	public function __construct(
		// Slots - maintaining exact same API as Mary UI
		public mixed $sidebar = null,
		public mixed $content = null,
		public mixed $footer = null,
		public ?bool $fullWidth = false,
		public ?bool $withNav = false,
		public ?string $collapseText = 'Collapse',
		public ?string $collapseIcon = 'o-bars-3-bottom-right',
		public ?bool $collapsible = false,
	) {
		$this->uuid = 'main-' . Str::random(8);
		// Using a fallback route or creating simple toggle endpoint
		$this->url = route('jen.toggle-sidebar', absolute: false);
	}

	// Simple helper methods for template efficiency
	public function hasSidebar(): bool
	{
		return (bool) $this->sidebar;
	}

	public function hasFooter(): bool
	{
		return (bool) $this->footer;
	}

	public function isFullWidth(): bool
	{
		return (bool) $this->fullWidth;
	}

	public function hasNav(): bool
	{
		return (bool) $this->withNav;
	}

	public function isCollapsible(): bool
	{
		return (bool) $this->collapsible && $this->hasSidebar();
	}

	public function getMainClasses(): string
	{
		$classes = ['w-full', 'mx-auto'];

		if (!$this->isFullWidth()) {
			$classes[] = 'max-w-screen-2xl';
		}

		return implode(' ', $classes);
	}

	public function getDrawerClasses(): string
	{
		$classes = ['drawer', 'lg:drawer-open'];

		// Check sidebar attributes for positioning
		if ($this->hasSidebar()) {
			if ($this->sidebar?->attributes['right'] ?? false) {
				$classes[] = 'drawer-end';
			}
			if ($this->sidebar?->attributes['right-mobile'] ?? false) {
				$classes[] = 'max-sm:drawer-end';
			}
		}

		return implode(' ', $classes);
	}

	public function getContentClasses(): string
	{
		return 'drawer-content w-full mx-auto p-5 lg:px-10 lg:py-5';
	}

	public function getSidebarClasses(): string
	{
		$classes = ['drawer-side', 'z-20', 'lg:z-auto'];

		if ($this->hasNav()) {
			$classes[] = 'top-0';
			$classes[] = 'lg:top-[65px]';
			$classes[] = 'lg:h-[calc(100vh-65px)]';
		}

		return implode(' ', $classes);
	}

	public function getSidebarContentClasses(): string
	{
		$classes = [
			'flex',
			'flex-col',
			'!transition-all',
			'!duration-100',
			'ease-out',
			'overflow-x-hidden',
			'overflow-y-auto',
			'h-screen'
		];

		// Default width based on session state
		$isCollapsed = session('jen-sidebar-collapsed') === 'true';

		if ($isCollapsed) {
			$classes = array_merge($classes, [
				'w-[62px]',
				'[&>*_summary::after]:hidden',
				'[&_.jen-hideable]:hidden',
				'[&_.display-when-collapsed]:block',
				'[&_.hidden-when-collapsed]:hidden'
			]);
		} else {
			$classes = array_merge($classes, [
				'w-[270px]',
				'[&>*_summary::after]:block',
				'[&_.jen-hideable]:block',
				'[&_.hidden-when-collapsed]:block',
				'[&_.display-when-collapsed]:hidden'
			]);
		}

		if ($this->hasNav()) {
			$classes[] = 'lg:h-[calc(100vh-65px)]';
		}

		return implode(' ', $classes);
	}

	public function getFooterClasses(): string
	{
		$classes = ['mx-auto', 'w-full'];

		if (!$this->isFullWidth()) {
			$classes[] = 'max-w-screen-2xl';
		}

		return implode(' ', $classes);
	}

	public function getDrawerId(): string
	{
		return $this->sidebar?->attributes['drawer'] ?? 'jen-sidebar-' . $this->uuid;
	}

	public function getSidebarSessionState(): string
	{
		return session('jen-sidebar-collapsed', 'false');
	}

	public function render(): View|Closure|string
	{
		return view('jen::main');
	}
}
