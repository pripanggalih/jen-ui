<?php

namespace Jen\View\Components;

use ArrayAccess;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Pagination extends Component
{
	public string $uuid;

	public function __construct(
		public ArrayAccess|array $rows,
		public ?string $id = null,
		public ?array $perPageValues = [10, 20, 50, 100],
	) {
		$this->uuid = 'jen-pagination-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
	}

	// Get wire model name from attributes
	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model.live')->first();
	}

	// Check if pagination should be shown
	public function isShowable(): bool
	{
		return !empty($this->modelName()) && $this->rows instanceof LengthAwarePaginator && $this->rows->isNotEmpty();
	}

	// Check if rows is length aware paginator
	public function isLengthAwarePaginator(): bool
	{
		return $this->rows instanceof LengthAwarePaginator;
	}

	// Get current per page value
	public function getCurrentPerPage(): int
	{
		if ($this->rows instanceof LengthAwarePaginator) {
			return $this->rows->perPage();
		}

		return 10; // default value
	}

	// Build select attributes
	public function getSelectAttributes(): array
	{
		$attributes = [
			'id' => $this->uuid,
			'class' => 'select select-sm flex sm:text-sm sm:leading-6 w-auto md:mr-5',
		];

		if (!empty($this->modelName())) {
			$attributes['wire:model.live'] = $this->modelName();
		}

		return $attributes;
	}

	public function render(): View|Closure|string
	{
		return view('jen::pagination');
	}
}
