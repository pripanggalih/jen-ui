<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Kbd extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
	) {
		$this->uuid = 'kbd-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	public function render(): View|Closure|string
	{
		return view('jen::kbd');
	}
}
