<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Menu extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $title = null,
        public ?string $icon = null,
        public ?string $iconClasses = 'w-4 h-4',
        public ?bool $separator = false,
        public ?bool $activateByRoute = false,
        public ?string $activeBgColor = 'bg-base-300',
    ) {
        $this->uuid = 'menu-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
    }

    public function render(): View|Closure|string
    {
        return view('jen::menu');
    }
}
