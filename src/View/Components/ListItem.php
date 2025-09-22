<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ListItem extends Component
{
	public string $uuid;

	public function __construct(
		public object|array $item,
		public ?string $id = null,
		public string $avatar = 'avatar',
		public string $value = 'name',
		public ?string $subValue = '',
		public ?bool $noSeparator = false,
		public ?bool $noHover = false,
		public ?string $link = null,
		public ?string $fallbackAvatar = null,

		// Slots
		public mixed $actions = null,
	) {
		$this->uuid = 'list-item-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	// Simple helper methods - no caching for simple operations
	public function hasAvatar(): bool
	{
		return (bool) data_get($this->item, $this->avatar);
	}

	public function hasCustomAvatar(): bool
	{
		return !is_string($this->avatar);
	}

	public function hasLink(): bool
	{
		return (bool) $this->link;
	}

	public function hasActions(): bool
	{
		return (bool) $this->actions;
	}

	public function hasActionsWithEvents(): bool
	{
		return $this->hasActions() &&
			Str::of($this->actions)->contains([':click', '@click', 'href']);
	}

	public function getMainClasses(): string
	{
		$classes = ['flex justify-start items-center gap-4 px-3'];

		if (!$this->noHover) {
			$classes[] = 'hover:bg-base-200';
		}

		if ($this->hasLink()) {
			$classes[] = 'cursor-pointer';
		}

		return implode(' ', $classes);
	}

	public function getAvatarUrl(): string
	{
		return (string) data_get($this->item, $this->avatar);
	}

	public function getMainValue(): string
	{
		return is_string($this->value)
			? (string) data_get($this->item, $this->value)
			: '';
	}

	public function getSubValue(): string
	{
		return is_string($this->subValue)
			? (string) data_get($this->item, $this->subValue)
			: '';
	}

	public function render(): View|Closure|string
	{
		return view('jen::list-item');
	}
}
