<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class MenuSub extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $title = null,
        public ?string $icon = null,
        public ?string $iconClasses = null,
        public bool $open = false,
        public ?bool $hidden = false,
        public ?bool $disabled = false,
    ) {
        $this->uuid = 'menu-sub-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
    }

    // Check if submenu should be hidden
    public function isHidden(): bool
    {
        return (bool) $this->hidden;
    }

    // Check if submenu is disabled
    public function isDisabled(): bool
    {
        return (bool) $this->disabled;
    }

    // Get main container classes
    public function getContainerClasses(): string
    {
        $classes = [];

        if ($this->isDisabled()) {
            $classes[] = 'menu-disabled';
        }

        return implode(' ', $classes);
    }

    // Get icon classes
    public function getIconClasses(): string
    {
        $classes = ['inline-flex my-0.5'];

        if ($this->iconClasses) {
            $classes[] = $this->iconClasses;
        }

        return implode(' ', $classes);
    }

    public function render(): View|Closure|string
    {
        if ($this->isHidden()) {
            return '';
        }

        return view('jen::menu-sub');
    }
}
