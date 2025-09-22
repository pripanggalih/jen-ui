<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Modal extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = '',
		public ?string $title = null,
		public ?string $subtitle = null,
		public ?string $boxClass = null,
		public ?bool $separator = false,
		public ?bool $persistent = false,
		public ?bool $withoutTrapFocus = false,

		// Slots
		public ?string $actions = null
	) {
		$this->uuid = 'modal-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Simple helper methods for template logic
	public function hasTitle(): bool
	{
		return (bool) $this->title;
	}

	public function hasSeparator(): bool
	{
		return (bool) $this->separator;
	}

	public function hasActions(): bool
	{
		return (bool) $this->actions;
	}

	public function isPersistent(): bool
	{
		return (bool) $this->persistent;
	}

	public function hasId(): bool
	{
		return !empty($this->id);
	}

	public function usesTrapFocus(): bool
	{
		return !$this->withoutTrapFocus;
	}

	public function getModalClasses(): string
	{
		return 'modal';
	}

	public function getBoxClasses(): string
	{
		$classes = ['modal-box'];

		if ($this->boxClass) {
			$classes[] = $this->boxClass;
		}

		return implode(' ', $classes);
	}

	public function getCloseButtonAttributes(): array
	{
		return [
			'class' => 'btn-circle btn-sm btn-ghost absolute end-2 top-2 z-[999]',
			'icon' => 'o-x-mark',
			'tabindex' => '-1'
		];
	}

	public function getAlpineData(): array
	{
		$data = [];

		if (!$this->hasId()) {
			$wireModel = $this->attributes->wire('model');
			if ($wireModel) {
				$data['x-data'] = "{open: @entangle({$wireModel}).live }";
				$data['x-init'] = "\$watch('open', value => { if (!value){ \$dispatch('close') }else{ \$dispatch('open') } })";
				$data[':class'] = "{'modal-open !animate-none': open}";
				$data[':open'] = 'open';

				if (!$this->isPersistent()) {
					$data['@keydown.escape.window'] = "\$wire.{$wireModel->value()} = false";
				}
			}
		}

		if ($this->usesTrapFocus()) {
			$data['x-trap'] = 'open';
			$data['x-bind:inert'] = '!open';
		}

		return $data;
	}

	public function render(): View|Closure|string
	{
		return view('jen::modal');
	}
}
