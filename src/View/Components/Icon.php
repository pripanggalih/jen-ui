<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\View\Component;

class Icon extends Component
{
    public string $uuid;

    public function __construct(
        public string $name,
        public ?string $id = null,
        public ?string $label = null
    ) {
        $this->uuid = 'icon-' . Str::random(8) . ($id ? "-{$id}" : '');
    }

    public function icon(): string|Stringable
    {
        $name = Str::of($this->name);

        return $name->contains('.') ? $name->replace('.', '-') : "heroicon-{$this->name}";
    }

    public function labelClasses(): ?string
    {
        // Remove `w-*` and `h-*` classes, because it applies only for icon
        return Str::replaceMatches('/(w-\w*)|(h-\w*)/', '', $this->attributes->get('class') ?? '');
    }

    public function hasLabel(): bool
    {
        return (bool) strlen($this->label ?? '');
    }

    public function getIconClasses(): string
    {
        $classes = ['inline', 'flex-shrink-0'];

        // Add default size if no width/height classes present
        if (!Str::contains($this->attributes->get('class') ?? '', ['w-', 'h-'])) {
            $classes[] = 'w-5 h-5';
        }

        return implode(' ', $classes);
    }

    public function render(): View|Closure|string
    {
        return view('jen::icon');
    }
}
