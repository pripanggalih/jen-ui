<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Tab extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public bool $disabled = false,
        public bool $hidden = false,
    ) {
        $this->uuid = 'jen-tab-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
    }

    // Simple helper methods for template optimization
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function hasIcon(): bool
    {
        return (bool) $this->icon;
    }

    // Maintains Mary UI compatibility - exact same method signature and behavior
    public function tabLabel(string $label): string
    {
        $fromLabel = $this->label ? $this->label : $label;

        if ($this->icon) {
            return Blade::render("
                <x-dynamic-component :component=\"\$jenPrefix . '::icon'\" name='" . $this->icon . "' @class([
                'me-2',
                'whitespace-nowrap',
                'text-base-content/30 cursor-not-allowed' => \$disabled
                ])>
                    <x-slot:label>
                        {$fromLabel}
                    </x-slot:label>
                </x-dynamic-component>
            ", ['jenPrefix' => config('jen.prefix', 'jen'), 'disabled' => $this->disabled]);
        }

        return Blade::render("
            <div @class([
                'whitespace-nowrap',
                'text-base-content/30 cursor-not-allowed' => \$disabled
                ])>
                {$fromLabel}
            </div>
        ", ['disabled' => $this->disabled]);
    }

    // Get tab data for Alpine.js
    public function getTabData(): array
    {
        return [
            'name' => $this->name,
            'disabled' => $this->disabled,
            'hidden' => $this->hidden,
        ];
    }

    public function render(): View|Closure|string
    {
        return view('jen::tab');
    }
}
