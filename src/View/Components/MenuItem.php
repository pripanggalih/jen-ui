<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $title = null,
        public ?string $icon = null,
        public ?string $iconClasses = null,
        public ?string $spinner = null,
        public ?string $link = null,
        public ?string $route = null,
        public ?bool $external = false,
        public ?bool $noWireNavigate = false,
        public ?string $badge = null,
        public ?string $badgeClasses = null,
        public ?bool $active = false,
        public ?bool $separator = false,
        public ?bool $hidden = false,
        public ?bool $disabled = false,
        public ?bool $exact = false
    ) {
        $this->uuid = 'menu-item-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
    }

    /**
     * Get the spinner target for wire:loading directive
     */
    public function spinnerTarget(): ?string
    {
        if ($this->spinner == 1) {
            return $this->attributes->whereStartsWith('wire:click')->first();
        }

        return $this->spinner;
    }

    /**
     * Check if current route matches the menu item
     */
    public function routeMatches(): bool
    {
        if ($this->link == null) {
            return false;
        }

        if ($this->route) {
            return request()->routeIs($this->route);
        }

        $link = url($this->link ?? '');
        $route = url(request()->url());

        if ($link == $route) {
            return true;
        }

        return ! $this->exact && $this->link != '/' && Str::startsWith($route, $link);
    }

    /**
     * Check if menu item should be active
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Check if menu item has spinner functionality
     */
    public function hasSpinner(): bool
    {
        return (bool) $this->spinner;
    }

    /**
     * Check if menu item has icon
     */
    public function hasIcon(): bool
    {
        return (bool) $this->icon;
    }

    /**
     * Check if menu item has badge
     */
    public function hasBadge(): bool
    {
        return (bool) $this->badge;
    }

    /**
     * Check if menu item is disabled
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Check if menu item is hidden
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Get the menu item classes
     */
    public function getMenuItemClasses(): string
    {
        return 'my-0.5 py-1.5 px-4 hover:text-inherit whitespace-nowrap';
    }

    /**
     * Get the badge classes with defaults
     */
    public function getBadgeClasses(): string
    {
        return 'badge badge-sm ' . ($this->badgeClasses ?? '');
    }

    /**
     * Get the icon classes with defaults
     */
    public function getIconClasses(): string
    {
        $classes = ['mb-0.5'];

        if ($this->iconClasses) {
            $classes[] = $this->iconClasses;
        }

        return implode(' ', $classes);
    }

    /**
     * Get attributes for the link element
     */
    public function getLinkAttributes(): array
    {
        $attributes = [];

        if ($this->link) {
            $attributes['href'] = $this->link;

            if ($this->external) {
                $attributes['target'] = '_blank';
            }

            if (!$this->external && !$this->noWireNavigate) {
                $attributes['wire:navigate'] = true;
            }
        }

        if ($this->hasSpinner()) {
            $attributes['wire:target'] = $this->spinnerTarget();
            $attributes['wire:loading.attr'] = 'disabled';
        }

        return $attributes;
    }

    public function render(): View|Closure|string
    {
        if ($this->isHidden()) {
            return '';
        }

        return view('jen::menu-item');
    }
}
