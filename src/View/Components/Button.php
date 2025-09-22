<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Button extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $iconRight = null,
        public ?string $spinner = null,
        public ?string $link = null,
        public ?bool $external = false,
        public ?bool $noWireNavigate = false,
        public ?bool $responsive = false,
        public ?string $badge = null,
        public ?string $badgeClasses = null,
        public ?string $tooltip = null,
        public ?string $tooltipLeft = null,
        public ?string $tooltipRight = null,
        public ?string $tooltipBottom = null,
    ) {
        $this->uuid = 'btn-' . Str::random(8) . ($id ? "-{$id}" : '');
    }

    public function getTooltip(): ?string
    {
        return $this->tooltip ?? $this->tooltipLeft ?? $this->tooltipRight ?? $this->tooltipBottom;
    }

    public function getTooltipPosition(): string
    {
        return $this->tooltipLeft ? 'lg:tooltip-left' : ($this->tooltipRight ? 'lg:tooltip-right' : ($this->tooltipBottom ? 'lg:tooltip-bottom' : 'lg:tooltip-top'));
    }

    public function spinnerTarget(): ?string
    {
        if ($this->spinner == 1) {
            return $this->attributes?->whereStartsWith('wire:click')->first();
        }

        return $this->spinner;
    }

    public function hasSpinner(): bool
    {
        return (bool) $this->spinner;
    }

    public function isLink(): bool
    {
        return (bool) $this->link;
    }

    public function hasBadge(): bool
    {
        return strlen($this->badge ?? '') > 0;
    }

    public function getLinkAttributes(): array
    {
        $attributes = [];

        if ($this->external) {
            $attributes['target'] = '_blank';
        }

        if (! $this->external && ! $this->noWireNavigate) {
            $attributes['wire:navigate'] = '';
        }

        return $attributes;
    }

    public function getButtonClasses(): string
    {
        $classes = ['btn'];

        if ($this->getTooltip()) {
            $classes[] = '!inline-flex lg:tooltip ' . $this->getTooltipPosition();
        }

        return implode(' ', $classes);
    }

    public function shouldShowLeftSpinner(): bool
    {
        return $this->hasSpinner() && ! $this->iconRight;
    }

    public function shouldShowRightSpinner(): bool
    {
        return $this->hasSpinner() && $this->iconRight;
    }

    public function getLabelClasses(): string
    {
        return $this->responsive ? 'hidden lg:block' : '';
    }

    public function render(): View|Closure|string
    {
        return view('jen::button');
    }
}
