<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Spotlight extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?string $shortcut = "meta.g",
		public ?string $searchText = "Search ...",
		public ?string $noResultsText = "Nothing found.",
		public ?string $url = null,
		public ?string $fallbackAvatar = null,

		// Slots
		public mixed $append = null
	) {
		$this->uuid = 'jen-spotlight-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');
		$this->url = $this->url ?? route('jen.spotlight', absolute: false);
	}

	public function hasAppend(): bool
	{
		return (bool) $this->append;
	}

	public function getModalId(): string
	{
		return 'jenSpotlight' . ($this->id ? ucfirst($this->id) : '');
	}

	public function getModalClasses(): string
	{
		return 'backdrop-blur-sm';
	}

	public function getModalBoxClasses(): string
	{
		return 'absolute py-0 top-0 lg:top-10 w-full lg:max-w-3xl rounded-none md:rounded-box';
	}

	public function getInputClasses(): string
	{
		return 'w-full input my-2 border-none outline-none shadow-none border-transparent focus:shadow-none focus:outline-none focus:border-transparent';
	}

	public function getNoResultsClasses(): string
	{
		return 'text-base-content/50 p-3 border-t-[length:var(--border)] border-t-base-content/10 jen-spotlight-element';
	}

	public function getResultItemClasses(): string
	{
		return 'jen-spotlight-element';
	}

	public function getResultContentClasses(): string
	{
		return 'p-3 hover:bg-base-200 border-t-[length:var(--border)] border-t-base-content/10';
	}

	/**
	 * Search method to handle spotlight search requests.
	 * This method can be overridden in extending classes or handled via config.
	 */
	public function search($request)
	{
		// Default implementation returns empty results
		// Override this method or use config to define custom search logic
		return response()->json([]);
	}

	public function render(): View|Closure|string
	{
		return view('jen::spotlight');
	}
}
